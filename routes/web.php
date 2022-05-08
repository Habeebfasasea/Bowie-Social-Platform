<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SocialShareButtonsController;

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

Route::get('/', [
    'uses' => 'App\Http\Controllers\HomeController@homePage',    
])->name('homePage.index');


Route::get('/blogDetails/{post:slug}', [
    'uses' => 'App\Http\Controllers\HomeController@viewBlogDetailsPage',    
])->name('blogDetails');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/home', [
//     'uses' => 'App\Http\Controllers\PostsController@viewHomePage',    
// ])->name('home');



// Route::get('/createPosts', [
//     'uses' => 'App\Http\Controllers\PostsController@viewCreatePostsPage',    
// ])->name('createPosts');

Route::get('/pending', [
    'uses' => 'App\Http\Controllers\PostsController@pendingPage',    
])->name('pending');


// Route::post('/createPosts', [
//     'uses' => 'App\Http\Controllers\PostsController@createPosts',    
// ])->name('posts.save');


Route::get('/social-media-share', [SocialShareButtonsController::class,'ShareWidget']);

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' =>'superadmin', 'middleware' => ['auth', 'superadmin']], function() {

    Route::get('/allPosts', [
        'uses' => 'App\Http\Controllers\PostsController@allPosts',    
    ])->name('all.posts');

    Route::get('awaitingRevision', [
        'uses' => 'App\Http\Controllers\PostsController@viewAwaitingRevision',    
    ])->name('awaitingRevision');

    Route::post('awtRev/{post:slug}', [
        'uses' => 'App\Http\Controllers\PostsController@awaitingRevUpd',
    ])->name('awaiting.update');

    Route::get('rejectedPosts', [
        'uses' => 'App\Http\Controllers\PostsController@viewRejectedPosts',    
    ])->name('viewRejectedPosts');

    Route::post('rejPosts/{post:slug}', [
        'uses' => 'App\Http\Controllers\PostsController@rejectedPostUpd',
    ])->name('rejected.update');

    Route::get('deleteBlogPostSup/{id}', [
        'uses' => 'App\Http\Controllers\PostsController@deleteBlogPostSup',
    ])->name('deleteBlogPostSup');

    Route::get('deleteMyPost/{id}', [
        'uses' => 'App\Http\Controllers\PostsController@deleteMyPost',
    ])->name('deleteMyPost');

    Route::get('/pendingPosts', [
        'uses' => 'App\Http\Controllers\PostsController@viewPendingPosts',    
    ])->name('pendPosts');
    
    Route::get('/approvePosts', [
        'uses' => 'App\Http\Controllers\PostsController@viewApprovedPosts',
    ])->name('appPosts');

    Route::get('/approveDept', [
        'uses' => 'App\Http\Controllers\PostsController@viewAppDept',
    ])->name('appDept');

    Route::get('/approvedDeptView', [
        'uses' => 'App\Http\Controllers\PostsController@AppDeptView',
    ])->name('appDept.View');

    Route::get('/approveDeptRole/{id}', [
        'uses' => 'App\Http\Controllers\PostsController@approveDeptRole',
    ])->name('appDept.Role');

    Route::get('/disApproveDeptRole/{id}', [
        'uses' => 'App\Http\Controllers\PostsController@disApproveDeptRole',
    ])->name('disAppDept.Role');

    //Approve and dissaprove posts
    Route::get('/appPosts/{id}', [
        'uses' => 'App\Http\Controllers\PostsController@appPosts',
    ])->name('appPosts.posts');

    Route::get('/disAppPostsPen/{id}', [
        'uses' => 'App\Http\Controllers\PostsController@disAppPostsPen',
    ])->name('disAppPostsPen.posts');
   
});

Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function() {

    Route::get('/home', [
        'uses' => 'App\Http\Controllers\PostsController@viewHomePage',    
    ])->name('home');

    Route::get('editPost/{post:slug}', [
        'uses' => 'App\Http\Controllers\PostsController@editMyPost'
    ])->name('editMyPost');

    Route::post('editPost/{post:slug}','App\Http\Controllers\PostsController@updatePost')->name('post.update');

    Route::get('deleteMyPost/{id}', [
        'uses' => 'App\Http\Controllers\PostsController@deleteMyPost',
    ])->name('deleteMyPost');

    Route::get('/blogPage', [
        'uses' => 'App\Http\Controllers\PostsController@viewBlogPosts',    
    ])->name('blog.view');

    Route::get('/revisionView', [
        'uses' => 'App\Http\Controllers\PostsController@revisionView',    
    ])->name('blog.revision');

    Route::get('/rejectedView', [
        'uses' => 'App\Http\Controllers\PostsController@rejectedView',    
    ])->name('blog.rejected');
            
    Route::get('/createPosts', [
        'uses' => 'App\Http\Controllers\PostsController@viewCreatePostsPage',    
    ])->name('createPosts');
    
    Route::post('/createPosts', [
        'uses' => 'App\Http\Controllers\PostsController@createPosts',    
    ])->name('posts.save');    
   
});