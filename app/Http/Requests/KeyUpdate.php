<?php

namespace App\Http\Requests;

use App\Rules\HostOrIpRule;
use Illuminate\Foundation\Http\FormRequest;

class KeyUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'host' => [
                'required', 'max:255', new HostOrIpRule
            ],
            'port' => 'required|numeric',
            'login' => 'required|string|max:255',
            'password' => 'nullable|string|max:255',
            'file' => 'nullable|file'
        ];
    }
}
