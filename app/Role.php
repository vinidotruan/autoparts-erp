<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ["name", "slug", "permission"];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function feeds()
    {
        return $this->hasManyThrough(Feed::class, User::class);
    }
}
