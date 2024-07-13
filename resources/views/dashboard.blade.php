<x-Admin.template>
    @foreach ($tasks as $task)
    <div class="col-12 col-md-6 col-lg-4" id="task-{{$task->id}}">
        <div class="card mb-4 rounded-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <i class="material-icons me-4">{{($task->status == 'completed')?'task_alt':'pending'}}</i>
                <div class="task">
                    <h5 class="card-title fw-bold">{{$task->title}}</h5>
                    <h6 class="card-title fw-bold text-primary">{{$task->due_date}}</h6>
                    @if($task->status == 'completed')
                        <h6 class="card-title fw-bold text-success">{{$task->status}}</h6>
                    @else
                        <h6 class="card-title fw-bold text-warning">{{$task->status}}</h6>
                    @endif
                </div>
                <div class="actions d-flex justify-content-right align-items-bottom">
                    <a href="#" data-id={{$task->id}} class="text-success rounded-circle view_btn"><i class="material-icons">visibility</i></a>
                    <a href="#" data-id={{$task->id}} data-bs-toggle="modal" data-bs-target="#create_or_update_model" class="text-primary rounded-circle edit_btn"><i class="material-icons">edit_square</i></a>
                    
                    <form action="{{ route('destroy', $task->id) }}" method="POST" class="delete-task-form d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-danger delete_btn"><i class="material-icons">delete</i></button>
                    </form>            
                </div>
           </div>
        </div>
    </div>
    @endforeach
</x-Admin.template>
