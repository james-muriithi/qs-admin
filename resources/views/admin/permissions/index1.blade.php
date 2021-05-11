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
                    <div class="page-title">{{ trans('cruds.permission.title') }} {{ trans('global.list') }}</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                        <i class="fa fa-home"></i>&nbsp;
                        <a class="parent-item" href="{{route('admin.home')}}">
                            {{trans('global.home')}}
                        </a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">{{ trans('cruds.permission.title') }} {{ trans('global.list') }}</li>
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
                                    <header>All {{ trans('cruds.permission.title') }}</header>
                                    <div class="tools">
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-6">
                                            <div class="btn-group">
                                                <a href="{{ route('admin.permissions.create') }}" id="addRow" class="btn btn-info">
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
                                                    {{ trans('cruds.permission.fields.id') }}
                                                </th>
                                                <th>
                                                    {{ trans('cruds.permission.fields.title') }}
                                                </th>
                                                <th>
                                                    &nbsp;
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($permissions as $key => $permission)
                                                <tr data-entry-id="{{ $permission->id }}">
                                                    <td>
                                                        {{ $permission->id ?? '' }}
                                                    </td>
                                                    <td>
                                                        {{ $permission->title ?? '' }}
                                                    </td>
                                                    <td>
                                                        @can('permission_show')
                                                            <a class="btn btn-xs btn-primary" href="{{ route('admin.permissions.show', $permission->id) }}">
                                                                {{ trans('global.view') }}
                                                            </a>
                                                        @endcan

                                                        @can('permission_edit')
                                                            <a class="btn btn-xs btn-info" href="{{ route('admin.permissions.edit', $permission->id) }}">
                                                                {{ trans('global.edit') }}
                                                            </a>
                                                        @endcan

                                                        @can('permission_delete')
                                                            <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
                buttons: [],
            });
        })
    </script>
@endsection
