@extends('layouts.empty')
@section('body')
<div class="container my-5">
    <header class="container d-flex justify-content-between align-items-center flex-wrap">
        <div class="project-title">
            <h1 class="fw-bold text-white">TODO <span class="text-primary">LIST</span></h1>
        </div>
        <div class="profile">
            <span class="dropdown-toggle d-flex justify-content-between align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="material-icons text-white me-2">account_circle</i><p class="text-white mt-3">Hello {{ auth()->user()->name }}</p>
            </span>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('profile.edit')}}">Profile</a></li>
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
                    <li><a class="dropdown-item" href="#" data-status="All">all</a></li>
                    <li><a class="dropdown-item" href="#" data-status="Completed">completed</a></li>
                    <li><a class="dropdown-item" href="#" data-status="Pending">pending</a></li>
                </ul>
                
                <input type="date" id='due_date' class="form-control ms-2">
            </div>
        </form>
    </div>



    <div class="row g-4 tasks-div">
        {{ $slot }}
    </div>
    <div class="show-all d-flex justify-content-center align-items-center mt-5 row">
        <button data-bs-toggle="modal" data-bs-target="#create_or_update_model" id="add-task"
            class="btn btn-primary mx-auto p-3 d-flex justify-content-center">Add Todo <i
                class="material-icons ms-2">edit_square</i></button>
    </div>
</div>


<div class="modal fade" id="view_task_model" tabindex="-1" aria-labelledby="viewTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewTaskModalLabel">Task Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>ID:</strong> <span id="view-task-id"></span></p>
                <p><strong>Title:</strong> <span id="view-title"></span></p>
                <p><strong>Description:</strong> <span id="view-description"></span></p>
                <p><strong>Due Date:</strong> <span id="view-date"></span></p>
                <p><strong>Status:</strong> <span id="view-status"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
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
                <form id="task-form">
                    <input type="hidden" id="task-id" name="task_id" value="">
                    <div class="form-group mb-3">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                        <div class="invalid-feedback"></div>
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                        <div class="invalid-feedback"></div>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="due_date">Due Date</label>
                        <input type="date" name="due_date" id="date" class="form-control" min="{{ now()->format('Y-m-d') }}" required>
                        <div class="invalid-feedback"></div>
                        @error('due_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                        </select>
                        <div class="invalid-feedback"></div>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="create-or-update">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection
