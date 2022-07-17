<?php

namespace App\Http\Requests;

use App\Rules\VatRequiredRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductStoreRequest extends FormRequest
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
            'name_en'=>['required','min:3','unique:products,name_en'],
            'name_ar'=>['required','min:3','unique:products,name_ar'],
            'description_en'=>['required','min:10'],
            'description_ar'=>['required','min:10'],
            'price'=>['required'],
            'vat_percentage'=>[ new VatRequiredRule()]
        ];
    }
    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json(['success'=>false,'errors'=>$validator->errors()], 422)); 
      }
}
