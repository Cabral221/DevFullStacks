<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Partie des pages static

// Test de l'attachement des fichier
Route::post('/attachments','AttachmentController@store')->name('attachments.store');
//fin du test

Route::get('/',[
    'as' => 'index',
    'uses' => 'PagesController@home'
]);
Route::get('/about',[
    'as' => 'about',
    'uses' => 'PagesController@about'
]);
Route::get('/contact',[
    'as' => 'contact',
    'uses' => 'ContactsController@index'
]);

// Partie du blog
Route::resource('blog','PostsController',['parameters'=>[
    'blog'=>'post'
]]);

Route::resource('blog.comment','Comments\CommentsPostController',['parameters'=>[
    'blog'=>'post'
]]);

Route::get('/post/{post}/like',[
    'as' => 'post_like',
    'uses' => 'PostsController@like'
]);

// partie Forum de l'appli
Route::resource('forum','ForumsController',['parameters'=>[
    'forum' => 'topic'
]]);
Route::resource('forum.comment','Comments\CommentsForumController',['parameters'=>[
    'forum'=>'topic'
]]);


// Parti d'e-learning de l'appli
Route::resource('/e-learning','CoursesController',['parameters' => [
    'e-learning' => 'cours'
]]);


// Partie notification Route
Route::resource('/notifications', 'NotificationsController',['only'=> ['show']]);



// Partie d'authentification
Auth::routes();
Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');
Route::get('/confirm/{id}/{token}','Auth\RegisterController@confirm');
Route::get('/home', 'UserController@index')->name('home');
Route::post('/update_avatar', 'UserController@update_avatar')->name('update_avatar');



// Partie d'administration
// Route::group(['namespace' => 'Admin','prefix' => 'admin'],function(){
//     Route::resource('posts','PostsController');
// });

Route::prefix('admin')->group(function() {
    Route::get('/', 'Admin\AdminController@index')->name('admin.dashboard');
    Route::get('/login', 'Admin\Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Admin\Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Admin\Auth\AdminLoginController@logout')->name('admin.logout');

    //Reset Password
    Route::get('/password/reset', 'Admin\Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'Admin\Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::post('/password/reset', 'Admin\Auth\AdminResetPasswordController@reset')->name('admin.password.update');
    Route::get('/password/reset/{token}', 'Admin\Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});