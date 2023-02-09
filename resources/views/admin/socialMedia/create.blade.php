@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.socialMedium.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.social-media.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="contact_card_id">{{ trans('cruds.socialMedium.fields.contact_card') }}</label>
                <select class="form-control select2 {{ $errors->has('contact_card') ? 'is-invalid' : '' }}" name="contact_card_id" id="contact_card_id" required>
                    @foreach($contact_cards as $id => $entry)
                        <option value="{{ $id }}" {{ old('contact_card_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('contact_card'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_card') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.socialMedium.fields.contact_card_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.socialMedium.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\SocialMedium::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.socialMedium.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="link">{{ trans('cruds.socialMedium.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', '') }}" required>
                @if($errors->has('link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.socialMedium.fields.link_helper') }}</span>
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