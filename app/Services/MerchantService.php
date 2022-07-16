<?php
namespace App\Services;

class MerchantService
{
    public function createOrUpdateSetting(array $data)
    {
        $merchant = auth('sanctum')->user();
        if($merchant->merchantSetting)
        {
            
            $merchant->merchantSetting()->update($data);
        }else{
            
            $merchant->merchantSetting()->create($data);
        }
        return [
            'merchant'=>$merchant,
            'settings'=>$merchant->load('merchantSetting'),
        ];
    }
}