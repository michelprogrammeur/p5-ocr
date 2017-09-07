<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'taxref_id',
        'user_id',
        'matureStage',
        'plumage',
        'quantity',
        'dateAt',
        'hourAt',
        'department',
        'latitude',
        'longitude',
        'comment',
        'status'
    ];

    // Many observations for a user
    public function user() {
        return $this->belongsTo('App\User');
    }

    // Many observations for a taxref
    public function taxref() {
        return $this->belongsTo('App\Taxref');
    }

    // One observation has one picture
    public function picture() {
        return $this->hasOne('App\Picture');
    }
}
