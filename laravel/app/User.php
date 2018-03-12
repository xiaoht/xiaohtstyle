<?php

namespace App;

use Hash;
use Request;
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
            $message->from('xiaohaitao_1995@163.com', '海涛个人style');
            $message->to($this->email);
        });
    }

    //xiaohu
    public function returnMsg($code = 200 , $data = [] , $msg = 'success')
    {
        $res = array(
            'code' => $code,
            'data' => $data,
            'msg'  => $msg
        );
        return $res;
    }
}
