<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductStoreRequest;
use App\Services\MerchantProductService;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(MerchantProductService $merchantProductService)
    {
        $this->merchantProductService = $merchantProductService;
    }
    public function index(ProductService $productService)
    {
     
        return $this->JsonResponse(true,$productService->getAll(),'',200);
    }
    public function merchantProducts()
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
