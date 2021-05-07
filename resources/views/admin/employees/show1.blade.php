@extends('layouts.admin1')
@section('styles')
    @parent
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="{{asset('css/buttons.dataTables.min.css')}}" rel="stylesheet" />
    <style>
        .fr .pagination{
            float: right;
        }
        .qr-image img{
            height: 350px;
            width: 100%;
        }
        .qr-image img{
            height: 350px;
            width: 100%;
        }
    </style>
@endsection
@section('content')
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">{{ trans('global.show') }} {{ trans('cruds.employee.title_singular') }}</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                        <i class="fa fa-home"></i>&nbsp;
                        <a class="parent-item" href="{{route('admin.home')}}">
                            {{trans('global.home')}}
                        </a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <i class="fa fa-user"></i>&nbsp;
                        <a class="parent-item" href="{{route('admin.employees.index')}}">
                            {{ trans('cruds.employee.title') }}
                        </a>&nbsp;<i class="fa fa-angle-right">
                        </i>
                    </li>
                    <li class="active">
                        {{ $employee->emp_id }}
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
                                    <img src="{{$employee->generatePotraitUrl($employee->potraits[0])}}" class="img-responsive" alt=""> </div>
                            </div>
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name">{{$employee->designation}} {{$employee->name}}</div>
                                <div class="profile-usertitle-job"> {{$employee->emp_id}} </div>
                                <div class="profile-usertitle-job"> {{$employee->GenId}} </div>
                            </div>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Contact</b> <a class="pull-right">{{$employee->contact}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Gender</b> <a class="pull-right">{{$employee->gender}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Date Created</b> <a class="pull-right">{{$employee->timestamp}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Organisation</b> <a class="pull-right">{{$employee->organisation->BS_Name}}</a>
                                </li>
                            </ul>
                            <!-- END SIDEBAR USER TITLE -->
                            <!-- SIDEBAR BUTTONS -->
                            <div class="profile-userbuttons">
                                <a href="tel:{{$employee->contact}}" class="btn btn-circle green btn-sm">Contact</a>
                                <a href="mailto:{{$employee->email}}" class="btn btn-circle red btn-sm">Email</a>
                                <a href="{{route('admin.employees.edit', $employee->id)}}" class="btn btn-circle blue btn-sm">Edit</a>
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
                                        <i class="fa fa-circle-o" style="color:#F39C12;"></i> Gender
                                        <span class="pull-right">{{$employee->gender}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-circle-o" style="color:#DD4B39;"></i> Department
                                        <span class="pull-right">{{$employee->department}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-circle-o" style="color:#00A65A;"></i> Designation
                                        <span class="pull-right"> {{$employee->designation}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

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
                <!-- END PROFILE SIDEBAR  -->
                <!-- BEGIN PROFILE CONTENT -->
                <div class="profile-content">
                    <di class="row">
                        <div class="col-md-12">

                            <div class="card">
                                <div class="card-head">
                                    <header>{{trans('cruds.employee.title_singular')}} {{trans('cruds.attendance.title_singular')}}</header>
                                </div>
                                <div class="card-body no-padding height-9">
                                    <table class=" table table-bordered table-striped table-hover datatable datatable-Employee">
                                        <thead>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.employee.fields.id') }}
                                            </th>
                                            <th>
                                                {{ trans('cruds.attendance.fields.employeeid') }}
                                            </th>
                                            <th>
                                                {{ trans('cruds.attendance.fields.date') }}
                                            </th>
                                            <th>
                                                {{ trans('cruds.attendance.fields.time_in') }}
                                            </th>
                                            <th>
                                                {{ trans('cruds.attendance.fields.time_out') }}
                                            </th>
                                            <th>
                                                {{ trans('cruds.attendance.fields.location') }}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($employee->attendance as $attendance)
                                                <tr>
                                                    <td>
                                                        {{$loop->iteration}}
                                                    </td>
                                                    <td>{{$employee->emp_id}}</td>
                                                    <td>{{$attendance->date}}</td>
                                                    <td>{{$attendance->time_in}}</td>
                                                    <td>{{$attendance->time_out}}</td>
                                                    <td title="{{$attendance->area_info}}">
                                                        <a rel="noopener noreferrer" target="_blank" href="https://www.google.com/maps?q={{ $attendance->location ?? '' }}">
                                                            {{ $attendance->location ?? '' }}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </di>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-head">
                        <header>Employee Potraits</header>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @forelse($employee->potraits as $potrait)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="item active qr-image">
                                            <img src="{{$employee->generatePotraitUrl($potrait)}}"
                                                 alt="">
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-6 text-center">
                                                    <a href="{{$employee->generatePotraitUrl($potrait)}}" download="{{$employee->name}}-potrait">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                </div>
                                                <div class="col-6 text-center">
                                                    <i class="fa fas fa-trash text-danger"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center my-3">
                                    <div class="card-head border-bottom-0">
                                        <header class="d-block">
                                            No potraits Yet
                                        </header>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @parent
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(".datatable-Employee").DataTable({
            dom: "Bfrtip",
        });
    </script>
@endsection
