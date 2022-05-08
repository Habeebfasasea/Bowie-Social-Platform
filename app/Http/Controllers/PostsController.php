<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Auth;
use DB;
use File;
use App\Models\User;
use App\Models\Post;
use Alert;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function homepage(){
        
        $title = 'Welcome';
        
        return view('homePage')->with('title', $title);

    }

    public function deleteBlogPostSup($id){

        $user = Auth::user();
        
        if($user->super_admin){
            Post::where('id', $id)->delete();
            
            $alerted = toast('Post Deleted', 'success');

            return redirect()->back()->with(compact('alerted'));
        }else{

            $alerted = toast('You are not authorized to delete this post', 'error');

            return redirect()->back()->with(compact('alerted'));
        }
        

    }

    public function editMyPost(Post $post)
    {                
        $title = 'Edit Post';
        
        return view('editPost')->with(compact('title', 'post'));

    }

    public function updatePost(Request $request, Post $post)
    {
        
        $user = Auth::user();
        $userId = $user->id;

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        if($request->hasFile('image')){
            
            $this->validate($request, [
                'image' => 'required|image|mimes:jpg,png,jpeg|max:10048'
            ]);
            
            // Delete previous Image from blog_images folder
            File::delete($post->image);

            $profileImage = $request->file('image');
            $profileImageSaveAsName = time() . Auth::id() . "-blog." . $profileImage->getClientOriginalExtension();
    
            $upload_path = 'blog_images/';
            $profile_image_url = $upload_path . $profileImageSaveAsName;
            $success = $profileImage->move($upload_path, $profileImageSaveAsName);
        
        }
               
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('image')){
            $post->image = $profile_image_url;
        }
        
        if($userId == $post->user_id){
            $post->save();
            $alerted = toast('Post Updated', 'success');

            return redirect()->back()->with(compact('alerted'));

        }else{
            $alerted = toast('You do not own this post', 'error');

            return redirect()->back()->with(compact('alerted'));
        }
        
    }


    public function deleteMyPost($id){

        $user = Auth::user();
        $userId = $user->id;
                
        Post::where([ ['id', $id], ['user_id', $userId] ])->delete();

        $alerted = toast('Post Deleted', 'success');

        return redirect()->back()->with(compact('alerted'));

    }



    public function viewHomePage(Post $post)
    {
                
        $title = 'Welcome';
        
        $user = Auth::user();

        $userId = $user->id;

        $revPosts = Post::where([ ['user_id', $userId], ['revise', 1] ])->get();

        $rejPosts = Post::where([ ['user_id', $userId], ['reject', 1] ])->get();

        $pendingDepts = User::where('admin', 0)->get();

        return view('home')->with(compact('title','user', 'revPosts', 'rejPosts', 'pendingDepts'));
    }

    public function viewBlogPosts(Post $post)
    {
                
        $title = 'Welcome';
        
        $user = Auth::user();
        $userId = $user->id;

        $posts = Post::where('user_id', $userId)->orderBy('created_at', 'desc')->paginate(12);
        

        $shareComponent = \Share::page(
            'https://www.positronx.com',
            'Share To The World',
        )
        ->facebook()
        ->twitter()        
        ->whatsapp(); 

        return view('blogPosts')->with(compact('title', 'posts', 'user', 'shareComponent'));
    }

    public function allPosts(Post $post)
    {
                
        $title = 'All Posts';
        
        $posts = Post::orderBy('created_at', 'desc')->paginate(12);
        
        $shareComponent = \Share::page(
            'https://www.positronx.com',
            'Share To The World',
        )
        ->facebook()
        ->twitter()        
        ->whatsapp(); 

        return view('allPosts')->with(compact('title', 'posts', 'shareComponent'));
    }

    public function viewAwaitingRevision(){
        
        $title = 'Awaiting Revision';

        $posts = Post::where('revise', 1)->orderBy('created_at','desc')->paginate(12);
        
        return view('awaitingRev')->with(compact('title', 'posts'));

    }
   

    public function awaitingRevUpd(Request $request, Post $post)
    {
        
        $user = Auth::user();

        if($user->super_admin){

            $this->validate($request, [
                'revise_reason' => 'required',            
            ]);
                
            $post->revise = 1;
            $post->revise_reason = $request->input('revise_reason');
            $post->pending = 0;
            $post->reject = 0;
            $post->reject_reason = Null;
            $post->approved = 0;
            
            $post->save();
            
        
            $alerted = toast('Revision notice has been sent', 'success');

            return redirect()->back()->with(compact('alerted'));
            
        }

    }


    public function viewRejectedPosts(){
        
        $title = 'Rejected Posts';

        $posts = Post::where('reject', 1)->orderBy('created_at','desc')->paginate(12);
        
        return view('rejPosts')->with(compact('title', 'posts'));

    }

    public function rejectedPostUpd(Request $request, Post $post){
        
        $user = Auth::user();

        if($user->super_admin){

            $this->validate($request, [
                'reject_reason' => 'required',            
            ]);
                
            $post->revise = 0;
            $post->revise_reason = Null;
            $post->pending = 0;
            $post->reject = 1;
            $post->reject_reason = $request->input('reject_reason');
            $post->approved = 0;
            
            $post->save();
            
        
            $alerted = toast('The post has been rejected', 'success');

            return redirect()->back()->with(compact('alerted'));

        }

    }

    public function revisionView(Post $post){
        
        $title = 'Revise Posts';

        $user = Auth::user();

        $userId = $user->id;

        $posts = Post::where([ ['user_id', $userId], ['revise', 1] ])->orderBy('created_at', 'desc')->paginate(12);
        
        return view('revisionView')->with(compact('title', 'posts'));

    }

    public function rejectedView(Post $post){
        
        $title = 'Revise Posts';

        $user = Auth::user();

        $userId = $user->id;

        $posts = Post::where([ ['user_id', $userId], ['reject', 1] ])->orderBy('created_at', 'desc')->paginate(12);
        
        return view('rejectedView')->with(compact('title', 'posts'));

    }

    public function viewCreatePostsPage(){
        
        $title = 'Create Posts';
        
        return view('createPosts')->with('title', $title);

    }


    public function createPosts(Request $request){

        $this->validate($request, [
            'title' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,svg|max:10048',           
            'body' => 'required'
        ]);

        if($request->hasFile('image')){
            $profileImage = $request->file('image');
            $profileImageSaveAsName = time() . Auth::id() . "-blog." . $profileImage->getClientOriginalExtension();
    
            $upload_path = 'blog_images/';
            $profile_image_url = $upload_path . $profileImageSaveAsName;
            $success = $profileImage->move($upload_path, $profileImageSaveAsName);
        }

        $user = Auth::user();
        $lognUsername = $user->name;
        $lognUserId = $user->id;
        $lognUserDept = $user->department;
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->author = $lognUsername; 
        $post->user_id = $lognUserId;
        $post->image = $profile_image_url;

        if($lognUserDept == 'Relations'){
            $post->approved = 1;
            $post->pending = 0;
            $post->revise = 0;
            $post->reject = 0;
        }else{
            $post->approved = 0;
            $post->pending = 1;
            $post->revise = 0;
            $post->reject = 0;
        }
        $post->department = $lognUserDept; 
        $post->save();
        
        $alerted = toast('Post Created', 'success');

        return redirect()->route('posts.save')->with(compact('alerted'));

    }

    public function pendingPage()
    {
        $title = 'Pending';
                    
        return view('pending')->with(compact('title'));

    }

    public function viewPendingPosts()
    {
        $title = 'Pending Posts';
                
        $posts = Post::where('pending', 1)->orderBy('created_at','desc')->paginate(12);

        return view('pendingPosts')->with(compact('title', 'posts'));

    }

   

    public function viewApprovedPosts()
    {
        $title = 'Approved Posts';
                
        $posts = Post::where('approved', 1)->orderBy('created_at','desc')->paginate(12);

        return view('approvePost')->with(compact('title', 'posts'));
    }


    public function viewAppDept()
    {
        $title = 'Pending Departments';
        
        $lgnUserid = Auth::user()->id;

        $users = User::where('admin', 0)->orderBy('created_at','desc')->get();

        return view('approveDept')->with(compact('title', 'users','lgnUserid'));

    }

    public function AppDeptView()
    {
        $title = 'Approved Departments'; 
        
        $lgnUserid = Auth::user()->id;

        $users = User::where([ ['admin', 1], ['super_admin', 0] ])->orderBy('created_at','desc')->get();

        return view('approvedDeptView')->with(compact('title', 'users', 'lgnUserid'));

    }


    public function approveDeptRole($id)
    {
        
        $user = Auth::user();

        if($user->super_admin){

            User::where('id', $id)->update(['admin'=>1]);

            $alerted = toast('Department Approved', 'success');

            return redirect()->back()->with(compact('alerted'));

        }else{

            $alerted = toast('You can not approve departments', 'error');

            return redirect()->back()->with(compact('alerted'));

        }

        
        
    }

    public function disApproveDeptRole($id)
    {
                
        $user = Auth::user();

        if($user->super_admin){

            User::where('id', $id)->update(['admin'=>0]);

            $alerted = toast('Department disApproved', 'success');
    
            return redirect()->back()->with(compact('alerted'));

        }else{

            $alerted = toast('You can not disapprove departments', 'error');

            return redirect()->back()->with(compact('alerted'));

        }
               
    }

    public function appPosts($id)
    {

        $user = Auth::user();

        if($user->super_admin){
                
            Post::where('id', $id)->update(['approved'=> 1, 'pending'=> 0]);

            $alerted = toast('Post Approved', 'success');

            return redirect()->back()->with(compact('alerted'));
        
        }else{

            $alerted = toast('You can not approve Posts', 'error');

            return redirect()->back()->with(compact('alerted'));

        }
        
    }

    public function disAppPostsPen($id)
    {
        
        $user = Auth::user();

        if($user->super_admin){

            Post::where('id', $id)->update(['pending'=> 1, 'approved'=> 0, 'reject'=> 0, 'reject_reason'=> Null, 'revise'=> 0,
            'revise_reason'=> Null]);

            $alerted = toast('Post has been set to Pending', 'success');

            return redirect()->back()->with(compact('alerted'));

        }else{

            $alerted = toast('You can not set post to Pending', 'error');

            return redirect()->back()->with(compact('alerted'));

        }
            
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
