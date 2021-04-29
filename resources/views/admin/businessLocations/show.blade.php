@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.businessLocation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.business-locations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.businessLocation.fields.id') }}
                        </th>
                        <td>
                            {{ $businessLocation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessLocation.fields.name') }}
                        </th>
                        <td>
                            {{ $businessLocation->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessLocation.fields.bsid') }}
                        </th>
                        <td>
                            {{ $businessLocation->bsid->bsid ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessLocation.fields.coordinates') }}
                        </th>
                        <td>
                            {{ $businessLocation->coordinates }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessLocation.fields.qr') }}
                        </th>
                        <td>
                            @if($businessLocation->qr)
                                <a href="{{ $businessLocation->qr->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $businessLocation->qr->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.business-locations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection