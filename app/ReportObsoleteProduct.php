<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportObsoleteProduct extends Model
{
    protected $fillable = ['user_id', 'since', 'at', 'minimun_amount','products'];
    protected $hidden = ['products'];
    protected $table ="reports_obsolete_products";
    protected $appends = ["data"];

    public function getDataAttribute()
    {
        return unserialize($this->products);
    }
}
