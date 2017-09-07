<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'article_id',
        'observation_id',
        'user_id',
        'title',
        'url',
        'alt',
        'type'
    ];
}
