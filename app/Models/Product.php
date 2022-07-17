<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    protected $hidden = ['created_at','updated_at'];

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(User::class,'merchant_id','id');
    }
    public function getNameAttribute()
    {
        return $this->attributes['name_'.app()->getLocale()];
    }
    public function getDescriptionAttribute()
    {
        return $this->attributes['description_'.app()->getLocale()];
    }
    public function getPriceAfterVat()
    {
        return $this->price + ($this->price * $this->vat_percentage);
    }
}
