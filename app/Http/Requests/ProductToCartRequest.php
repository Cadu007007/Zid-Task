<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductToCartRequest extends FormRequest
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
            'product_id'=>['required','exists:products,id'],
            'quantity'=>['required','min:1'],
        ];
    }
    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json(['success'=>false,'errors'=>$validator->errors()], 422)); 
      }
}