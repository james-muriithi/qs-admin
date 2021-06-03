@if(isset($employee))
    <div id="status-{{$employee->id}}" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box {{$deactivate ? '' : 'border-success'}}">
                        <i class="material-icons {{$deactivate ? '' : 'text-success'}}">{{$deactivate ? 'close' : 'check'}}</i>
                    </div>
                    <h4 class="modal-title w-100">Are you sure?</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to {{$deactivate ? 'deactivate':'activate'}} this user?</p>
                    <form action="{{ route('admin.business-users.status', $employee->id) }}" method="POST" id="status-form-{{$employee->id}}">
                        @csrf
                        <input type="text" hidden name="active" value="{{$deactivate ? '0':'1'}}">
                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="status-form-{{$employee->id}}" class="btn {{$deactivate ? 'btn-danger':'btn-success'}}">{{$deactivate ? 'Deactivate':'Activate'}}</button>
                </div>
            </div>
        </div>
    </div>
@endif
