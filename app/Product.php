<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    /**
     * relation model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function model() {
        return $this->belongsTo('App\Model');
    }
}
