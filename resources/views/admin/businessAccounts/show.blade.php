@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.businessAccount.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.business-accounts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.businessAccount.fields.id') }}
                        </th>
                        <td>
                            {{ $businessAccount->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessAccount.fields.bsid') }}
                        </th>
                        <td>
                            {{ $businessAccount->bsid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessAccount.fields.bs_name') }}
                        </th>
                        <td>
                            {{ $businessAccount->bs_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessAccount.fields.bs_location') }}
                        </th>
                        <td>
                            {{ $businessAccount->bs_location }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessAccount.fields.bs_contact') }}
                        </th>
                        <td>
                            {{ $businessAccount->bs_contact }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessAccount.fields.bs_email') }}
                        </th>
                        <td>
                            {{ $businessAccount->bs_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessAccount.fields.bs_logo') }}
                        </th>
                        <td>
                            {{ $businessAccount->bs_logo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessAccount.fields.bs_industry') }}
                        </th>
                        <td>
                            {{ $businessAccount->bs_industry }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessAccount.fields.employees') }}
                        </th>
                        <td>
                            {{ $businessAccount->employees }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessAccount.fields.date_created') }}
                        </th>
                        <td>
                            {{ $businessAccount->date_created }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.business-accounts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#bsid_business_locations" role="tab" data-toggle="tab">
                {{ trans('cruds.businessLocation.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="bsid_business_locations">
            @includeIf('admin.businessAccounts.relationships.bsidBusinessLocations', ['businessLocations' => $businessAccount->bsidBusinessLocations])
        </div>
    </div>
</div>

@endsection