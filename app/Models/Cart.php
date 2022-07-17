<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cart extends Model
{
    use HasFactory;
    protected $with =['products'];

    protected $guarded =[];

    public function products():BelongsToMany
    {
        return $this->belongsToMany(Product::class,'cart_products')->withPivot('quantity');
    }

}
