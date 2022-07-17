<?php
namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Models\Product;

class MerchantProductService
{
    public function getAllProducts()
    {
        $products = auth('sanctum')->user()->products;
        return [
            'products'=>  ProductResource::collection($products)
        ];
    }
    public function addNewProductToLoggedInMerchant(array $data) : array
    {
       $product= auth('sanctum')->user()->products()->create($data);
       return [
        'product'=>new ProductResource($product),
    ];
    }
}