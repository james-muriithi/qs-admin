@extends('layouts.admin1')
@section('styles')
    <style>
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
                                <li class="list-group-item">
                                    <b>Industry</b> <a class="pull-right">{{$businessAccount->BS_Industry}}</a>
                                </li>
                            </ul>
                            <!-- END SIDEBAR USER TITLE -->
                            <!-- SIDEBAR BUTTONS -->
                            <div class="profile-userbuttons">
                                <a href="tel:{{$businessAccount->BS_Contact}}" class="btn btn-circle green btn-sm">Contact</a>
                                <a href="mailto:{{$businessAccount->BS_Email}}" class="btn btn-circle red btn-sm">Email</a>
                                <a href="{{route('admin.business-accounts.edit', $businessAccount->id)}}" class="btn btn-circle blue btn-sm">Edit</a>
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
                                                <div class="col-md-3 col-4">
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
                                    <header>Monthly Active Users</header>
                                </div>
                                <div class="card-body no-padding height-9">
                                    <?php
                                    $years = range(date('Y'), 2020);
                                    $months = array(
                                        'January',
                                        'February',
                                        'March',
                                        'April',
                                        'May',
                                        'June',
                                        'July ',
                                        'August',
                                        'September',
                                        'October',
                                        'November',
                                        'December',
                                    );
                                    ?>
                                    <div class="row mb-3">
                                        <div class="col-12 col-md-6 text-end d-flex"></div>
                                        <div class="col-12 col-md-6 text-end d-flex">
                                            <select name="year" id="year" class="form-control">
                                                <option value="" disabled>--Select Year--</option>
                                                @foreach($years as $year)
                                                    <option value="{{$year}}" {{$year == date('Y') ? 'selected':''}}>{{$year}}</option>
                                                @endforeach
                                            </select>
                                            <select name="month" id="month" class="form-control mx-1">
                                                <option value="" disabled>--Select Year--</option>
                                                @foreach($months as $i => $month)
                                                    <option value="{{$i + 1}}" {{$i+1 == date('m') ? 'selected':''}}>
                                                        {{$month}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Employee">
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
                                                {{ trans('cruds.employee.fields.contact') }}
                                            </th>
                                            <th>
                                                {{ trans('cruds.employee.fields.genid') }}
                                            </th>
                                            <th>
                                                Check ins
                                            </th>
                                        </tr>
                                        </thead>
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
                        <header>Business Locations</header>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @forelse($businessAccount->businessLocations as $location)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-head text-center text-capitalize">
                                            {{$location->name}}
                                        </div>
                                        <div class="item active qr-image">
                                            <img src="{{asset('storage/uploads/'.$location->qr)}}"
                                                 alt="">
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-6 text-center">
                                                    <a href="{{asset('storage/uploads/'.$location->qr)}}" download="{{$location->name}}-qr">
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
                                            No Locations Yet
                                        </header>
                                        <a href="{{ route('admin.business-locations.create') }}" id="addRow" class="btn btn-info">
                                            Add New Location<i class="fa fa-plus"></i>
                                        </a>
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
        $(function () {
            _token = $('meta[name="csrf-token"]').attr('content')
            let dtOverrideGlobals = {
                buttons: {},
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                searching: false,
                "lengthChange": false,
                ajax: {
                    headers: {'x-csrf-token': _token},
                    url: "{{ route('admin.business-accounts.mostActive') }}",
                    data: function (data){
                        data.year = $('#year').val();
                        data.month = $('#month').val();
                        data.bs_id = '{{$businessAccount->id}}';
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'emp_id', name: 'emp_id' },
                    { data: 'contact', name: 'contact' },
                    { data: 'genid', name: 'genid' },
                    { data: 'check_ins', name: 'check_ins' }
                ],
                orderCellsTop: true,
                order: [[ 5, 'desc' ]],
                pageLength: 10,
            };
            let table = $('.datatable-Employee').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

            $('#year,#month').on('change', function (){
                const month = $('#month').val();
                const year = $('#year').val();

                if (month && year){
                    table.ajax.reload()
                }
            });
            $('#year').on('change', disableMonths)
            disableMonths()
        });

        function disableMonths(){
            const year = $('#year').val();
            const date = new Date();
            //if this year
            if (year == date.getFullYear()){
                for (let i = date.getMonth() + 2; i <= 12; i++){
                    $(`#month option[value="${i}"]`).prop('disabled', true)
                }
            }else {
                $('#month option').prop('disabled', false);
            }
        }
    </script>
@endsection
