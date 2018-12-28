<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InmueblesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'city_id' => 'required',
        'address' => 'required',
        'transaction_type' => 'required',
        'number_habitants' => 'required',
        'number_baths' => 'required',
        'number_parking' => 'required',
        'antiquity' => 'required',
        'active' => 'required'
    ];
    }
}
