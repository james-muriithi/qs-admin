<!-- start sidebar menu -->
<div class="sidebar-container">
    <div class="sidemenu-container navbar-collapse collapse fixed-menu">
        <div id="remove-scroll" class="left-sidemenu h-100">
            <ul class="sidemenu  page-header-fixed slimscroll-style h-100" data-keep-expanded="false"
                data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                <li class="sidebar-toggler-wrapper hide">
                    <div class="sidebar-toggler">
                        <span></span>
                    </div>
                </li>
                <li class="sidebar-user-panel">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="http://radixtouch.in/templates/admin/smart/source/assets/img/dp.jpg" class="img-circle user-img-circle"
                                 alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>{{auth()->user()->name}}</p>
                            <a href="#"><i class="fa fa-circle user-online"></i><span class="txtOnline">
												Online</span></a>
                        </div>
                    </div>
                </li>
                <li class="nav-item {{ request()->is("admin") || request()->is("admin#") ? "active" : "" }}">
                    <a href="{{ route("admin.home") }}" class="nav-link nav-toggle">
                        <i class="material-icons">dashboard</i>
                        <span class="title">{{ trans('global.dashboard') }}</span>
                    </a>
                </li>
                @can('business_account_access')
                <li class="nav-item {{ request()->is("admin/business-accounts") || request()->is("admin/business-accounts*") ? "active" : "" }}">
                    <a href="{{ route("admin.business-accounts.index") }}" class="nav-link nav-toggle">
                        <i class="fa-fw fas fa-briefcase"></i>
                        <span class="title">{{ trans('cruds.businessAccount.title') }}</span>
                    </a>
                </li>
                @endcan
                @can('business_location_access')
                    <li class="nav-item {{ request()->is("admin/business-locations") || request()->is("admin/business-locations*") ? "active" : "" }}">
                        <a href="{{ route("admin.business-locations.index") }}" class="nav-link nav-toggle">
                            <i class="fa-fw fas fa-map-marker-alt"></i>
                            <span class="title">{{ trans('cruds.businessLocation.title') }}</span>
                        </a>
                    </li>
                @endcan
                @can('employee_access')
                    <li class="nav-item {{ request()->is("admin/employees") || request()->is("admin/employees*") ? "active" : "" }}">
                        <a href="{{ route("admin.employees.index") }}" class="nav-link nav-toggle">
                            <i class="fa-fw fas fa-users"></i>
                            <span class="title">{{ trans('cruds.employee.title') }}</span>
                        </a>
                    </li>
                @endcan
                @can('attendance_access')
                    <li class="nav-item {{ request()->is("admin/attendances") || request()->is("admin/attendances*") ? "active" : "" }}">
                        <a href="{{ route("admin.attendances.index") }}" class="nav-link nav-toggle">
                            <i class="fa-fw fas fa-qrcode"></i>
                            <span class="title">{{ trans('cruds.attendance.title') }}</span>
                        </a>
                    </li>
                @endcan
                @can('user_management_access')
                    <?php
                    $active = request()->is("admin/permissions") || request()->is("admin/permissions/*") ||
                        request()->is("admin/roles") || request()->is("admin/roles/*") || request()->is("admin/users") ||
                        request()->is("admin/users/*") || request()->is('profile/password') || request()->is('profile/password/*');
                    ?>
                    <li class="nav-item {{$active ? 'active open':''}}">
                        <a href="#" class="nav-link nav-toggle"><i class="material-icons">group</i>
                            <span class="title">
                                {{ trans('cruds.userManagement.title') }}
                            </span><span class="arrow {{$active ? 'open':''}}"></span></a>
                        <ul class="sub-menu">
                            @can('permission_access')
                                <li class="nav-item {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link">
                                        <i class="fa-fw fas fa-unlock-alt"></i>
                                        <span class="title">{{ trans('cruds.permission.title') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link">
                                        <i class="fa-fw fas fa-briefcase"></i>
                                        <span class="title">{{ trans('cruds.role.title') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link">
                                        <i class="fa-fw fas fa-users"></i>
                                        <span class="title">{{ trans('cruds.user.title') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item {{ request()->is('profile/password') || request()->is('profile/password/*') ? "active" : "" }}">
                            <a href="{{ route("admin.attendances.index") }}" class="nav-link nav-toggle">
                                <i class="fa-fw fas fa-key"></i>
                                <span class="title">{{ trans('global.change_password') }}</span>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <i class="fa-fw fas fa-sign-out-alt"></i>
                        <span class="title">{{ trans('global.logout') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- end sidebar menu -->
