@if(isset($employee))
    <div id="deleteModal-{{$employee->id}}" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="material-icons">&#xE5CD;</i>
                    </div>
                    <h4 class="modal-title w-100">Are you sure?</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete this user? This process cannot be undone.</p>
                    <form action="{{ route('admin.business-users.destroy', $employee->id) }}" method="POST" id="delete-form-{{$employee->id}}">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="delete-form-{{$employee->id}}" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endif
