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
            <form action="">
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
            <button type="button" class="btn btn-primary">Save</button>
        </div>
    </div>
</div>
</div>