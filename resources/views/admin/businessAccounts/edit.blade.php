@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.businessAccount.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.business-accounts.update", [$businessAccount->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="bsid">{{ trans('cruds.businessAccount.fields.bsid') }}</label>
                <input class="form-control {{ $errors->has('bsid') ? 'is-invalid' : '' }}" type="text" name="bsid" id="bsid" value="{{ old('bsid', $businessAccount->bsid) }}" required>
                @if($errors->has('bsid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bsid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessAccount.fields.bsid_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="bs_name">{{ trans('cruds.businessAccount.fields.bs_name') }}</label>
                <input class="form-control {{ $errors->has('bs_name') ? 'is-invalid' : '' }}" type="text" name="bs_name" id="bs_name" value="{{ old('bs_name', $businessAccount->bs_name) }}" required>
                @if($errors->has('bs_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bs_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessAccount.fields.bs_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bs_location">{{ trans('cruds.businessAccount.fields.bs_location') }}</label>
                <input class="form-control {{ $errors->has('bs_location') ? 'is-invalid' : '' }}" type="text" name="bs_location" id="bs_location" value="{{ old('bs_location', $businessAccount->bs_location) }}">
                @if($errors->has('bs_location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bs_location') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessAccount.fields.bs_location_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="bs_contact">{{ trans('cruds.businessAccount.fields.bs_contact') }}</label>
                <input class="form-control {{ $errors->has('bs_contact') ? 'is-invalid' : '' }}" type="text" name="bs_contact" id="bs_contact" value="{{ old('bs_contact', $businessAccount->bs_contact) }}" required>
                @if($errors->has('bs_contact'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bs_contact') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessAccount.fields.bs_contact_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bs_email">{{ trans('cruds.businessAccount.fields.bs_email') }}</label>
                <input class="form-control {{ $errors->has('bs_email') ? 'is-invalid' : '' }}" type="text" name="bs_email" id="bs_email" value="{{ old('bs_email', $businessAccount->bs_email) }}">
                @if($errors->has('bs_email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bs_email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessAccount.fields.bs_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bs_logo">{{ trans('cruds.businessAccount.fields.bs_logo') }}</label>
                <input class="form-control {{ $errors->has('bs_logo') ? 'is-invalid' : '' }}" type="text" name="bs_logo" id="bs_logo" value="{{ old('bs_logo', $businessAccount->bs_logo) }}">
                @if($errors->has('bs_logo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bs_logo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessAccount.fields.bs_logo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bs_industry">{{ trans('cruds.businessAccount.fields.bs_industry') }}</label>
                <input class="form-control {{ $errors->has('bs_industry') ? 'is-invalid' : '' }}" type="text" name="bs_industry" id="bs_industry" value="{{ old('bs_industry', $businessAccount->bs_industry) }}">
                @if($errors->has('bs_industry'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bs_industry') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessAccount.fields.bs_industry_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="employees">{{ trans('cruds.businessAccount.fields.employees') }}</label>
                <input class="form-control {{ $errors->has('employees') ? 'is-invalid' : '' }}" type="number" name="employees" id="employees" value="{{ old('employees', $businessAccount->employees) }}" step="1">
                @if($errors->has('employees'))
                    <div class="invalid-feedback">
                        {{ $errors->first('employees') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessAccount.fields.employees_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection