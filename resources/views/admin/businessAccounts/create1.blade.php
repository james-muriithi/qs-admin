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
                    <div class="page-title">{{ trans('cruds.businessAccount.title_singular') }} {{ trans('global.create') }}</div>
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
                            {{ trans('cruds.businessAccount.title_singular') }}
                        </a>&nbsp;<i class="fa fa-angle-right">
                        </i>
                    </li>
                    <li class="active">
                        {{ trans('global.create') }}
                    </li>
                </ol>
            </div>
        </div>
        <!-- start widget -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-head">
                        <header>Basic Information</header>
                    </div>
                    <form method="POST" id="myForm" action="{{ route("admin.business-accounts.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body row">
                            <div class="col-lg-6 p-t-20">
                                <div class="form-group">
                                    <label class="required" for="bsid">{{ trans('cruds.businessAccount.fields.bsid') }}</label>
                                    <input class="form-control {{ $errors->has('BS_ID') ? 'is-invalid' : '' }}" type="text" name="BS_ID" id="bsid" value="{{ old('BS_ID', '') }}" required>
                                    @if($errors->has('BS_ID'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('BS_ID') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.businessAccount.fields.bsid_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="form-group">
                                    <label class="required" for="bs_name">{{ trans('cruds.businessAccount.fields.bs_name') }}</label>
                                    <input class="form-control {{ $errors->has('BS_Name') ? 'is-invalid' : '' }}" type="text" name="BS_Name" id="bs_name" value="{{ old('BS_Name', '') }}" required>
                                    @if($errors->has('BS_Name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('BS_Name') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.businessAccount.fields.bs_name_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="form-group">
                                    <label for="bs_location">{{ trans('cruds.businessAccount.fields.bs_location') }}</label>
                                    <input class="form-control {{ $errors->has('bs_location') ? 'is-invalid' : '' }}" type="text" name="BS_Location" id="bs_location" value="{{ old('BS_Location', '') }}">
                                    @if($errors->has('BS_Location'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('BS_Location') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.businessAccount.fields.bs_location_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="form-group">
                                    <label class="required" for="bs_contact">{{ trans('cruds.businessAccount.fields.bs_contact') }}</label>
                                    <input class="form-control {{ $errors->has('BS_Contact') ? 'is-invalid' : '' }}" type="text" name="BS_Contact" id="bs_contact" value="{{ old('BS_Contact', '') }}" required>
                                    @if($errors->has('BS_Contact'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('BS_Contact') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.businessAccount.fields.bs_contact_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="form-group">
                                    <label for="bs_email">{{ trans('cruds.businessAccount.fields.bs_email') }}</label>
                                    <input class="form-control {{ $errors->has('BS_Email') ? 'is-invalid' : '' }}" type="text" name="BS_Email" id="bs_email" value="{{ old('BS_Email', '') }}">
                                    @if($errors->has('BS_Email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('BS_Email') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.businessAccount.fields.bs_email_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="form-group">
                                    <label for="bs_industry">{{ trans('cruds.businessAccount.fields.bs_industry') }}</label>
                                    <input class="form-control {{ $errors->has('BS_Industry') ? 'is-invalid' : '' }}" type="text" name="BS_Industry" id="bs_industry" value="{{ old('BS_Industry', '') }}">
                                    @if($errors->has('BS_Industry'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('BS_Industry') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.businessAccount.fields.bs_industry_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="form-group">
                                    <label for="employees">{{ trans('cruds.businessAccount.fields.employees') }}</label>
                                    <input class="form-control {{ $errors->has('Employees') ? 'is-invalid' : '' }}" type="number" name="Employees" id="employees" value="{{ old('Employees', '') }}" step="1">
                                    @if($errors->has('Employees'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('Employees') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.businessAccount.fields.employees_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="form-group">
                                    <label for="access_code">{{ trans('cruds.businessAccount.fields.access_code') }}</label>
                                    <input class="form-control {{ $errors->has('Access_Code') ? 'is-invalid' : '' }}" type="password" name="Access_Code" id="access_code">
                                    @if($errors->has('Access_Code'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('Access_Code') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.businessAccount.fields.access_code_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-12 p-t-20">
                                <div class="form-group">
                                    <label for="bs_logo">{{ trans('cruds.businessAccount.fields.bs_logo') }}</label>
                                    <div class="needsclick dropzone {{ $errors->has('BS_Logo') ? 'is-invalid' : '' }}" id="bslogo-dropzone">
                                    </div>
                                    @if($errors->has('BS_Logo'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('BS_Logo') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
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
        Dropzone.options.bslogoDropzone = {
            url: '{{ route('admin.business-accounts.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096,
            },
            success: function (file, response) {
                $('form').find('input[name="BS_Logo"]').remove()
                $('form').append('<input type="hidden" name="BS_Logo" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="BS_Logo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {

            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
@endsection
