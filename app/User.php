<?php

namespace App;

use Illuminate\Notifications\Notifiable;

use Illuminate\Auth\Passwords\TokenRepositoryInterface;
use Illuminate\Auth\Passwords\PasswordBroker;


use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements CanResetPasswordContract
{
    use Notifiable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function generatePassword()
    {
      return bcrypt(str_random(35));
    }

    public static function sendWelcomeEmail($user)
    {
      // Generate a new reset password token
      $token = app('auth.password.broker')->createToken($user);
      
      // Send email
      Mail::send('emails.welcome', ['user' => $user, 'token' => $token], function ($m) use ($user) {
        $m->from('hello@appsite.com', 'Your App Name');
        $m->to($user->email)->subject('Welcome to APP');
      });
    }
}
