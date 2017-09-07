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

    // One picture for an user
    public function user() {
        return $this->belongsTo('App\User');
    }

    // One picture for one observation
    public function observation() {
        return $this->belongsTo('App\Observation');
    }

    // Many pictures for an article
    public function article() {
        return $this->belongsTo('App\Article');
    }
}
