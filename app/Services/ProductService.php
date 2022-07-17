<?php
namespace App\Services;

use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductService
{
    public function getAll()
    {
            return [
                'products'=>  ProductResource::collection(Product::all())
            ];
       
    }
}