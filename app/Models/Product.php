<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ramsey\Uuid\Type\Decimal;

class Product extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    protected $appends = ['price_after_vat'];

    protected $hidden = ['created_at','updated_at'];

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(User::class,'merchant_id','id');
    }
    /**
     * get name according to local
     *@var null
     **/
    public function getNameAttribute() : string
    {
        return $this->attributes['name_'.app()->getLocale()];
    }
    /**
     * get description according to local
     *@var null
     **/
    public function getDescriptionAttribute():string
    {
        return $this->attributes['description_'.app()->getLocale()];
    }
    /**
     * getting price after calculating the tax
     *@var null
     **/
    public function getPriceAfterVatAttribute()
    {
        return number_format($this->price + ($this->price * ($this->vat_percentage / 100)),2);
    }
}
