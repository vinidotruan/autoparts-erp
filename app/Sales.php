<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Sales extends Model
{
    use RecordsFeed;

    protected $fillable = ["user_id", "product_id", "amount", 'date'];
    // protected $appends = ["date"];

    // public function getDateAttribute()
    // {
    //     $date = new Carbon($this->created_at);
    //     return $date->format('d/m/Y');
    // } 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
