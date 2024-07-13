$(document).ready(function () {
    var selectedStatus;
    
    function card(task) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var statusClass = task.status == 'completed' ? 'text-success' : 'text-warning';
        var icon = task.status == 'completed' ? 'task_alt' : 'pending';

        var cardHtml = `
        <div class="col-12 col-md-6 col-lg-4" id="task-${task.id}">
            <div class="card mb-4 rounded-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <i class="material-icons me-4">${icon}</i>
                    <div class="task">
                        <h5 class="card-title fw-bold">${task.title}</h5>
                        <h6 class="card-title fw-bold text-primary">${task.due_date}</h6>
                        <h6 class="card-title fw-bold ${statusClass}">${task.status}</h6>
                    </div>
                    <div class="actions d-flex justify-content-right align-items-bottom">
                        <a href="#" data-id="${task.id}" class="text-success rounded-circle view_btn" data-bs-toggle="modal" data-bs-target="#view_task_model"><i class="material-icons">visibility</i></a>
                        <a href="#" data-id="${task.id}" data-bs-toggle="modal" data-bs-target="#create_or_update_model" class="text-primary rounded-circle edit_btn"><i class="material-icons">edit_square</i></a>
                        <form action="/destroy/${task.id}" method="POST" class="delete-task-form">
                            <input type="hidden" name="_token" value="${csrfToken}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="delete_btn text-danger"><i class="material-icons">delete</i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        `;
        return cardHtml;
    }

    function hideCompletedTask(taskId) {
        if (taskId) {
            $('#task-' + taskId).hide();
        }
    }

    $('#filter-btn').on('click', function (e) {
        e.preventDefault();
    
        var dueDate = $('#due_date').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var selectedStatus = $('#status-filter-toggle').text();
    
        $.ajax({
            url: '/filter-tasks', // Update this URL to your actual server endpoint
            type: 'POST',
            data: {
                _token: csrfToken,
                status: selectedStatus,
                due_date: dueDate,
            },
            success: function (response) {
                console.log("Response:", response);
                
                // Clear existing tasks in tasks-div
                $('.tasks-div').empty();
    
                // Add new tasks based on response
                if (response.length > 0) {
                    response.forEach(function (task) {
                        var cardHtml = card(task);
                        $('.tasks-div').append(cardHtml);
                    });
                } else {
                    $('.tasks-div').append('<div class="col-12"><p>No tasks found.</p></div>');
                }
            },
            error: function (error) {
                // Handle errors
                console.error(error);
            }
        });
    });
    
    // Change status filter text based on selection
    $('#status-filter').on('click', '.dropdown-item', function () {
        var selectedStatus = $(this).text();
        $('#status-filter-toggle').text(selectedStatus);
    });
    
    $('#create-or-update').on('click', function(e) {
        e.preventDefault();
        
        var formData = $('#task-form').serialize();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var taskId = $('#task-id').val(); // Assuming you have a hidden input with id 'task-id' in your form

        var url = taskId ? `/tasks/${taskId}` : "create_or_update";
        var method = taskId ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            type: method,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: formData,
            success: function(response) {
                $('#create_or_update_model').modal('hide');
            
                if (response.errors && !$.isEmptyObject(response.errors)) {
                    var errorMessages = '';
                    $.each(response.errors, function(key, value) {
                        $('#' + key).addClass('is-invalid').next('.invalid-feedback').html(value);
                        errorMessages += `<p>${value}</p>`;
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: errorMessages,
                        showConfirmButton: true
                    });
                } else {
                    var task = response.task;
                    var message = response.message;
            
                    if (taskId) { 
                        (task.status != 'completed')?$('#task-' + taskId).replaceWith(card(task)):hideCompletedTask(task.id);
                    } else {
                        (task.status != 'completed')? $('.tasks-div').append(card(task)) : hideCompletedTask(task.id);
                    }
            
                    // Show SweetAlert success message for task creation or update
                    Swal.fire({
                        icon: 'success',
                        title: 'Task Created or Updated!',
                        text: message,
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            },
            error: function(xhr, status, error) {
                if(xhr.status === 422) { // Laravel validation error status code
                    var response = JSON.parse(xhr.responseText);
                    var errorMessages = '';
                    $.each(response.errors, function(key, value) {
                        $('#' + key).addClass('is-invalid').next('.invalid-feedback').html(value[0]);
                        errorMessages += `<p>${value[0]}</p>`;
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: errorMessages,
                        showConfirmButton: true
                    });
                } else {
                    console.error(xhr.responseText);
                    // Show SweetAlert error message for other errors
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong! Please try again.',
                        showConfirmButton: true
                    });
                }
            }
        });
    });

    // Handle edit button click to populate the modal
    $(document).on('click', '.edit_btn', function(e) {
        e.preventDefault();
        
        var taskId = $(this).data('id');
        
        $.ajax({
            url: `/tasks/${taskId}`,
            type: 'GET',
            success: function(response) {
                // Assuming the response contains the task details
                var task = response.task;
                
                // Populate the form fields in the modal
                $('#task-id').val(task.id);
                $('#title').val(task.title);
                $('#description').val(task.description);
                $('#date').val(task.due_date);
                $('#status').val(task.status);
                
                // Show the modal
                $('#create_or_update_model').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // Handle errors if needed
            }
        });
    });

    // Clear the form when the modal is closed or opened for creating a new task
    $('#create_or_update_model').on('hidden.bs.modal', function () {
        $('#task-form')[0].reset();
        $('#task-id').val('');
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').html('');
    });

    // Handle view button click to show task details
    $(document).on('click', '.view_btn', function(e) {
        e.preventDefault();
        
        var taskId = $(this).data('id');
        
        $.ajax({
            url: `/tasks/${taskId}`,
            type: 'GET',
            success: function(response) {
                // Assuming the response contains the task details
                var task = response.task;
                
                // Populate the fields in the modal for viewing
                $('#view-task-id').text(task.id);
                $('#view-title').text(task.title);
                $('#view-description').text(task.description);
                $('#view-date').text(task.due_date);
                $('#view-status').text(task.status);
                
                // Show the modal
                $('#view_task_model').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // Handle errors if needed
            }
        });
    });

    // Handle form submission for deleting a task
    $(document).on('submit', '.delete-task-form', function(e) {
        e.preventDefault();
        
        var form = $(this);
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Confirm deletion with SweetAlert
        Swal.fire({
            title: 'Are you sure?',
            text: 'Once deleted, you will not be able to recover this task!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        // Remove the deleted task card from UI
                        form.closest('.col-12').remove();
                        
                        // Show SweetAlert success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Task Deleted!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Handle errors if needed

                        // Show SweetAlert error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Failed to delete task. Please try again.',
                            showConfirmButton: true
                        });
                    }
                });
            }
        });
    });

});
