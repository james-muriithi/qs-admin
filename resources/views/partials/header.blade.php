<!-- start header -->
<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">
        <!-- logo start -->
        <div class="page-logo d-none d-sm-none  d-sm-none d-md-none d-lg-block d-xl-block">
            <a href="{{route('admin.home')}}">
                <img src="https://quickscan.brancetech.com/assets/img/logo2.png" class="logo-icon img-responsive pt-1">
            </a>
        </div>
        <!-- logo end -->
        <ul class="nav navbar-nav navbar-left in">
            <li><a href="#" class="menu-toggler sidebar-toggler"><i class="icon-menu"></i></a></li>
        </ul>

        <!-- start mobile menu -->
        <a class="menu-toggler responsive-toggler" data-bs-toggle="collapse" data-bs-target=".navbar-collapse">
            <span></span>
        </a>
        <!-- end mobile menu -->
        <!-- start header menu -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <li><a class="fullscreen-btn"><i class="fa fa-arrows-alt"></i></a></li>
                <!-- start notification dropdown -->
                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    <a class="dropdown-toggle" data-bs-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <i class="fa fa-bell-o"></i>
                        <span class="badge headerBadgeColor1"> 0 </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="external">
                            <h3><span class="bold">Notifications</span></h3>
                            <span class="notification-label purple-bgcolor">0</span>
                        </li>
                        <li>
                            <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
{{--                                <li>--}}
{{--                                    <a href="javascript:;">--}}
{{--                                        <span class="time">just now</span>--}}
{{--                                        <span class="details">--}}
{{--													<span class="notification-icon circle deepPink-bgcolor"><i--}}
{{--                                                            class="fa fa-check"></i></span>--}}
{{--													Congratulations!. </span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}

                            </ul>
                            <div class="dropdown-menu-footer">
                                <a href="javascript:void(0)"> All notifications </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- end notification dropdown -->
                <!-- start message dropdown -->
                <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                    <a class="dropdown-toggle" data-bs-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge headerBadgeColor2"> 0 </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="external">
                            <h3><span class="bold">Messages</span></h3>
                            <span class="notification-label cyan-bgcolor">0</span>
                        </li>
                        <li>
                            <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
{{--                                <li>--}}
{{--                                    <a href="#">--}}
{{--												<span class="photo">--}}
{{--													<img src="http://radixtouch.in/templates/admin/smart/source/assets/img/prof/prof2.jpg" class="img-circle" alt="">--}}
{{--												</span>--}}
{{--                                        <span class="subject">--}}
{{--													<span class="from"> Sarah Smith </span>--}}
{{--													<span class="time">Just Now </span>--}}
{{--												</span>--}}
{{--                                        <span class="message"> Jatin I found you on LinkedIn... </span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
                            </ul>
                            <div class="dropdown-menu-footer">
                                <a href="#"> All Messages </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- end message dropdown -->
                <!-- start manage user dropdown -->
                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-bs-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <img alt="" class="img-circle " src="http://radixtouch.in/templates/admin/smart/source/assets/img/dp.jpg" />
                        <span class="username username-hide-on-mobile"> {{ explode(' ', auth()->user()->name)[0] }} </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="#">
                                <i class="icon-user"></i> Profile </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-settings"></i> Settings
                            </a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                <i class="icon-logout"></i> Log Out </a>
                        </li>
                    </ul>
                </li>
                <!-- end manage user dropdown -->
            </ul>
        </div>
    </div>
</div>
<!-- end header -->
