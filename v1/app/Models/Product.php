<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'category_id', 'name', 'description', 'price', 'added_by'
    ];

    public function presetPrice()
    {
        return number_format( $this->attributes['price'] ,0,',','.');
    }    

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s') ?? null;
    }

    public function getUpdatedAtAttribute()
    {
        return Carbon::parse($this->attributes['updated_at'])->format('Y-m-d H:i:s') ?? null;
    }
}
