<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProductCategory extends Model
{
    protected $table = 'product_category';
    protected $fillable = [
        'name', 'description', 'added_by', 'is_delete'
    ];
    
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s') ?? null;
    }

    public function getUpdatedAtAttribute()
    {
        return Carbon::parse($this->attributes['updated_at'])->format('Y-m-d H:i:s') ?? null;
    }
}
