@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.contactCard.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contact-cards.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCard.fields.id') }}
                        </th>
                        <td>
                            {{ $contactCard->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCard.fields.first_name') }}
                        </th>
                        <td>
                            {{ $contactCard->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCard.fields.last_name') }}
                        </th>
                        <td>
                            {{ $contactCard->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCard.fields.company_name') }}
                        </th>
                        <td>
                            {{ $contactCard->company_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCard.fields.company_position') }}
                        </th>
                        <td>
                            {{ $contactCard->company_position }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCard.fields.company_website') }}
                        </th>
                        <td>
                            {{ $contactCard->company_website }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCard.fields.email') }}
                        </th>
                        <td>
                            {{ $contactCard->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCard.fields.handphone_number') }}
                        </th>
                        <td>
                            {{ $contactCard->handphone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCard.fields.office_phone_number') }}
                        </th>
                        <td>
                            {{ $contactCard->office_phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCard.fields.facebook_url') }}
                        </th>
                        <td>
                            {{ $contactCard->facebook_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCard.fields.instagram_url') }}
                        </th>
                        <td>
                            {{ $contactCard->instagram_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCard.fields.whatsapp_number') }}
                        </th>
                        <td>
                            {{ $contactCard->whatsapp_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCard.fields.wechat') }}
                        </th>
                        <td>
                            {{ $contactCard->wechat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCard.fields.youtube_url') }}
                        </th>
                        <td>
                            {{ $contactCard->youtube_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCard.fields.tiktok') }}
                        </th>
                        <td>
                            {{ $contactCard->tiktok }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCard.fields.xiao_hong_shu') }}
                        </th>
                        <td>
                            {{ $contactCard->xiao_hong_shu }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCard.fields.slogan') }}
                        </th>
                        <td>
                            {{ $contactCard->slogan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCard.fields.mission') }}
                        </th>
                        <td>
                            {{ $contactCard->mission }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCard.fields.vision') }}
                        </th>
                        <td>
                            {{ $contactCard->vision }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCard.fields.banner_image') }}
                        </th>
                        <td>
                            @if($contactCard->banner_image)
                                <a href="{{ $contactCard->banner_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $contactCard->banner_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactCard.fields.profile_image') }}
                        </th>
                        <td>
                            @if($contactCard->profile_image)
                                <a href="{{ $contactCard->profile_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $contactCard->profile_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contact-cards.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection