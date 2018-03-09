<?php
/**
 * Created by PhpStorm.
 * User: xiaoht
 * Date: 2018/3/8
 * Time: 16:35
 */
function user_ins(){
    return new App\User();
}
Route::group(['prefix' => 'xiaohu'] , function (){
    Route::any('register',function () {
        return user_ins()->register();
    });
    Route::any('login',function () {
        return user_ins()->login();
    });
});