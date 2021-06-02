@extends('layouts.admin1')
@section('styles')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.css" integrity="sha512-OtwMKauYE8gmoXusoKzA/wzQoh7WThXJcJVkA29fHP58hBF7osfY0WLCIZbwkeL9OgRCxtAfy17Pn3mndQ4PZQ==" crossorigin="anonymous" />
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
                                    <div class="row mb-3">
                                        <div class="col-12 col-md-6 text-end d-flex"></div>
                                        <div class="col-10 col-md-6 text-end d-flex">
                                            <div class="row">
                                                <div class="col-6">
                                                    <select name="bsid" id="bsid" class="form-control">
                                                        @foreach($bsids as $id => $name)
                                                            <option value="{{$id}}">{{$name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" id="daterange" name="range" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                            </tr>
                                            </thead>
                                            <tbody>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.js" integrity="sha512-+ruHlyki4CepPr07VklkX/KM5NXdD16K1xVwSva5VqOVbsotyCQVKEwdQ1tAeo3UkHCXfSMtKU/mZpKjYqkxZA==" crossorigin="anonymous"></script>
    <script>
        $(function () {
            let _token = $('meta[name="csrf-token"]').attr('content')
            let dtOverrideGlobals = {
                buttons: ["copy", "csv", "excel", "pdf", "print"],
                dom: "Bfrtip",
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: {
                    headers: {'x-csrf-token': _token},
                    url: "{{ route('admin.attendances.index') }}",
                    data: function (data){
                        data.bs_id = $('#bsid').val();
                        data.range = $('#daterange').val();
                    }
                },
                columns: [
                    {data: 'DT_RowIndex'},
                    { data: 'bsid_bsid', name: 'bsid.BS_ID' },
                    { data: 'bsid.bs_name', name: 'bsid.BS_Name' },
                    { data: 'employeeid_employeeid', name: 'employee.employeeid' },
                    { data: 'employeeid.name', name: 'employee.name' },
                    { data: 'date', name: 'date' },
                    { data: 'time_in', name: 'time_in' },
                    { data: 'time_out', name: 'time_out' },
                    { data: 'location', name: 'location' },
                    { data: 'status', name: 'status' },
                ],
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 10,
            };
            let table = $('.datatable-BusinessAccount').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

            $('#bsid').on('change', function (){
                const range = $('#daterange').val();
                const bsid = $('#bsid').val();

                if (range || bsid){
                    table.ajax.reload()
                }
            });

            flatpickr("#daterange", {
                mode: "range",
                maxDate: "today",
                onOpen: function (selectedDates, dateStr, instance) {
                    instance.setDate(instance.input.value, false);
                },
                onClose: function(){
                    if ($('#daterange').val()){
                        table.ajax.reload()
                    }
                }
            });

        });

        $(document).ready(function (){

        });
    </script>
@endsection
