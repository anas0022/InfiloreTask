<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">

<div id="createTaskModal" class="modal fade" tabindex="-1" aria-labelledby="createTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3">
            <div class="modal-header border-bottom pb-3">
                <h5 class="modal-title fw-bold" id="createTaskModalLabel">Create Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <form action="{{ route('tasks.store') }}" method="POST" id="createTaskForm">
                    @csrf
                    <input type="hidden" name="id" id="id" value="">
                    <div class="mb-4">
                        <label for="title" class="form-label fw-medium">Title</label>
                        <input type="text" name="title" id="title" class="form-control shadow-sm">
                        <span class="text-danger error-message" id="title-error"></span>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label fw-medium">Description</label>
                        <textarea name="description" id="description" class="form-control shadow-sm" rows="3"></textarea>
                        <span class="text-danger error-message" id="description-error"></span>
                    </div>
                    <div class="mb-4">
                        <label for="due_date" class="form-label fw-medium">Due Date</label>
                        <input type="date" name="due_date" id="due_date" class="form-control shadow-sm" >
                        <span class="text-danger" id="due_date-error"></span>
                    </div>
                    <div class="mb-4">
                        <label for="priority" class="form-label fw-medium">Priority</label>
                        <select name="priority" id="priority" class="form-select shadow-sm">
                            <option value="Low">Low</option>
                            <option value="Medium" selected>Medium</option>
                            <option value="High">High</option>
                        </select>
                        <span class="text-danger" id="priority-error"></span>
                    </div>
                    <div class="mb-4">
                        <label for="status" class="form-label fw-medium">Status</label>
                        <select name="status" id="status" class="form-select shadow-sm">
                            <option value="Pending" selected>Pending</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                        <span class="text-danger" id="status-error"></span>
                    </div>
                    <div class="mb-4">
                        <label for="user_id" class="form-label fw-medium">Assigned To</label>
                        <select name="user_id" id="user_id" class="form-select shadow-sm">
                            <option value="">Select User</option>
                            @if(!empty($user))
                                @foreach ($user as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            @else
                                <option value="">No User Found</option>
                            @endif
                        </select>
                        <span class="text-danger" id="user_id-error"></span>
                        <div class="invalid-feedback" id="user_id-error"></div>
                    </div>
                    <div class="modal-footer border-top pt-3">
                        <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4">Create Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

                    
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script>
  var token = "{{ csrf_token() }}"
  var url = "{{ route('tasks.store') }}"
</script>

<style>
.error-message {
    font-size: 0.875rem;
    margin-top: 0.25rem;
    display: block;
}

.is-invalid {
    border-color: #dc3545;
}
</style>