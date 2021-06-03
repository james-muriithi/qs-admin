@if(isset($employee))
    <div id="reset-{{$employee->id}}" class="modal fade" tabindex="-1">
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
                    <p>Do you really want to reset {{explode(' ', $employee->name)[0]}}'s password? </p>
                    <p class="text-muted mt-3">PS. A reset password link will be sent to their email.</p>
                    <form action="" method="POST" id="reset-form-{{$employee->id}}">
                        @csrf
                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="reset-form-{{$employee->id}}" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </div>
    </div>
@endif
