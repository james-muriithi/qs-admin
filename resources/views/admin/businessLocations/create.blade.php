@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.businessLocation.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.business-locations.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.businessLocation.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessLocation.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bsid_id">{{ trans('cruds.businessLocation.fields.bsid') }}</label>
                <select class="form-control select2 {{ $errors->has('bsid') ? 'is-invalid' : '' }}" name="bsid_id" id="bsid_id">
                    @foreach($bsids as $id => $entry)
                        <option value="{{ $id }}" {{ old('bsid_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('bsid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bsid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessLocation.fields.bsid_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="coordinates">{{ trans('cruds.businessLocation.fields.coordinates') }}</label>
                <input class="form-control {{ $errors->has('coordinates') ? 'is-invalid' : '' }}" type="text" name="coordinates" id="coordinates" value="{{ old('coordinates', '') }}">
                @if($errors->has('coordinates'))
                    <div class="invalid-feedback">
                        {{ $errors->first('coordinates') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessLocation.fields.coordinates_helper') }}</span>
            </div>
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
      height: 4096
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
      var file = {!! json_encode($businessLocation->qr) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="qr" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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
</script>
@endsection