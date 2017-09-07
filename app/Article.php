<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'abstract',
        'content'
    ];

    // One article have many pictures
    public function pictures() {
        return $this->hasMany('App\Picture');
    }

    // Many articles for an user
    public function user() {
        return $this->belongsTo('App\User');
    }
}
