<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    /**
     * relation brands
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function brands() {
        return $this->hasMany('App\Brand');
    }
}
