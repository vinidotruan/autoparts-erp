<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use RecordsFeed;

    protected $fillable = [ 'name' ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function feeds()
    {
        return $this->morphMany(Feed::class,'feedable');
    }
}
