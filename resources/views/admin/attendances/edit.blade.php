@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.attendance.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.attendances.update", [$attendance->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="bsid_id">{{ trans('cruds.attendance.fields.bsid') }}</label>
                <select class="form-control select2 {{ $errors->has('bsid') ? 'is-invalid' : '' }}" name="bsid_id" id="bsid_id">
                    @foreach($bsids as $id => $entry)
                        <option value="{{ $id }}" {{ (old('bsid_id') ? old('bsid_id') : $attendance->bsid->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('bsid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bsid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendance.fields.bsid_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="employeeid_id">{{ trans('cruds.attendance.fields.employeeid') }}</label>
                <select class="form-control select2 {{ $errors->has('employeeid') ? 'is-invalid' : '' }}" name="employeeid_id" id="employeeid_id">
                    @foreach($employeeids as $id => $entry)
                        <option value="{{ $id }}" {{ (old('employeeid_id') ? old('employeeid_id') : $attendance->employeeid->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('employeeid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('employeeid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendance.fields.employeeid_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date">{{ trans('cruds.attendance.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $attendance->date) }}">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendance.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="time_in">{{ trans('cruds.attendance.fields.time_in') }}</label>
                <input class="form-control timepicker {{ $errors->has('time_in') ? 'is-invalid' : '' }}" type="text" name="time_in" id="time_in" value="{{ old('time_in', $attendance->time_in) }}">
                @if($errors->has('time_in'))
                    <div class="invalid-feedback">
                        {{ $errors->first('time_in') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendance.fields.time_in_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="time_out">{{ trans('cruds.attendance.fields.time_out') }}</label>
                <input class="form-control timepicker {{ $errors->has('time_out') ? 'is-invalid' : '' }}" type="text" name="time_out" id="time_out" value="{{ old('time_out', $attendance->time_out) }}">
                @if($errors->has('time_out'))
                    <div class="invalid-feedback">
                        {{ $errors->first('time_out') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendance.fields.time_out_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comment">{{ trans('cruds.attendance.fields.comment') }}</label>
                <textarea class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" name="comment" id="comment">{{ old('comment', $attendance->comment) }}</textarea>
                @if($errors->has('comment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendance.fields.comment_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="location">{{ trans('cruds.attendance.fields.location') }}</label>
                <input class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" type="text" name="location" id="location" value="{{ old('location', $attendance->location) }}">
                @if($errors->has('location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('location') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendance.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="area_info">{{ trans('cruds.attendance.fields.area_info') }}</label>
                <input class="form-control {{ $errors->has('area_info') ? 'is-invalid' : '' }}" type="text" name="area_info" id="area_info" value="{{ old('area_info', $attendance->area_info) }}">
                @if($errors->has('area_info'))
                    <div class="invalid-feedback">
                        {{ $errors->first('area_info') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendance.fields.area_info_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hours_in">{{ trans('cruds.attendance.fields.hours_in') }}</label>
                <input class="form-control {{ $errors->has('hours_in') ? 'is-invalid' : '' }}" type="text" name="hours_in" id="hours_in" value="{{ old('hours_in', $attendance->hours_in) }}">
                @if($errors->has('hours_in'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hours_in') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendance.fields.hours_in_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status">{{ trans('cruds.attendance.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="number" name="status" id="status" value="{{ old('status', $attendance->status) }}" step="1">
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.attendance.fields.status_helper') }}</span>
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