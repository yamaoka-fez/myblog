<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use IlluminateAuthUserTrait;
use IlluminateAuthUserInterface;
use IlluminateAuthRemindersRemindableTrait;
use IlluminateAuthRemindersRemindableInterface;

class User extends Model implements UserInterface, RemindableInterface{
    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    protected $fillable = ['username', 'email'];

    public function posts(){
        return $this->hasMany('Post');
    }
}
