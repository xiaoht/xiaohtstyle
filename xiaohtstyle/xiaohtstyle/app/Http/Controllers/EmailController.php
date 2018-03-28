<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/3/11
 * Time: 8:45
 */

namespace App\Http\Controllers;

use App\User;
use Auth;

class EmailController extends Controller
{

    public function verify($token)
    {
        $user = User::where('confirmation_token' , $token)->first();

        if(is_null($user)){
            flash('邮箱验证失败')->overlay();
            return redirect('/');
        }

        $user->is_active = 1;
        $user->confirmation_token = $user->name.str_random(40);
        $user->save();
        Auth::login($user);
        flash('邮箱验证成功')->overlay();
        return redirect('/home');
    }
}
