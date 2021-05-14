<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['verified', 'auth', 'employer'], ['except' => ['show', 'companies']]);
    }


    public function index($id, Company $company)
    {
        $jobs = Job::where('user_id', $id)->get();

        return view('company.index', compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

        /* $this->validate($request,[
            'address' => 'required',
            'bio' => 'required|min:20',
            'experience' => 'required|min:20',
            'phone_number' => 'required|min:7|numeric'

        ]); */
        $user_id = auth()->user()->id;
        Company::where('user_id', $user_id)->update([
            'address' => request('address'),
            'phone' => request('phone'),
            'website' => request('website'),
            'slogan' => request('slogan'),
            'description' => request('description'),
        ]);
        //dd( Company::where('user_id', $user_id));

        return redirect()->back()->with('message', 'Company updated succsessfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function coverPhoto(Request $request) {

        $user_id = auth()->user()->id;

        if($request->hasfile('cover_photo')) {

            $file = $request->file('cover_photo');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/coverphoto/', $filename);

            Company::where('user_id', $user_id)->update([
                'cover_photo' => $filename
            ]);

            return redirect()->back()->with('message', 'Company cover photo updated succsessfully!');
        }
    }

    public function companyLogo(Request $request) {

        $user_id = auth()->user()->id;

        if($request->hasfile('logo')) {

            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/logo/', $filename);

            Company::where('user_id', $user_id)->update([
                'logo' => $filename
            ]);

            return redirect()->back()->with('message', 'Company logo updated succsessfully!');
        }
    }


    public function show($id, Company $company)
    {
        return view('company.show', compact('company'));
    }

    public function companies() {

        $companies = Company::paginate(15);

        return view('company.allcompanies', compact('companies'));
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
        //
    }

    public function jobsByCompany()
    {
        $id = Auth::user()->id;
        //dd($id);
        $jobs = Job::where('user_id', $id)->get();
        //dd($jobs);
        return view('company.jobsByCompany', compact('jobs'));
    }

}
