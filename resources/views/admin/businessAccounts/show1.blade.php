@extends('layouts.admin1')
@section('styles')

@endsection
@section('content')
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">{{ trans('global.show') }} {{ trans('cruds.businessAccount.title_singular') }}</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                        <i class="fa fa-home"></i>&nbsp;
                        <a class="parent-item" href="{{route('admin.home')}}">
                            {{trans('global.home')}}
                        </a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <i class="fa fa-home"></i>&nbsp;
                        <a class="parent-item" href="{{route('admin.business-accounts.index')}}">
                            {{ trans('cruds.businessAccount.title') }}
                        </a>&nbsp;<i class="fa fa-angle-right">
                        </i>
                    </li>
                    <li class="active">
                        {{ $businessAccount->BS_ID }}
                    </li>
                </ol>
            </div>
        </div>
        <!-- start widget -->

        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PROFILE SIDEBAR -->
                <div class="profile-sidebar">
                    <div class="card">
                        <div class="card-body no-padding height-9">
                            <div class="row">
                                <div class="profile-userpic">
                                    <img src="{{$businessAccount->logoUrl}}" class="img-responsive" alt=""> </div>
                            </div>
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name">{{$businessAccount->BS_Name}}</div>
                                <div class="profile-usertitle-job"> {{$businessAccount->BS_ID}} </div>
                            </div>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Users</b> <a class="pull-right">{{$businessAccount->employees->count()}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Date Created</b> <a class="pull-right">{{$businessAccount->Date_Created}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Location</b> <a class="pull-right">{{$businessAccount->BS_Location}}</a>
                                </li>
                            </ul>
                            <!-- END SIDEBAR USER TITLE -->
                            <!-- SIDEBAR BUTTONS -->
                            <div class="profile-userbuttons">
                                <a href="tel:{{$businessAccount->BS_Contact}}" class="btn btn-circle green btn-sm">Contact</a>
                                <a href="mailto:{{$businessAccount->BS_Email}}" class="btn btn-circle red btn-sm">Email</a>
                            </div>
                            <!-- END SIDEBAR BUTTONS -->
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-head">
                            <header>Employees</header>
                        </div>
                        <div class="card-body no-padding height-9">
                            <ul class="performance-list">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-circle-o" style="color:#F39C12;"></i> Males
                                         <span class="pull-right">{{$businessAccount->employees->where('gender', 'Male')->count()}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-circle-o" style="color:#DD4B39;"></i> Females
                                        <span class="pull-right">{{$businessAccount->employees->where('gender', 'Female')->count()}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-circle-o" style="color:#00A65A;"></i> Total Employees
                                        <span class="pull-right"> {{$businessAccount->employees->count()}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    @if($businessAccount->departments->count() > 0)
                        <div class="card">
                            <div class="card-head">
                                <header>Departments</header>
                            </div>
                            <div class="card-body no-padding height-9">
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item border-top-0">
                                        <b>Total Departments </b>
                                        <div class="profile-desc-item pull-right">{{$businessAccount->departments->count()}}</div>
                                    </li>
                                </ul>
                                <div class="row list-separated profile-stat">
                                    @foreach($businessAccount->departments as $department)
                                        <div class="col-md-4 col-sm-4 col-6">
                                            <div class="uppercase profile-stat-title"> {{$department->total}} </div>
                                            <div class="uppercase profile-stat-text"> {{$department->department}} </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-head">
                            <header>Work Progress</header>
                        </div>
                        <div class="card-body no-padding height-9">
                            <div class="work-monitor work-progress">
                                <div class="states">
                                    <div class="info">
                                        <div class="desc pull-left">Operations</div>
                                        <div class="percent pull-right">80%</div>
                                    </div>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-danger progress-bar-striped active"
                                             role="progressbar" aria-valuenow="40" aria-valuemin="0"
                                             aria-valuemax="100" style="width: 70%">
                                            <span class="sr-only">80% </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="states">
                                    <div class="info">
                                        <div class="desc pull-left">Consultation</div>
                                        <div class="percent pull-right">55%</div>
                                    </div>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-success progress-bar-striped active"
                                             role="progressbar" aria-valuenow="40" aria-valuemin="0"
                                             aria-valuemax="100" style="width: 45%">
                                            <span class="sr-only">55% </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="states">
                                    <div class="info">
                                        <div class="desc pull-left">Support</div>
                                        <div class="percent pull-right">20%</div>
                                    </div>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-warning progress-bar-striped active"
                                             role="progressbar" aria-valuenow="40" aria-valuemin="0"
                                             aria-valuemax="100" style="width: 35%">
                                            <span class="sr-only">20% </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- END BEGIN PROFILE SIDEBAR -->
            </div>
        </div>
    </div>

@endsection
