@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.contactCard.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.contact-cards.update", [$contactCard->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="first_name">{{ trans('cruds.contactCard.fields.first_name') }}</label>
                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', $contactCard->first_name) }}" required>
                @if($errors->has('first_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('first_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCard.fields.first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="last_name">{{ trans('cruds.contactCard.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', $contactCard->last_name) }}" required>
                @if($errors->has('last_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCard.fields.last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="company_name">{{ trans('cruds.contactCard.fields.company_name') }}</label>
                <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" type="text" name="company_name" id="company_name" value="{{ old('company_name', $contactCard->company_name) }}" required>
                @if($errors->has('company_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCard.fields.company_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="company_position">{{ trans('cruds.contactCard.fields.company_position') }}</label>
                <input class="form-control {{ $errors->has('company_position') ? 'is-invalid' : '' }}" type="text" name="company_position" id="company_position" value="{{ old('company_position', $contactCard->company_position) }}" required>
                @if($errors->has('company_position'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_position') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCard.fields.company_position_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="company_website">{{ trans('cruds.contactCard.fields.company_website') }}</label>
                <input class="form-control {{ $errors->has('company_website') ? 'is-invalid' : '' }}" type="text" name="company_website" id="company_website" value="{{ old('company_website', $contactCard->company_website) }}" required>
                @if($errors->has('company_website'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_website') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCard.fields.company_website_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.contactCard.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', $contactCard->email) }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCard.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="handphone_number">{{ trans('cruds.contactCard.fields.handphone_number') }}</label>
                <input class="form-control {{ $errors->has('handphone_number') ? 'is-invalid' : '' }}" type="text" name="handphone_number" id="handphone_number" value="{{ old('handphone_number', $contactCard->handphone_number) }}" required>
                @if($errors->has('handphone_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('handphone_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCard.fields.handphone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="office_phone_number">{{ trans('cruds.contactCard.fields.office_phone_number') }}</label>
                <input class="form-control {{ $errors->has('office_phone_number') ? 'is-invalid' : '' }}" type="text" name="office_phone_number" id="office_phone_number" value="{{ old('office_phone_number', $contactCard->office_phone_number) }}" required>
                @if($errors->has('office_phone_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('office_phone_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCard.fields.office_phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="facebook_url">{{ trans('cruds.contactCard.fields.facebook_url') }}</label>
                <input class="form-control {{ $errors->has('facebook_url') ? 'is-invalid' : '' }}" type="text" name="facebook_url" id="facebook_url" value="{{ old('facebook_url', $contactCard->facebook_url) }}">
                @if($errors->has('facebook_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('facebook_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCard.fields.facebook_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="instagram_url">{{ trans('cruds.contactCard.fields.instagram_url') }}</label>
                <input class="form-control {{ $errors->has('instagram_url') ? 'is-invalid' : '' }}" type="text" name="instagram_url" id="instagram_url" value="{{ old('instagram_url', $contactCard->instagram_url) }}">
                @if($errors->has('instagram_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('instagram_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCard.fields.instagram_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="whatsapp_number">{{ trans('cruds.contactCard.fields.whatsapp_number') }}</label>
                <input class="form-control {{ $errors->has('whatsapp_number') ? 'is-invalid' : '' }}" type="text" name="whatsapp_number" id="whatsapp_number" value="{{ old('whatsapp_number', $contactCard->whatsapp_number) }}">
                @if($errors->has('whatsapp_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('whatsapp_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCard.fields.whatsapp_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="wechat">{{ trans('cruds.contactCard.fields.wechat') }}</label>
                <input class="form-control {{ $errors->has('wechat') ? 'is-invalid' : '' }}" type="text" name="wechat" id="wechat" value="{{ old('wechat', $contactCard->wechat) }}">
                @if($errors->has('wechat'))
                    <div class="invalid-feedback">
                        {{ $errors->first('wechat') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCard.fields.wechat_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="youtube_url">{{ trans('cruds.contactCard.fields.youtube_url') }}</label>
                <input class="form-control {{ $errors->has('youtube_url') ? 'is-invalid' : '' }}" type="text" name="youtube_url" id="youtube_url" value="{{ old('youtube_url', $contactCard->youtube_url) }}">
                @if($errors->has('youtube_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('youtube_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCard.fields.youtube_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tiktok">{{ trans('cruds.contactCard.fields.tiktok') }}</label>
                <input class="form-control {{ $errors->has('tiktok') ? 'is-invalid' : '' }}" type="text" name="tiktok" id="tiktok" value="{{ old('tiktok', $contactCard->tiktok) }}">
                @if($errors->has('tiktok'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tiktok') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCard.fields.tiktok_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="xiao_hong_shu">{{ trans('cruds.contactCard.fields.xiao_hong_shu') }}</label>
                <input class="form-control {{ $errors->has('xiao_hong_shu') ? 'is-invalid' : '' }}" type="text" name="xiao_hong_shu" id="xiao_hong_shu" value="{{ old('xiao_hong_shu', $contactCard->xiao_hong_shu) }}">
                @if($errors->has('xiao_hong_shu'))
                    <div class="invalid-feedback">
                        {{ $errors->first('xiao_hong_shu') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCard.fields.xiao_hong_shu_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="slogan">{{ trans('cruds.contactCard.fields.slogan') }}</label>
                <input class="form-control {{ $errors->has('slogan') ? 'is-invalid' : '' }}" type="text" name="slogan" id="slogan" value="{{ old('slogan', $contactCard->slogan) }}">
                @if($errors->has('slogan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('slogan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCard.fields.slogan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mission">{{ trans('cruds.contactCard.fields.mission') }}</label>
                <input class="form-control {{ $errors->has('mission') ? 'is-invalid' : '' }}" type="text" name="mission" id="mission" value="{{ old('mission', $contactCard->mission) }}">
                @if($errors->has('mission'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mission') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCard.fields.mission_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="vision">{{ trans('cruds.contactCard.fields.vision') }}</label>
                <input class="form-control {{ $errors->has('vision') ? 'is-invalid' : '' }}" type="text" name="vision" id="vision" value="{{ old('vision', $contactCard->vision) }}">
                @if($errors->has('vision'))
                    <div class="invalid-feedback">
                        {{ $errors->first('vision') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCard.fields.vision_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="banner_image">{{ trans('cruds.contactCard.fields.banner_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('banner_image') ? 'is-invalid' : '' }}" id="banner_image-dropzone">
                </div>
                @if($errors->has('banner_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('banner_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCard.fields.banner_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="profile_image">{{ trans('cruds.contactCard.fields.profile_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('profile_image') ? 'is-invalid' : '' }}" id="profile_image-dropzone">
                </div>
                @if($errors->has('profile_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('profile_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCard.fields.profile_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gallery">{{ trans('cruds.contactCard.fields.gallery') }}</label>
                <div class="needsclick dropzone {{ $errors->has('gallery') ? 'is-invalid' : '' }}" id="gallery-dropzone">
                </div>
                @if($errors->has('gallery'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gallery') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactCard.fields.gallery_helper') }}</span>
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
    Dropzone.options.bannerImageDropzone = {
    url: '{{ route('admin.contact-cards.storeMedia') }}',
    maxFilesize: 10, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
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
      $('form').find('input[name="banner_image"]').remove()
      $('form').append('<input type="hidden" name="banner_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="banner_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($contactCard) && $contactCard->banner_image)
      var file = {!! json_encode($contactCard->banner_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="banner_image" value="' + file.file_name + '">')
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
<script>
    Dropzone.options.profileImageDropzone = {
    url: '{{ route('admin.contact-cards.storeMedia') }}',
    maxFilesize: 10, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
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
      $('form').find('input[name="profile_image"]').remove()
      $('form').append('<input type="hidden" name="profile_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="profile_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($contactCard) && $contactCard->profile_image)
      var file = {!! json_encode($contactCard->profile_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="profile_image" value="' + file.file_name + '">')
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
<script>
    var uploadedGalleryMap = {}
Dropzone.options.galleryDropzone = {
    url: '{{ route('admin.contact-cards.storeMedia') }}',
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="gallery[]" value="' + response.name + '">')
      uploadedGalleryMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedGalleryMap[file.name]
      }
      $('form').find('input[name="gallery[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($contactCard) && $contactCard->gallery)
          var files =
            {!! json_encode($contactCard->gallery) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="gallery[]" value="' + file.file_name + '">')
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