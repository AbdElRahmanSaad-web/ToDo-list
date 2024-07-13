<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('assets/todo.css') }}" rel="stylesheet">
    <title>ToDo List</title>
</head>

<body>
    <div class="container my-5">
        <header class="container d-flex justify-content-between align-items-center flex-wrap">
            <div class="project-title">
                <h1 class="fw-bold text-white">TODO <span class="text-primary">LIST</span></h1>
            </div>
            <div class="profile">
                <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="material-icons text-white">account_circle</i>
                </span>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </div>
        </header>

        <div class="dropdown filter mt-3 ">
            <form action="">
                <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-between align-items-center">
                    <button class="btn btn-primary me-2" id="filter-btn">Filter</button>
                    <span class="dropdown-toggle mx-2" id="status-filter-toggle" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Status Filter
                    </span>
                    <ul class="dropdown-menu" id="status-filter">
                        <li><a class="dropdown-item" href="#" data-status="Completed">completed</a></li>
                        <li><a class="dropdown-item" href="#" data-status="Pending">pending</a></li>
                    </ul>
                    <input type="date" id='due_date' class="form-control ms-2">
                </div>
            </form>
        </div>



        <div class="row g-4 tasks-div">
            @yield('content')
        </div>
        <div class="show-all d-flex justify-content-center align-items-center mt-5 row">
            <button data-bs-toggle="modal" data-bs-target="#create_or_update_model" id="add-task"
                class="btn btn-primary mx-auto p-3 d-flex justify-content-center">Add Todo <i
                    class="material-icons ms-2">edit_square</i></button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="create_or_update_model" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Or Update</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="task-form">
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ old('title') }}" required>
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="due_date">Due Date</label>
                            <input type="date" name="due_date" min="{{ now()->format('Y-m-d') }}" id="due_date"
                                class="form-control" value="{{ old('due_date') }}" required>
                            @error('due_date')
                                <div class="alert text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                            </select>
                            @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="create-or-update">Save</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="{{ asset('assets/script.js') }}"></script>

</body>

</html>
