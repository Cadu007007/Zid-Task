<?php

namespace App\Http\Controllers;

use App\Http\Requests\MerchantSettingRequest;
use App\Models\MerchantSetting;
use App\Services\MerchantService;
use Illuminate\Http\Request;

class MerchantSettingController extends Controller
{
    public function storeUpdateSetting(MerchantSettingRequest $request,MerchantService $merchantService)
    {
        $response = $merchantService->createOrUpdateSetting($request->validated());
        return  $this->JsonResponse(true,$response,'Setting Has Been Updated',200);
    }   
}
