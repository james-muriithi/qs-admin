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
                    <div class="page-title">{{ trans('cruds.businessLocation.title_singular') }} {{ trans('global.list') }}</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                        <i class="fa fa-home"></i>&nbsp;
                        <a class="parent-item" href="{{route('admin.home')}}">
                            {{trans('global.home')}}
                        </a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">{{ trans('cruds.businessLocation.title_singular') }} {{ trans('global.list') }}</li>
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
                        <div class="tab-pane fontawesome-demo active" id="tab1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-box">
                                        <div class="card-head">
                                            <header>All {{ trans('cruds.businessLocation.title_singular') }}s</header>
                                            <div class="tools">
                                                <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                                <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                            </div>
                                        </div>
                                        <div class="card-body ">
                                            <div class="row mb-3">
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
                                                            {{ trans('cruds.businessLocation.fields.id') }}
                                                        </th>
                                                        <th>
                                                            {{ trans('cruds.businessLocation.fields.name') }}
                                                        </th>
                                                        <th>
                                                            {{ trans('cruds.businessLocation.fields.bsid') }}
                                                        </th>
                                                        <th>
                                                            {{ trans('cruds.businessLocation.fields.coordinates') }}
                                                        </th>
                                                        <th>
                                                            {{ trans('cruds.businessLocation.fields.polygon') }}
                                                        </th>
                                                        <th>
                                                            {{ trans('cruds.businessLocation.fields.status') }}
                                                        </th>
                                                        <th>
                                                            {{ trans('cruds.businessLocation.fields.qr') }}
                                                        </th>
                                                        <th>
                                                            &nbsp;
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($businessLocations as $key => $businessLocation)
                                                        <tr data-entry-id="{{ $loop->index }}">
                                                            <td>
                                                                {{ $businessLocation->id ?? '' }}
                                                            </td>
                                                            <td>
                                                                {{ $businessLocation->name ?? '' }}
                                                            </td>
                                                            <td>
                                                                {{ $businessLocation->business->BS_Name ?? '' }}
                                                            </td>
                                                            <td>
                                                                {{ $businessLocation->coordinates ?? '' }}
                                                            </td>
                                                            <td>
                                                                {{ $businessLocation->polygon ?? '' }}
                                                            </td>
                                                            <td>
                                                                {{ $businessLocation->status ?? '' }}
                                                            </td>
                                                            <td>
                                                                <img class="img-thumbnail" height="40" width="40" src="{{asset('storage/uploads/'.$businessLocation->qr)}}">
                                                            </td>
                                                            <td>
                                                                @can('business_location_show')
                                                                    <a class="btn btn-xs btn-primary" download="{{$businessLocation->qr}}-nairobi" title="{{ trans('global.view') }}" href="{{ asset('storage/uploads/'.$businessLocation->qr) }}">
                                                                        <i class="fa fa-download"></i>
                                                                    </a>
                                                                @endcan

                                                                @can('business_location_edit')
                                                                    <a class="btn btn-xs btn-info" href="{{ route('admin.business-locations.edit', $businessLocation->id) }}" title="{{ trans('global.edit') }}">
                                                                        <i class="fa fa-pencil "></i>
                                                                    </a>
                                                                @endcan

                                                                @can('business_location_delete')
                                                                    <form action="{{ route('admin.business-locations.destroy', $businessLocation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
                        <div class="tab-pane" id="tab2">
                            <div class="row">
                                <div class="row mb-4">
                                    <div class="col-md-6 col-sm-6 col-6"></div>
                                    <div class="col-md-6 col-sm-6 col-6 text-end">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.business-accounts.create') }}" id="addRow" class="btn btn-info">
                                                Add New <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
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
