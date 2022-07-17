<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductStoreRequest;
use App\Services\MerchantProductService;

class ProductController extends Controller
{
    public function __construct(MerchantProductService $merchantProductService)
    {
        $this->merchantProductService = $merchantProductService;
    }
    public function index()
    {
        $response = $this->merchantProductService->getAllProducts();
        return $this->JsonResponse(true,$response,'',200);

    }
    public function store(ProductStoreRequest $request)
    {
       $response =  $this->merchantProductService->addNewProductToLoggedInMerchant($request->validated());
        return $this->JsonResponse(true,$response,'Product Created Successfully',201);
    }
}
