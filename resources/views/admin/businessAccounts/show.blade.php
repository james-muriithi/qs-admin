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
                            {{ $businessAccount->BS_ID }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessAccount.fields.bs_name') }}
                        </th>
                        <td>
                            {{ $businessAccount->BS_Name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessAccount.fields.bs_location') }}
                        </th>
                        <td>
                            {{ $businessAccount->BS_Location }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessAccount.fields.bs_contact') }}
                        </th>
                        <td>
                            {{ $businessAccount->BS_Contact }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessAccount.fields.bs_email') }}
                        </th>
                        <td>
                            {{ $businessAccount->BS_Email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessAccount.fields.bs_industry') }}
                        </th>
                        <td>
                            {{ $businessAccount->BS_Industry }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessAccount.fields.employees') }}
                        </th>
                        <td>
                            {{ $businessAccount->Employees }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.businessAccount.fields.date_created') }}
                        </th>
                        <td>
                            {{ $businessAccount->Date_Created }}
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
            @includeIf('admin.businessAccounts.relationships.bsidBusinessLocations', ['businessLocations' => $businessAccount->businessLocations])
        </div>
    </div>
</div>

@endsection
