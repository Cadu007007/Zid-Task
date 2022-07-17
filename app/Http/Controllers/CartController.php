<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductToCartRequest;
use App\Services\ConsumerCartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(ConsumerCartService  $cartService)
    {
        $this->cartService = $cartService;
    }
    public function getTotal()
    {
        return $this->JsonResponse(true,$this->cartService->getCartTotal(),'',200);
    }
    public function addProduct(ProductToCartRequest $request)
    {
        $response = $this->cartService->addProductToCart($request->validated());
        return $this->JsonResponse(true,$response,'Product Added Successfully',201);
    }
}
