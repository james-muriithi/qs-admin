@extends('layouts.admin1')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/material_style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
@endsection
@section('content')
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">{{ trans('cruds.employee.title_singular') }} {{ trans('global.edit') }}</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                        <i class="fa fa-home"></i>&nbsp;
                        <a class="parent-item" href="{{route('admin.home')}}">
                            {{trans('global.home')}}
                        </a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <i class="fa fa-user"></i>&nbsp;
                        <a class="parent-item" href="{{route('admin.employees.index')}}">
                            {{ trans('cruds.employee.title_singular') }}
                        </a>&nbsp;<i class="fa fa-angle-right">
                        </i>
                    </li>
                    <li>
                        <a class="parent-item" href="{{route('admin.employees.show', $employee->id)}}">
                            {{ $employee->emp_id }}
                        </a>&nbsp;<i class="fa fa-angle-right">
                        </i>
                    </li>
                    <li class="active">
                        {{ trans('global.edit') }}
                    </li>
                </ol>
            </div>
        </div>
        <!-- start widget -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-head">
                        <header>Edit Information</header>
                    </div>
                    <form method="POST" id="myForm" action="{{ route("admin.employees.update", $employee->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body row">
                            <div class="col-lg-6 p-t-20">
                                <div class="form-group">
                                    <label class="required" for="employeeid">{{ trans('cruds.employee.fields.emp_id') }}</label>
                                    <input class="form-control {{ $errors->has('employeeid') ? 'is-invalid' : '' }}" type="text" name="emp_id" id="employeeid" value="{{ old('emp_id', $employee->emp_id) }}" readonly>
                                    @if($errors->has('emp_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('emp_id') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.employee.fields.emp_id_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="form-group">
                                    <label for="bsid_id">{{ trans('cruds.employee.fields.organisation') }}</label>
                                    <select class="form-control select2 {{ $errors->has('BS_ID') ? 'is-invalid' : '' }}" name="BS_ID" id="bsid_id">
                                        @foreach($bsids as $id => $entry)
                                            <option value="{{ $id }}" {{ (old('BS_ID') ? old('BS_ID') : $employee->organisation->BS_ID ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('BS_ID'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('BS_ID') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.employee.fields.bsid_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="form-group">
                                    <label for="name">{{ trans('cruds.employee.fields.name') }}</label>
                                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $employee->name) }}">
                                    @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.employee.fields.name_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="form-group">
                                    <label for="department">{{ trans('cruds.employee.fields.department') }}</label>
                                    <input class="form-control {{ $errors->has('department') ? 'is-invalid' : '' }}" type="text" name="department" id="department" value="{{ old('department', $employee->department) }}">
                                    @if($errors->has('department'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('department') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.employee.fields.department_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="form-group">
                                    <label for="designation">{{ trans('cruds.employee.fields.designation') }}</label>
                                    <input class="form-control {{ $errors->has('designation') ? 'is-invalid' : '' }}" type="text" name="designation" id="designation" value="{{ old('designation', $employee->designation) }}">
                                    @if($errors->has('designation'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('designation') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.employee.fields.designation_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="form-group">
                                    <label for="contact">{{ trans('cruds.employee.fields.contact') }}</label>
                                    <input class="form-control {{ $errors->has('contact') ? 'is-invalid' : '' }}" type="text" name="contact" id="contact" value="{{ old('contact', $employee->contact) }}">
                                    @if($errors->has('contact'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('contact') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.employee.fields.contact_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="form-group">
                                    <label for="email">{{ trans('cruds.employee.fields.email') }}</label>
                                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', $employee->email) }}">
                                    @if($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.employee.fields.email_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="form-group">
                                    <label for="password">{{ trans('cruds.employee.fields.password') }}</label>
                                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="text" name="password" id="password" value="{{ old('password', $employee->password) }}">
                                    @if($errors->has('password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.employee.fields.password_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="form-group">
                                    <label>{{ trans('cruds.employee.fields.gender') }}</label>
                                    <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender">
                                        <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach(App\Models\Employee::GENDER_SELECT as $key => $label)
                                            <option value="{{ $key }}" {{ old('gender', $employee->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('gender'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('gender') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.employee.fields.gender_helper') }}</span>
                                </div>
                            </div>
                            {{--                            <div class="col-lg-12 p-t-20">--}}
                            {{--                                <div class="form-group">--}}
                            {{--                                    <label for="bs_logo">{{ trans('cruds.employee.fields.potraits') }}</label>--}}
                            {{--                                    <div class="needsclick dropzone {{ $errors->has('potraits') ? 'is-invalid' : '' }}" id="bslogo-dropzone">--}}
                            {{--                                    </div>--}}
                            {{--                                    @if($errors->has('potraits'))--}}
                            {{--                                        <div class="invalid-feedback">--}}
                            {{--                                            {{ $errors->first('potraits') }}--}}
                            {{--                                        </div>--}}
                            {{--                                    @endif--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            <div class="col-lg-12 p-t-20 text-center">
                                <button type="submit"
                                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">Submit</button>
                                <button type="button" onclick='document.getElementById("myForm").reset()'
                                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script>
        {{--Dropzone.options.bslogoDropzone = {--}}
        {{--    url: '{{ route('admin.business-accounts.storeMedia') }}',--}}
        {{--    maxFilesize: 2, // MB--}}
        {{--    acceptedFiles: '.jpeg,.jpg,.png,.gif',--}}
        {{--    maxFiles: 1,--}}
        {{--    addRemoveLinks: true,--}}
        {{--    headers: {--}}
        {{--        'X-CSRF-TOKEN': "{{ csrf_token() }}"--}}
        {{--    },--}}
        {{--    params: {--}}
        {{--        size: 2,--}}
        {{--        width: 4096,--}}
        {{--        height: 4096,--}}
        {{--    },--}}
        {{--    success: function (file, response) {--}}
        {{--        $('form').find('input[name="BS_Logo"]').remove()--}}
        {{--        $('form').append('<input type="hidden" name="BS_Logo" value="' + response.name + '">')--}}
        {{--    },--}}
        {{--    removedfile: function (file) {--}}
        {{--        file.previewElement.remove()--}}
        {{--        if (file.status !== 'error') {--}}
        {{--            $('form').find('input[name="BS_Logo"]').remove()--}}
        {{--            this.options.maxFiles = this.options.maxFiles + 1--}}
        {{--        }--}}
        {{--    },--}}
        {{--    init: function () {--}}

        {{--    },--}}
        {{--    error: function (file, response) {--}}
        {{--        if ($.type(response) === 'string') {--}}
        {{--            var message = response //dropzone sends it's own error messages in string--}}
        {{--        } else {--}}
        {{--            var message = response.errors.file--}}
        {{--        }--}}
        {{--        file.previewElement.classList.add('dz-error')--}}
        {{--        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')--}}
        {{--        _results = []--}}
        {{--        for (_i = 0, _len = _ref.length; _i < _len; _i++) {--}}
        {{--            node = _ref[_i]--}}
        {{--            _results.push(node.textContent = message)--}}
        {{--        }--}}

        {{--        return _results--}}
        {{--    }--}}
        {{--}--}}
    </script>
@endsection
