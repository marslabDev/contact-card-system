@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.photo.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.photos.update", [$photo->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="contact_card_id">{{ trans('cruds.photo.fields.contact_card') }}</label>
                <select class="form-control select2 {{ $errors->has('contact_card') ? 'is-invalid' : '' }}" name="contact_card_id" id="contact_card_id" required>
                    @foreach($contact_cards as $id => $entry)
                        <option value="{{ $id }}" {{ (old('contact_card_id') ? old('contact_card_id') : $photo->contact_card->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('contact_card'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_card') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.photo.fields.contact_card_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="photo">{{ trans('cruds.photo.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.photo.fields.photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="is_selected">{{ trans('cruds.photo.fields.is_selected') }}</label>
                <input class="form-control {{ $errors->has('is_selected') ? 'is-invalid' : '' }}" type="number" name="is_selected" id="is_selected" value="{{ old('is_selected', $photo->is_selected) }}" step="1" required>
                @if($errors->has('is_selected'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_selected') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.photo.fields.is_selected_helper') }}</span>
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
    var uploadedPhotoMap = {}
Dropzone.options.photoDropzone = {
    url: '{{ route('admin.photos.storeMedia') }}',
    maxFilesize: 10, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="photo[]" value="' + response.name + '">')
      uploadedPhotoMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPhotoMap[file.name]
      }
      $('form').find('input[name="photo[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($photo) && $photo->photo)
      var files = {!! json_encode($photo->photo) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="photo[]" value="' + file.file_name + '">')
        }
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