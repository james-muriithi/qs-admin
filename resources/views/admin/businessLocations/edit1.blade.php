@extends('layouts.admin1')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/material_style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" />
    <style type="text/css">
        .bootstrap-tagsinput{
            width: 100%;
        }
        .label-info{
            background-color: #17a2b8;

        }
        .label {
            display: inline-block;
            padding: .25em .4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,
            border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
    </style>
@endsection
@section('content')
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">{{ trans('cruds.businessLocation.title_singular') }} {{ trans('global.edit') }}</div>
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
                        <a class="parent-item" href="{{route('admin.business-locations.index')}}">
                            {{ trans('cruds.businessLocation.title_singular') }}
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
                    <form method="POST" id="myForm" action="{{ route("admin.business-locations.update", [$businessLocation->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card-body row">
                            <div class="col-lg-6 p-t-20">
                                <div class="form-group">
                                    <label for="bsid_id">{{ trans('cruds.businessLocation.fields.bsid') }}</label>
                                    <select class="form-control select2 {{ $errors->has('bsid') ? 'is-invalid' : '' }}" name="bs_id" id="bsid_id">
                                        @foreach($bsids as $id => $entry)
                                            <option value="{{ $id }}" {{ (old('bs_id') ? old('bs_id') : $businessLocation->business->BS_ID ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('bsid'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('bsid') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.businessLocation.fields.bsid_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="form-group">
                                    <label class="required" for="name">{{ trans('cruds.businessLocation.fields.name') }}</label>
                                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $businessLocation->name) }}" required>
                                    @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.businessLocation.fields.name_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="form-group">
                                    <label for="coordinates">{{ trans('cruds.businessLocation.fields.coordinates') }}</label>
                                    <input class="form-control {{ $errors->has('coordinates') ? 'is-invalid' : '' }}" type="text" name="coordinates" id="coordinates" value="{{ old('coordinates', $businessLocation->coordinates) }}">
                                    @if($errors->has('coordinates'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('coordinates') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.businessLocation.fields.coordinates_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="form-group">
                                    <label for="polygon">{{ trans('cruds.businessLocation.fields.polygon') }}</label>
                                    <select class="form-control {{ $errors->has('polygon') ? 'is-invalid' : '' }}" data-role="tagsinput" name="polygon[]" id="polygon" multiple>

                                    </select>
                                    @if($errors->has('polygon'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('polygon') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.businessLocation.fields.polygon_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="status" value="1" {{old('coordinates', $businessLocation->status) == 1 ? 'checked' : ''}}> Polygon Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 p-t-20">
                                <div class="form-group">
                                    <label class="required" for="qr">{{ trans('cruds.businessLocation.fields.qr') }}</label>
                                    <div class="needsclick dropzone {{ $errors->has('qr') ? 'is-invalid' : '' }}" id="qr-dropzone">
                                    </div>
                                    @if($errors->has('qr'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('qr') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.businessLocation.fields.qr_helper') }}</span>
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
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="{{asset('js/tags-input.js')}}"></script>
    <script>
        Dropzone.options.qrDropzone = {
            url: '{{ route('admin.business-locations.storeMedia') }}',
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
                $('form').find('input[name="qr"]').remove()
                $('form').append('<input type="hidden" name="qr" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="qr"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
                @if(isset($businessLocation) && $businessLocation->qr)
                var file = {!! json_encode(['name' => $businessLocation->qr, 'preview' => asset('storage/uploads/'.$businessLocation->qr),
                'file_name' => $businessLocation->qr
                ,'size' => filesize(public_path('storage/uploads/'.$businessLocation->qr))]) !!}
                    this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview)
                console.log(this.options.thumbnail)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="qr" value="' + file.file_name + '">')
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
        $('#polygon').tagsinput({
            trimValue: true,
            allowDuplicates: true,
            confirmKeys: [13, 32],
        });
        @if($businessLocation->polygon)
        @php($coords = explode(' ', $businessLocation->polygon))
        @foreach($coords as $coord)
        $('#polygon').tagsinput('add', '{{$coord}}');
        @endforeach
        @endif
    </script>
@endsection
