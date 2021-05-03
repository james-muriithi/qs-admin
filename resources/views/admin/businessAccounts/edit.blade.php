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
                <input class="form-control {{ $errors->has('BS_ID') ? 'is-invalid' : '' }}" type="text" name="BS_ID" id="bsid" value="{{ old('BS_ID', $businessAccount->BS_ID) }}" required>
                @if($errors->has('BS_ID'))
                    <div class="invalid-feedback">
                        {{ $errors->first('BS_ID') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessAccount.fields.bsid_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="bs_name">{{ trans('cruds.businessAccount.fields.bs_name') }}</label>
                <input class="form-control {{ $errors->has('BS_Name') ? 'is-invalid' : '' }}" type="text" name="BS_Name" id="bs_name" value="{{ old('BS_Name', $businessAccount->BS_Name) }}" required>
                @if($errors->has('BS_Name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('BS_Name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessAccount.fields.bs_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bs_location">{{ trans('cruds.businessAccount.fields.BS_Location') }}</label>
                <input class="form-control {{ $errors->has('bs_location') ? 'is-invalid' : '' }}" type="text" name="BS_Location" id="bs_location" value="{{ old('BS_Location', $businessAccount->BS_Location) }}">
                @if($errors->has('BS_Location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('BS_Location') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessAccount.fields.bs_location_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="bs_contact">{{ trans('cruds.businessAccount.fields.bs_contact') }}</label>
                <input class="form-control {{ $errors->has('BS_Contact') ? 'is-invalid' : '' }}" type="text" name="BS_Contact" id="bs_contact" value="{{ old('BS_Contact', $businessAccount->BS_Contact) }}" required>
                @if($errors->has('BS_Contact'))
                    <div class="invalid-feedback">
                        {{ $errors->first('BS_Contact') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessAccount.fields.bs_contact_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bs_email">{{ trans('cruds.businessAccount.fields.bs_email') }}</label>
                <input class="form-control {{ $errors->has('BS_Email') ? 'is-invalid' : '' }}" type="text" name="BS_Email" id="bs_email" value="{{ old('BS_Email', $businessAccount->BS_Email) }}">
                @if($errors->has('BS_Email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('BS_Email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessAccount.fields.bs_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bs_industry">{{ trans('cruds.businessAccount.fields.bs_industry') }}</label>
                <input class="form-control {{ $errors->has('bs_industry') ? 'is-invalid' : '' }}" type="text" name="BS_Industry" id="bs_industry" value="{{ old('BS_Industry', $businessAccount->BS_Industry) }}">
                @if($errors->has('BS_Industry'))
                    <div class="invalid-feedback">
                        {{ $errors->first('BS_Industry') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessAccount.fields.bs_industry_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="employees">{{ trans('cruds.businessAccount.fields.employees') }}</label>
                <input class="form-control {{ $errors->has('employees') ? 'is-invalid' : '' }}" type="number" name="Employees" id="employees" value="{{ old('Employees', $businessAccount->Employees) }}" step="1">
                @if($errors->has('Employees'))
                    <div class="invalid-feedback">
                        {{ $errors->first('Employees') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessAccount.fields.employees_helper') }}</span>
            </div>
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
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
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
                height: 4096
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
                @if(isset($businessAccount) && $businessAccount->BS_Logo && file_exists($businessAccount->logoFullPath))
                var file = {!! json_encode(['name' => $businessAccount->BS_Logo, 'preview' => $businessAccount->logoUrl,
        'file_name' => $businessAccount->BS_Logo
        ,'size' => filesize($businessAccount->logoFullPath)]) !!}
                    this.options.resize(file, 200, 200)
                    this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview)

                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="BS_Logo" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
                $('.dz-image').last().find('img').attr({width: '120px', height: '120px'});
                @endif
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
        $(".select2").select2({disabled: 'readonly'});
    </script>
@endsection
