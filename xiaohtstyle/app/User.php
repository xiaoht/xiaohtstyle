<?php

namespace App;

use Mail;
use Naux\Mail\SendCloudTemplate;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','avavtar' , 'confirmation_token' , 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function sendPasswordResetNotification($token)
    {
        $data = [
            'url' => url('password/reset' , $token),
        ];
        $template = new SendCloudTemplate('xiaohtstyle_reset_password', $data);
        Mail::raw($template, function ($message) {
            $message->from('xiaohaitao_1995@163.com', '›¿??’¨style');
            $message->to($this->email);
        });
    }
}
