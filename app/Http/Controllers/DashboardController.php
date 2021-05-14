<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['verified', 'auth', 'admin'], ['except' => ['show', 'allPosts']]);
    }

    public function index(){

        $posts = Post::latest()->paginate(10);
        return view('backend.blog.index', compact('posts'));
    }

    public function allPosts() {

        $posts = Post::paginate(4);
        return view('frontend.blog.index', compact('posts'));
    }

    public function create(){

        return view('backend.blog.create');
    }

    public function store(Request $request) {

        $this->validate($request, [
            'title' => 'required|min:5',
            'body' => 'required',
            'blog_photo' => 'required|mimes:jpeg,png,jpg'
        ]);
        if($request->hasFile('blog_photo')){
            $file = $request->file('blog_photo');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/blog/photos', $filename);
            Post::create([
                'title' => request('title'),
                'slug' => Str::slug(request('title')),
                'body' => request('body'),
                'blog_photo' => $filename,
                'status' =>request('status'),
            ]);
        }
        return redirect('/dashboard')->with('message', 'Post created successfully!');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('/blog')->with('message', 'Post deleted succsessfully!');
    }

    public function edit($id){

        $post = Post::find($id);

        return view('backend.blog.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'body' => 'required',
            'blog_photo' => 'required|mimes:jpeg,png,jpg'
        ]);
        if($request->hasFile('blog_photo')){
            $file = $request->file('blog_photo');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/blog/photos', $filename);
            Post::where('id', $id)->update([
                'title' => request('title'),
                'slug' => Str::slug(request('title')),
                'body' => request('body'),
                'blog_photo' => $filename,
                'status' =>request('status'),
            ]);

            return redirect('/blog')->with('message', 'Post updated succsessfully!');
            }
    }

    public function trash() {

        $posts = Post::onlyTrashed()->paginate(10);
        return view('backend.blog.trash', compact('posts'));
    }

    public function restore($id) {

        Post::onlyTrashed()->where('id', $id)->restore();

        return redirect('/blog')->with('message', 'Post restored succsessfully!');
    }

    public function toggle($id) {

        $post = Post::findOrFail($id);
        $post->status = !$post->status;
        $post->save();

        return redirect('/blog')->with('message', 'Post status updated succsessfully!');
    }

    public function show($id) {

        $post = Post::findOrFail($id);

        return view('backend.blog.show', compact('post'));
    }

    public function getAllJobs() {

        $jobs = Job::latest()->paginate(10);

        return view('backend.jobs.index', compact('jobs'));
    }

    public function allJobsToggle($id) {

        $job = Job::findOrFail($id);
        $job->status = !$job->status;
        $job->save();

        return redirect('/dashboard/jobs')->with('message', 'Job status updated succsessfully!');
    }

    public function logout(Request $request) {

        Auth::logout();
        return redirect('/login');
    }


    public function indexCategories() {

        $categories = Category::paginate(10);

        return view('backend.categories.index', compact('categories'));
    }

    public function createCategory() {

        return view('backend.categories.create');
    }

    public function storeCategory(Request $request) {

        $this->validate($request, [
            'name' => 'required',
        ]);
            Category::create([
                'name' => request('name'),
            ]);

        return redirect('/categories')->with('message', 'Category created successfully!');
    }


    public function editCategory($id){

        $category = Category::find($id);

        return view('backend.categories.edit', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
            Category::where('id', $id)->update([
                'name' => request('name'),

            ]);

            return redirect('/categories')->with('message', 'Category updated succsessfully!');

    }

    public function destroyCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('/categories')->with('message', 'Category deleted succsessfully!');
    }


}
