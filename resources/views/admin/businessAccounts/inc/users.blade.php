<div class="col-12">
    <div class="card">
        <div class="card-head">
            <header>Business Users</header>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-striped table-hover datatable datatable-BusinessUsers">
                        <thead>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.email') }}
                            </th>
                            <th>
                                Role
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($businessAccount->users as $key => $user)
                            <tr data-entry-id="{{ $user->id }}">
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $user->email ?? '' }}
                                </td>
                                <td>
                                    <span class="badge badge-info">{{ $user->roles->title }}</span>
                                </td>

                                <td>
                                    @if($user->approved)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">In Active</span>
                                    @endif
                                </td>

                                <td>
                                    @can('business_user_edit')
                                        @if($user->approved)
                                            <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#status-{{$user->id}}">
                                                Deactivate
                                            </button>
                                        @else
                                            <button class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#status-{{$user->id}}">
                                                Activate
                                            </button>
                                        @endif
                                        @include('admin.businessAccounts.inc.user-status-modal', ['deactivate' => $user->approved, 'employee' => $user])
                                    @endcan

                                    @can('business_user_reset_password')
                                        <button class="btn btn-xs btn-info" data-bs-toggle="modal" data-bs-target="#reset-{{$user->id}}">
                                            Reset Password
                                        </button>
                                        @include('admin.businessAccounts.inc.reset-password-modal', ['employee'=>$user])
                                        @endcan

                                    @can('business_user_delete')
                                        @if(!$user->is_admin)
                                            <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$user->id}}">{{ trans('global.delete') }}</button>
                                            @include('admin.businessAccounts.inc.delete-modal', ['employee'=>$user])
                                        @endif
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script>
        $(document).ready(function (){
            $(".datatable-BusinessUsers").DataTable({
                lengthChange: false,
            });
            $('.modal').appendTo("body");
        })
    </script>
@endsection
