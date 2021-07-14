<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttachmentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file_path' => 'required|max:1024|mimes:pdf,png,jpeg,gif,txt'
        ];
    }
}
