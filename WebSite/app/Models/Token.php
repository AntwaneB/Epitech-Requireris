<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Session;
use App\Crypter;

class Token extends Model
{
    protected $table = 'tokens';

    public function user()
    {
        return ($this->belongsTo('App\Models\User'));
    }

    public function getTokenAttribute($value)
    {
        if (Session::has('hash_key')) {
            return (Crypter::decrypt($value, Session::get('hash_key'), true));
        }
        else {
            return (NULL);
        }
    }

    public function setTokenAttribute($value)
    {
        if (Session::has('hash_key')) {
            $this->attributes['token'] = Crypter::encrypt($value, Session::get('hash_key'), true);
        }
        else {
            $this->attributes['token'] = $value;
        }
    }
}
