<?php

namespace App;

use Illuminate\Database\Eloquent\Model as HeadModel;

class Model extends HeadModel
{
    protected $guarded = [];

    /**
     * relation products
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products() {
        return $this->hasMany('App\Product');
    }

    /**
     *  relation brand
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand() {
        return $this->belongsTo('App\Brand');
    }
}
