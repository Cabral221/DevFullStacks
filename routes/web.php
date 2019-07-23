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
// Route::post('/attachments','AttachmentController@store')->name('attachments.store');
// fin du Test de l'attachement des fichier
//  Test de commentaires des posts
Route::resource('comments','Comments\CommentsController');
//  FIN Test de commentaires des posts

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

Route::get('categorie/{category}', 'HomeController@category')->name('category');

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

Route::prefix('admin')->name('admin.')->group(function() {

    // Gestion Admin blog
    Route::get('/blog/categories','Admin\PostsController@category')->name('blog.categories');
    Route::get('/blog/categories/{category}/edit','Admin\PostsController@categoryEdit')->name('blog.categories.edit');
    Route::put('/blog/categories/{category}','Admin\PostsController@categoryUpdate')->name('blog.categories.update');
    // Route::delete('blog/categories/{category}','Admin\PostsController@categoryDestroy')->name('blog.categories.destroy');
    Route::post('/blog/categories/{categories}','Admin\PostsController@categoryDelete')->name('blog.categories.destroy');
    Route::post('/blog/categories/','Admin\PostsController@categoryStore')->name('blog.categories.store');
    Route::resource('blog','Admin\PostsController',['parameters'=>[
        'blog'=>'post'
    ]]);
    Route::get('/blog/comments','Admin\PostsController@comment')->name('blog.comments');
    // End Blog

    
    // Les permissions 
    Route::name('user.')->group(function(){
        // Administrateurs , Role, info 
        Route::get('user/role','Admin\UsersController@role')->name('role');
        Route::get('user/role/{role}/edit','Admin\UsersController@roleEdit')->name('role.edit');
        Route::delete('user/role/{role}','Admin\UsersController@roleDestroy')->name('role.destroy');
        Route::put('/user/role/{role}','Admin\UsersController@roleUpdate')->name('role.update');
        Route::post('user/role','Admin\UsersController@roleStore')->name('role.store');
        
        Route::resource('user/permission','Admin\PermissionController');
    });
    Route::resource('user', 'Admin\UsersController');
    

    //Authentication
    Route::get('/home', 'Admin\AdminController@index')->name('dashboard');
    Route::get('/login', 'Admin\Auth\AdminLoginController@showLoginForm')->name('login');
    Route::post('/login', 'Admin\Auth\AdminLoginController@login')->name('login.submit');
    Route::post('/logout', 'Admin\Auth\AdminLoginController@logout')->name('logout');

    //Reset Password
    Route::get('/password/reset', 'Admin\Auth\AdminForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/email', 'Admin\Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('/password/reset', 'Admin\Auth\AdminResetPasswordController@reset')->name('password.update');
    Route::get('/password/reset/{token}', 'Admin\Auth\AdminResetPasswordController@showResetForm')->name('password.reset');
});