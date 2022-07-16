<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MerchantSettingRequest extends FormRequest
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
            'store_name'=>['sometimes','unique:merchant_settings,store_name,'.auth('sanctum')->user()->id.',merchant_id'],
            'vat_settings'=>['sometimes','in:included,exclude'],
            'shipping_cost'=>['sometimes','numeric']
        ];
    }
    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json(['success'=>false,'errors'=>$validator->errors()], 422)); 
      }
}
