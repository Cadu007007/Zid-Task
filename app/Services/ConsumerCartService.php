<?php
namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Models\CartProducts;

class ConsumerCartService
{
   public function getCartTotal():array
   {
    $consumer = $this->loggedInConsumer();
    $cart = $consumer->cart;
    $total = \DB::table('products')
    ->where('cart_id',$cart->id)
    ->join('cart_products','products.id','=','cart_products.product_id')
    ->selectRaw('SUM((price +(price * vat_percentage / 100)) * quantity ) as cart_total')
    ->get('cart_total')->toArray();
    return $total;

    }
    public function addProductToCart(array $data):array
    {
            $consumer = $this->loggedInConsumer();
            // create cart if not exists
            if(!$this->getCart())
            {
                $cart = $consumer->cart()->create();
            }else{
                $cart = $this->getCart();
            }
            
            $data['cart_id'] = $cart->id;
            // check here if product with same cart exists if not create else increase the quantity
            if($product = $this->checkProductInCart($data))
            {
                $product->increment('quantity',$data['quantity']);
            }
            else{
                CartProducts::create($data);
            }
            return [
                'cart'=> $cart->load('products')
            ];


    }
    private function getCart()
    {
        $consumer = $this->loggedInConsumer();
        return $consumer->cart;
    }
    private function checkProductInCart($data)
    {
       return CartProducts::where('cart_id',$data['cart_id'])->where('product_id',$data['product_id'])->first();
    }
    private function loggedInConsumer()
    {
        return auth('sanctum')->user();
    }
}