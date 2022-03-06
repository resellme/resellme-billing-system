<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'domain_id' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['email', 'required'],
            'company' => ['required'],
            'mobile' => ['required'],
            'street_address' => ['required'],
            'core_business' => ['required'],
            'city' => ['required'],
            'country' => ['required']
        ];
    }
}
