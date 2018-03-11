<?php

namespace App;

use Hash;
use Request;
use App\Common\Models\Model;
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

    public function register()
    {
        $has_username_and_password = $this->has_username_and_password();
        if(!$has_username_and_password){
            return $this->returnMsg(403 , [] , '用户名和密码皆不可为空');
        }
        $username = $has_username_and_password[0];
        $password = $has_username_and_password[1];
        $user_exists = $this
            ->where('username',$username)
            ->exists();
        if($user_exists){
            return $this->returnMsg(403 , [] , '用户名已存在');
        }

        //$hashed_password = Hash::make($password);
        $hashed_password = bcrypt($password);
        $user = $this;
        $user->password = $hashed_password;
        $user->username = $username;
        if($user->save()) {
            return $this->returnMsg(200 , $user->id);
        }else{
            return $this->returnMsg(403 , [] , '服务器繁忙');
        }
    }

    public function has_username_and_password(){
        $username = Request::get('username');
        $password = Request::get('password');
        if($username && $password){
            return [$username,$password];
        }else{
            return false;
        }
    }
}
