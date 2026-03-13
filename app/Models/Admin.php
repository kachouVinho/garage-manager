<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Admin extends Model
{
    protected $fillable = ['email', 'password'];

    protected $hidden = ['password'];

    public function authenticate($email, $password)
    {
        $admin = static::where('email', $email)->first();
        return $admin && Hash::check($password, $admin->password);
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}