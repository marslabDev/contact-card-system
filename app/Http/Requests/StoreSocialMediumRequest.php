<?php

namespace App\Http\Requests;

use App\Models\SocialMedium;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSocialMediumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('social_medium_create');
    }

    public function rules()
    {
        return [
            'contact_card_id' => [
                'required',
                'integer',
            ],
            'type' => [
                'required',
            ],
            'link' => [
                'string',
                'required',
            ],
        ];
    }
}
