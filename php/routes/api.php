<?php

Route::get('/test', function () {
    echo \Illuminate\Support\Facades\Hash::make("Nexon8888");
});
Route::get('/artical/getDetail', 'Api\ArticalController@getDetail');

Route::get('/topic_manager/get', 'Api\TopicManager@getManager');
Route::post('/topic_manager/post', 'Api\TopicManager@postManager');
Route::post('/topic_manager/delete', 'Api\TopicManager@deleteManager');

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware' => 'api', 'namespace' => 'Api'], function () {
    Route::post('/users/login', 'AuthController@login');
    Route::post('/users/logout', 'AuthController@logout');
    Route::get('/users/get_topic', 'UsersController@getTopic');
    Route::get('/index', 'IndexController@index');
    Route::get('/xxx', function () {
        dd(\App\Models\UsersModel::with('special')->get()->toArray());
    });


    //收藏模块
    Route::match(['get','post'],'/collect/artical_dir', 'CollectController@articalDir');
    Route::get('/collect/question_dir', 'CollectController@questionDir');
    Route::get('/collect/artical_item', 'CollectController@articalItem');
    Route::get('/collect/question_item', 'CollectController@questionItem');

});