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
                    <div class="page-title">{{ trans('cruds.businessAccount.title_singular') }} {{ trans('global.list') }}</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                        <i class="fa fa-home"></i>&nbsp;
                        <a class="parent-item" href="{{route('admin.home')}}">
                            {{trans('global.home')}}
                        </a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">{{ trans('cruds.businessAccount.title_singular') }} {{ trans('global.list') }}</li>
                </ol>
            </div>
        </div>
        <!-- start widget -->

        <div class="row">
            <viv class="col-md-12">
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
                                            <header>All {{ trans('cruds.businessAccount.title_singular') }}s</header>
                                            <div class="tools">
                                                <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                                <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                            </div>
                                        </div>
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-6">
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.business-accounts.create') }}" id="addRow" class="btn btn-info">
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
                                                            {{ trans('cruds.businessAccount.fields.id') }}
                                                        </th>
                                                        <th>
                                                            {{ trans('cruds.businessAccount.fields.bsid') }}
                                                        </th>
                                                        <th>
                                                            {{ trans('cruds.businessAccount.fields.bs_name') }}
                                                        </th>
                                                        <th>
                                                            {{ trans('cruds.businessAccount.fields.bs_location') }}
                                                        </th>
                                                        <th>
                                                            {{ trans('cruds.businessAccount.fields.bs_contact') }}
                                                        </th>
                                                        <th>
                                                            {{ trans('cruds.businessAccount.fields.bs_email') }}
                                                        </th>
                                                        <th>
                                                            {{ trans('cruds.businessAccount.fields.bs_industry') }}
                                                        </th>
                                                        <th>
                                                            {{ trans('cruds.businessAccount.fields.employees') }}
                                                        </th>
                                                        <th>
                                                            {{ trans('cruds.businessAccount.fields.date_created') }}
                                                        </th>
                                                        <th>
                                                            &nbsp;
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($businessAccounts as $key => $businessAccount)
                                                        <tr data-entry-id="{{ $loop->index }}">
                                                            <td>
                                                                {{ $businessAccount->id ?? '' }}
                                                            </td>
                                                            <td>
                                                                {{ $businessAccount->BS_ID ?? '' }}
                                                            </td>
                                                            <td>
                                                                {{ $businessAccount->BS_Name ?? '' }}
                                                            </td>
                                                            <td>
                                                                {{ $businessAccount->BS_Location ?? '' }}
                                                            </td>
                                                            <td>
                                                                {{ $businessAccount->BS_Contact ?? '' }}
                                                            </td>
                                                            <td>
                                                                {{ $businessAccount->BS_Email ?? '' }}
                                                            </td>
                                                            <td>
                                                                {{ $businessAccount->BS_Industry ?? '' }}
                                                            </td>
                                                            <td>
                                                                {{ $businessAccount->Employees ?? '' }}
                                                            </td>
                                                            <td>
                                                                {{ $businessAccount->Date_Created ?? '' }}
                                                            </td>
                                                            <td>
                                                                @can('business_account_show')
                                                                    <a class="btn btn-xs btn-primary" title="{{ trans('global.view') }}" href="{{ route('admin.business-accounts.show', $businessAccount->id) }}">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </a>
                                                                @endcan

                                                                @can('business_account_edit')
                                                                    <a class="btn btn-xs btn-info" href="{{ route('admin.business-accounts.edit', $businessAccount->id) }}" title="{{ trans('global.edit') }}">
                                                                        <i class="fa fa-eye "></i>
                                                                    </a>
                                                                @endcan

                                                                @can('business_account_deletes')
                                                                    <form action="{{ route('admin.business-accounts.destroy', $businessAccount->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                                        <input type="hidden" name="_method" value="DELETE">
                                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                        <button type="submit" class="btn btn-xs btn-danger" title="{{ trans('global.delete') }}">
                                                                            <i class="fa fa-trash-o "></i>
                                                                        </button>
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
                                @foreach($paginatedBusinessAccounts as $businessAccount)
                                    <div class="col-md-4">
                                        <div class="card card-box">
                                            <div class="card-body no-padding ">
                                                <div class="doctor-profile">
                                                    <img src="{{$businessAccount->logoUrl}}" class="doctor-pic" alt="">
                                                    <div class="profile-usertitle">
                                                        <div class="doctor-name">{{$businessAccount->BS_Name}}</div>
                                                        <div class="name-center"> {{$businessAccount->BS_Email}} </div>
                                                    </div>
                                                    <p>{{$businessAccount->BS_Location}}</p>
                                                    <div>
                                                        <p><i class="fa fa-phone"></i><a href="tel:(123)456-7890">
                                                            {{$businessAccount->BS_Contact}}</a></p>
                                                    </div>
                                                    <div class="profile-userbuttons">
                                                        <a href="{{route('admin.business-accounts.show', $businessAccount->id)}}"
                                                           class="btn btn-circle deepPink-bgcolor btn-sm">
                                                            {{trans('global.view')}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="fr">
                                    {{$paginatedBusinessAccounts->links('pagination::bootstrap-4')}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </viv>
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
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script>
        $(".datatable-BusinessAccount").DataTable({
            dom: "Bfrtip",
            buttons: ["copy", "csv", "excel", "pdf", "print"],
        });
    </script>
@endsection
