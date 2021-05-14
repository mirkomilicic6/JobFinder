<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['verified', 'auth', 'seeker']);
    }

    public function index()
    {
        return view('profile.index');
    }

    public function allUsers() {

        $allUsers = User::paginate(20);

        return view('backend.users.index', compact('allUsers'));
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
        $this->validate($request,[
            'address' => 'required',
            'bio' => 'required|min:20',
            'experience' => 'required|min:20',
            'phone_number' => 'required|min:7|numeric'

        ]);
        $user_id = auth()->user()->id;
        Profile::where('user_id', $user_id)->update([
            'address' => request('address'),
            'experience' => request('experience'),
            'bio' => request('bio'),
            'phone_number' => request('phone_number'),
        ]);
        //dd($user_id);
        return redirect()->back()->with('message', 'Profile updated succsessfully!');
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
        $user = User::findOrFail($id);

        return view('backend.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/dashboard/users/all')->with('message', 'User deleted succsessfully!');
    }

    public function coverletter(Request $request) {

        $this->validate($request,[
            'cover_letter' => 'required|mimes:pdf,doc,docx'
        ]);

        $user_id = auth()->user()->id;
        $cover = $request->file('cover_letter')->store('public/files');
        //dd($cover);
        Profile::where('user_id', $user_id)->update([
            'cover_letter' => $cover,
        ]);

        return redirect()->back()->with('message', 'Cover letter updated succsessfully!');
    }

    public function resume(Request $request) {

        $this->validate($request,[
            'resume' => 'required|mimes:pdf,doc,docx'
        ]);

        $user_id = auth()->user()->id;
        $cover = $request->file('resume')->store('public/files');
        //dd($cover);
        Profile::where('user_id', $user_id)->update([
            'resume' => $cover,
        ]);

        return redirect()->back()->with('message', 'Resume updated succsessfully!');
    }

    public function avatar(Request $request) {

        $this->validate($request,[
            'avatar' => 'required|mimes:jpg,jpeg,png'
        ]);
        $user_id = auth()->user()->id;
        if($request->hasfile('avatar')) {
            $file = $request->file('avatar');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/avatar/', $filename);

            Profile::where('user_id', $user_id)->update([
                'avatar' => $filename
            ]);
            return redirect()->back()->with('message', 'Profile picture updated succsessfully!');
        }
    }
}
