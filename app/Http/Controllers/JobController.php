<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Post;
use App\Models\User;
use App\Models\Company;
use App\Models\Category;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\JobPostRequest;
use Spatie\QueryBuilder\AllowedFilter;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['verified', 'auth'], ['except' => ['index', 'show', 'allJobs'
        ]]);
    }

    public function index()
    {
        $jobs = Job::latest()->limit(10)->where('status', 1)->get();
        $categories = Category::with('jobs')->get();
        $categories2 = clone $categories;
        //dd($footer);
        $posts = Post::where('status', 1)->get();
        $testimonial = Testimonial::orderBy('id', 'DESC')->first();
        //dd($posts);
        $companies = Company::get()->random(12);

        return view('frontend.index', compact(['jobs', 'companies', 'categories', 'posts', 'testimonial', 'categories2']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all();
        return view('jobs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobPostRequest $request)
    {
        $user_id = auth()->user()->id;
        $company = Company::where('user_id', $user_id)->first();
        $company_id = $company->id;
        Job::create([
            'user_id' => $user_id,
            'company_id' => $company_id,
            'title' => request('title'),
            'slug' => Str::slug(request('title')),
            'description' => request('description'),
            'roles' => request('roles'),
            'category_id' => request('category_id'),
            'position' => request('position'),
            'address' => request('address'),
            'type' => request('type'),
            'status' => request('status'),
            'last_date' => request('last_date'),
            'number_of_vacancy' => request('number_of_vacancy'),
            'gender' => request('gender'),
            'experience' => request('experience'),
            'salary' => request('salary'),
        ]);

        return redirect()->back()->with('message', 'Job posted succsessfully!');

    }

    public function myJobs() {

        $jobs  = Auth::user()->favourites;
        //dd($jobs);
        return view('jobs.myjob', compact('jobs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Job $job)
    {
        //dd($job);
        $job = Job::findOrFail($id);
        $data = [];

        $jobBasedOnCategories = Job::latest()
                                ->where('category_id', $job->category_id)
                                ->whereDate('last_date','>', date('Y-m-d'))
                                ->where('status', '1')
                                ->where('id', '!=', $job->id)
                                ->limit(6)
                                ->get();
        array_push($data, $jobBasedOnCategories);

        $jobBasedOnCompany = Job::latest()
                                ->where('company_id', $job->company_id)
                                ->whereDate('last_date','>', date('Y-m-d'))
                                ->where('id', '!=', $job->id)
                                ->where('status', '1')
                                ->limit(6)
                                ->get();
        array_push($data, $jobBasedOnCompany);

        $jobBasedOnPosition = Job::latest()
                                ->where('position', 'LIKE', '%'.$job->position.'%')
                                ->whereDate('last_date','>', date('Y-m-d'))
                                ->where('id', '!=', $job->id)
                                ->where('status', '1')
                                ->limit(6);
        array_push($data, $jobBasedOnPosition);

        $collection = collect($data);
        $unique = $collection->unique("id");
        $jobRecommendations = $unique->values()->first();

        return view('jobs.show', compact('job', 'jobRecommendations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $job = Job::findOrFail($id);
        //dd($job);
        return view('jobs.edit', compact('job', 'categories'));
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
        $job = Job::findOrFail($id);
        $job->update($request->all());

        return redirect()->back()->with('message', 'Job updated succsessfully!');
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

    public function apply(Request $request, $id) {

        $jobId = Job::find($id);
        //dd($jobId);

        $jobId->users()->attach(Auth::user()->id);

        return redirect()->back()->with('message', 'Application sent succsessfully!');
    }

    public function applicant() {

        $applicants = Job::has('users')->where('user_id', auth()->user()->id)->get();
        //dd($applicants);
        return view('jobs.applicants', compact('applicants'));
    }

    public function allJobs(Request $request) {

        //frontend search
        $search = $request->get('search');
        $categories = Category::all();
        //$address = $request->get('address');
        if($search) {
            $jobs = Job::where('position', 'LIKE', '%'.$search.'%')
                    ->orWhere('title', 'LIKE', '%'.$search.'%')
                    ->orWhere('type', 'LIKE', '%'.$search.'%')
                    ->paginate(10);
            return view('jobs.alljobs', compact('jobs', 'categories'));
        }


        $keyword = $request->get('title');
        $type = $request->get('type');
        $category = $request->get('category_id');

        //dd($category);
        $categories = Category::all();
        if($keyword||$type||$category){
            $jobs = Job::where('category_id', '=', $category)
                    ->orWhere('title','like','%'.$keyword.'%')
                    ->orWhere('type', '=', $type)
                    ->paginate(10);
        }else{
        $categories = Category::all();
        $jobs = Job::latest()->paginate(10);
        }

        return view('jobs.alljobs', compact('jobs', 'categories'));
    }

        public function searchJobs(Request $request) {

            $keyword = $request->get('keyword');
            $job = Job::where('title', 'LIKE', '%'.$keyword.'%')
                        ->orWhere('position', 'LIKE', '%'.$keyword.'%')
                        ->limit(5)->get();

            return response()->json($job);
        }

        public function app() {

            $applications = Auth::user()->jobs;
            //dd($user);
            return view('jobs.myapplications', compact('applications'));
        }

}
