<?php

namespace App\Http\Requests;

use App\Models\ContactCard;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateContactCardRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contact_card_edit');
    }

    public function rules()
    {
        return [
            'url_slug' => [
                'string',
                'nullable',
            ],
            'first_name' => [
                'string',
                'required',
            ],
            'last_name' => [
                'string',
                'required',
            ],
            'company_name' => [
                'string',
                'required',
            ],
            'company_position' => [
                'string',
                'required',
            ],
            'company_website' => [
                'string',
                'required',
            ],
            'email' => [
                'string',
                'required',
            ],
            'handphone_number' => [
                'string',
                'required',
            ],
            'office_phone_number' => [
                'string',
                'required',
            ],
            'facebook_url' => [
                'string',
                'nullable',
            ],
            'instagram_url' => [
                'string',
                'nullable',
            ],
            'whatsapp_number' => [
                'string',
                'nullable',
            ],
            'wechat' => [
                'string',
                'nullable',
            ],
            'youtube_url' => [
                'string',
                'nullable',
            ],
            'tiktok' => [
                'string',
                'nullable',
            ],
            'xiao_hong_shu' => [
                'string',
                'nullable',
            ],
            'slogan' => [
                'string',
                'nullable',
            ],
            'mission' => [
                'string',
                'nullable',
            ],
            'vision' => [
                'string',
                'nullable',
            ],
            'banner_image' => [
                'required',
            ],
            'profile_image' => [
                'required',
            ],
            'gallery' => [
                'array',
            ],
        ];
    }
}
