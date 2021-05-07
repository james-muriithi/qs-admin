@extends('layouts.admin1')
@section('styles')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="{{asset('css/buttons.dataTables.min.css')}}" rel="stylesheet" />
    <style>
        .fr .pagination{
            float: right;
        }
    </style>
@endsection
@section('content')
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">{{ trans('cruds.employee.title') }} {{ trans('global.list') }}</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                        <i class="fa fa-home"></i>&nbsp;
                        <a class="parent-item" href="{{route('admin.home')}}">
                            {{trans('global.home')}}
                        </a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">{{ trans('cruds.employee.title') }} {{ trans('global.list') }}</li>
                </ol>
            </div>
        </div>
        <!-- start widget -->

        <div class="row">
            <div class="col-md-12">
                <div class="tabbable-line">
                    <ul class="nav customtab nav-tabs" role="tablist">
                        <li class="nav-item"><a href="#tab1" class="nav-link" data-bs-toggle="tab">List
                                View</a></li>
                        <li class="nav-item"><a href="#tab2" class="nav-link active" data-bs-toggle="tab">Grid
                                View</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fontawesome-demo" id="tab1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-box">
                                        <div class="card-head">
                                            <header>All {{ trans('cruds.employee.title') }}</header>
                                            <div class="tools">
                                                <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                                <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                            </div>
                                        </div>
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-6">
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.employees.create') }}" id="addRow" class="btn btn-info">
                                                            Add New <i class="fa fa-plus"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="table-responsive">
                                                <table class=" table table-bordered table-striped table-hover datatable datatable-BusinessAccount">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                            {{ trans('cruds.employee.fields.id') }}
                                                        </th>
                                                        <th>
                                                            {{ trans('cruds.employee.fields.name') }}
                                                        </th>
                                                        <th>
                                                            {{ trans('cruds.employee.fields.emp_id') }}
                                                        </th>
                                                        <th>
                                                            {{ trans('cruds.employee.fields.genid') }}
                                                        </th>
                                                        <th>
                                                            {{ trans('cruds.employee.fields.bsid') }}
                                                        </th>
                                                        <th>
                                                            {{ trans('cruds.businessAccount.fields.bsid') }}
                                                        </th>
                                                        <th>
                                                            {{ trans('cruds.employee.fields.department') }}
                                                        </th>
                                                        <th>
                                                            {{ trans('cruds.employee.fields.designation') }}
                                                        </th>
                                                        <th>
                                                            {{ trans('cruds.employee.fields.contact') }}
                                                        </th>
                                                        <th>
                                                            {{ trans('cruds.employee.fields.email') }}
                                                        </th>
                                                        <th>
                                                            {{ trans('cruds.employee.fields.gender') }}
                                                        </th>
                                                        <th>
                                                            &nbsp;
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($employees as $key => $employee)
                                                        <tr data-entry-id="{{ $employee->id }}">
                                                            <td>
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('admin.employees.show', $employee->id) }}">
                                                                    {{ $employee->name ?? '' }}
                                                                </a>
                                                            </td>
                                                            <td>
                                                                {{ $employee->emp_id ?? '' }}
                                                            </td>
                                                            <td>
                                                                {{ $employee->GenId ?? '' }}
                                                            </td>
                                                            <td>
                                                                {{ $employee->organisation->BS_Name ?? '' }}
                                                            </td>
                                                            <td>
                                                                {{ $employee->organisation->BS_ID ?? '' }}
                                                            </td>
                                                            <td>
                                                                {{ $employee->department ?? '' }}
                                                            </td>
                                                            <td>
                                                                {{ $employee->designation ?? '' }}
                                                            </td>
                                                            <td>
                                                                {{ $employee->contact ?? '' }}
                                                            </td>
                                                            <td>
                                                                {{ $employee->email ?? '' }}
                                                            </td>
                                                            <td>
                                                                {{ App\Models\Employee::GENDER_SELECT[$employee->gender] ?? '' }}
                                                            </td>
                                                            <td>
                                                                @can('employee_show')
                                                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.employees.show', $employee->id) }}">
                                                                        {{ trans('global.view') }}
                                                                    </a>
                                                                @endcan

                                                                @can('employee_edit')
                                                                    <a class="btn btn-xs btn-info" href="{{ route('admin.employees.edit', $employee->id) }}">
                                                                        {{ trans('global.edit') }}
                                                                    </a>
                                                                @endcan

                                                                @can('employee_deletes')
                                                                    <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                                        <input type="hidden" name="_method" value="DELETE">
                                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                                    </form>
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
                        </div>
                        <div class="tab-pane active" id="tab2">
                            <div class="row">
                                <div class="row mb-4">
                                    <div class="col-md-6 col-sm-6 col-6"></div>
                                    <div class="col-md-6 col-sm-6 col-6 text-end">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.employees.create') }}" id="addRow" class="btn btn-info">
                                                Add New <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @foreach($paginatedEmployees as $employee)
                                    <div class="col-md-4">
                                        <div class="card card-box">
                                            <div class="card-body no-padding ">
                                                <div class="doctor-profile">
                                                    <img
                                                         src="{{$employee->generatePotraitUrl($employee->potraits[0])}}" class="doctor-pic" alt="">
                                                    <div class="profile-usertitle">
                                                        <div class="doctor-name">{{$employee->name}}</div>
                                                        <div class="name-center"> {{$employee->organisation->BS_Name}} </div>
                                                    </div>
                                                    <p>Emp ID: {{$employee->emp_id}}</p>
                                                    <a href="mailto:{{$employee->email}}">
                                                        <i class="fa fa-envelope"></i>
                                                        {{$employee->email}}
                                                    </a>
                                                    <div>
                                                        <p><i class="fa fa-phone"></i><a href="tel:(123)456-7890">
                                                                {{$employee->contact}}</a></p>
                                                    </div>
                                                    <div class="profile-userbuttons">
                                                        <a href="{{route('admin.employees.show', $employee->id)}}"
                                                           class="btn btn-circle deepPink-bgcolor btn-sm">
                                                            {{trans('global.view')}}</a>
                                                        <a href="{{route('admin.employees.edit', $employee->id)}}"
                                                           class="btn btn-circle blue-bgcolor btn-sm">
                                                            {{trans('global.edit')}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="fr">
                                    {{$paginatedEmployees->links('pagination::bootstrap-4')}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script>
        $(document).ready(function (){
            $(".datatable-BusinessAccount").DataTable({
                dom: "Bfrtip",
                buttons: ["copy", "csv", "excel", "pdf", "print"],
            });
        })
    </script>
@endsection
