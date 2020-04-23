<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Feed extends Model
{
    protected $guarded = [];
    protected $appends = ["action","hour"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getHourAttribute()
    {
        $date = new Carbon($this->created_at);
        return $date->format('H:m:i');

    }
    public function getActionAttribute()
    {
        $term = '';
        $feedable = '';

        if(preg_match('/updated/',$this->type)) {
            $term = "Atualizou";
        } elseif (preg_match('/created/',$this->type)) {
            $term = "Criou";
        } else {
            $term = "Deletou";
        }

        if(preg_match('/Sales/',$this->feedable_type)) {
            $feedable = "uma Venda";
        } elseif (preg_match('/Category/',$this->feedable_type)) {
            $feedable = "uma Categoria";
        } else {
            $feedable = "um Produto";
        }

        return "{$this->user->name} {$term} {$feedable}";

    }
}
