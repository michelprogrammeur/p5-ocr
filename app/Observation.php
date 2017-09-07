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
}
