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

    public function logs()
    {
        return $this->hasMany(Logs::class);
    }

    public function sales()
    {
        return $this->hasMany(Sales::class);
    }
}
