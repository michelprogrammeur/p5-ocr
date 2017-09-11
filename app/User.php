<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword as ResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pseudo',
        'firstname',
        'lastname',
        'job',
        'phone',
        'email',
        'password',
        'confirmation_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token) {
        // Your your own implementation.
        $this->notify(new ResetPasswordNotification($token));
    }

    // One user have many observations
    public function observations() {
        return $this->hasMany('App\Observation');
    }

    // One user have many articles
    public function articles() {
        return $this->hasMany('App\Article');
    }

    // One user have one picture
    public function picture() {
        return $this->hasOne('App\Picture');
    }


    // ROLES
    // One user have one OR many roles ( pivot table )
    public function roles() {
        return $this->belongsToMany('App\Role')->withTimestamps();
    }

    // Authorisation role
    public function authorizeRoles(array $roles) : bool {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'This action is unauthorized.');
    }


    public function hasAnyRole($roles) : bool {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    // The user has the role
    public function hasRole(String $role) : bool {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
}
