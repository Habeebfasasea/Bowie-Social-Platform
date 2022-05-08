<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Auth;
use DB;
use App\Models\User;
use App\Models\Post;
use Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }

    public function homepage(){
        
        $title = 'Welcome';

        $posts = Post::where('approved', 1)->orderBy('created_at','desc')->paginate(12);
        
        return view('homePage')->with(compact('title', 'posts'));

    }

    public function viewBlogDetailsPage($slug){
        $title = 'Blog';
        
        $post = Post::where('slug', $slug)->firstOrFail();
                        
        return view('blogDetails')->with(compact('title', 'post'));

    }

}
