<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'ref', 'application', 'value_cost', 'value_sell', 'amount', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
