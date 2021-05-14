<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
        $this->middleware(['verified', 'auth']);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

       /*  if(auth::user()->user_type=='employer'){
            return redirect()->to('/company/create');
        }
         $adminRole = Auth::user()->roles->pluck('name');
         dd($adminRole);
            if($adminRole->contains('admin')){
                return redirect()->to('/dashboard');
            } */



        $categories = Category::all();
        $jobs  = Auth::user()->favourites;
        return view('home',compact('jobs', 'categories'));
    }
}
