<?php

namespace App\Http\Services;

use Mail;
use Naux\Mail\SendCloudTemplate;

class Email
{
    public static function sendVerifyEmailTo($user)
    {
        $data = [
            'url' => route('email.verify' , ['token' => $user->confirmation_token]),
            'name' => $user->name,
        ];
        $template = new SendCloudTemplate('xiaohtstyle_active', $data);

        $res = Mail::raw($template, function ($message) use ($user) {
            $message->from('xiaohaitao_1995@163.com', '海涛个人style');

            $message->to($user->email);
        });
        dd($res);
    }
}
