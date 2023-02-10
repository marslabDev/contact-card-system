<?php

namespace App\Http\Requests;

use App\Models\Photo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePhotoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('photo_edit');
    }

    public function rules()
    {
        return [
            'contact_card_id' => [
                'required',
                'integer',
            ],
            'photo' => [
                'array',
                'required',
            ],
            'photo.*' => [
                'required',
            ],
            'is_selected' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
