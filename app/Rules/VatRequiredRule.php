<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class VatRequiredRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //cases 
        // it's not passed and it's included
        // it's not passed and it's excluded
        // it's passed and it's included
        // it's passed and it's it's excluded
     
        if(!auth('sanctum')->user()->merchantSetting)
        {
            request()->validate(['settings'=>'required'],['settings.required'=>'You Have To Set Settings Before Adding Products']);

        }
        if(auth('sanctum')->user()->merchantSetting->vat_settings == 'excluded' && !request()->vat_percentage)
        {
            request()->validate(['vat_percentage'=>'required'],['vat_percentage.required'=>'the vat percentage field is required when vat setting is excluded']);

        }
       
        
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return true;
    
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
