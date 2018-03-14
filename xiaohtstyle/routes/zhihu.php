<?php
/**
 * Created by PhpStorm.
 * User: xiaoht
 * Date: 2018/3/8
 * Time: 16:35
 */
Route::group(['prefix' => 'zhihu'] , function (){
    Route::resource('questions' , '\App\Zhihu\Controllers\QuestionsController' , ['names' => [
        'create' => 'zhihu.question.create',
        'show'   => 'zhihu.question.show',
    ]]);
});