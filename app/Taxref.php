<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxref extends Model
{
    protected $table = 'Taxref';
    public $timestamps = false;


    // One taxref have many observations
    public function observations() {
        return $this->hasMany('App\Observation');
    }
}
