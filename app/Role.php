<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description'
    ];

    // One role have one OR many users ( pivot table )
    public function users() {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
