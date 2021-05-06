@extends('layouts.admin1')
@section('styles')
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
    </style>
@endsection
@section('content')
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">{{ trans('cruds.attendance.title_singular') }} {{ trans('global.list') }}</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                        <i class="fa fa-home"></i>&nbsp;
                        <a class="parent-item" href="{{route('admin.home')}}">
                            {{trans('global.home')}}
                        </a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">{{ trans('cruds.attendance.title_singular') }} {{ trans('global.list') }}</li>
                </ol>
            </div>
        </div>
        <!-- start widget -->

        <div class="row">
            <div class="col-md-12">
                <div class="tabbable-line">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>All {{ trans('cruds.attendance.title_singular') }}s</header>
                                    <div class="tools">
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body ">

                                    <div class="table-responsive">
                                        <table class=" table table-bordered table-striped table-hover datatable datatable-BusinessAccount">
                                            <thead>
                                            <tr>
                                                <th>
                                                    {{ trans('cruds.attendance.fields.id') }}
                                                </th>
                                                <th>
                                                    {{ trans('cruds.attendance.fields.bsid') }}
                                                </th>
                                                <th>
                                                    {{ trans('cruds.businessAccount.fields.bs_name') }}
                                                </th>
                                                <th>
                                                    {{ trans('cruds.attendance.fields.employeeid') }}
                                                </th>
                                                <th>
                                                    {{ trans('cruds.employee.fields.name') }}
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
{{--                                                <th>--}}
{{--                                                    {{ trans('cruds.attendance.fields.hours_in') }}--}}
{{--                                                </th>--}}
                                                <th>
                                                    {{ trans('cruds.attendance.fields.status') }}
                                                </th>
                                                <th>
                                                    &nbsp;
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($attendances as $key => $attendance)
                                                <tr data-entry-id="{{ $attendance->id }}">
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        {{ $attendance->bsid->BS_ID ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $attendance->bsid->BS_Name ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $attendance->employee->emp_id ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $attendance->employee->name ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $attendance->date ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $attendance->time_in ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $attendance->time_out ?? '' }}
                                                    </td>
                                                    <td title="{{$attendance->area_info}}">
                                                        <a rel="noopener noreferrer" target="_blank" href="https://www.google.com/maps?q={{ $attendance->location ?? '' }}">
                                                            {{ $attendance->location ?? '' }}
                                                        </a>
                                                    </td>
{{--                                                    <td>--}}
{{--                                                        {{ $attendance->hours_in ?? '' }}--}}
{{--                                                    </td>--}}
                                                    <td>
                                                        {{ $attendance->status ?? '' }}
                                                    </td>
                                                    <td>

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
