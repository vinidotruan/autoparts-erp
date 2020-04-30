<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportObsoleteProduct extends Model
{
    protected $fillable = ['user_id', 'since', 'at', 'minimun_amount','data'];
    protected $table ="reports_obsolete_products";
}
