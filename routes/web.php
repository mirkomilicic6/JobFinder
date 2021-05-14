<?php

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\EmployerRegisterController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


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
//Route::view('demo', 'demo');

//JOBS
Route::get('/', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/create', [JobController::class, 'create'])->middleware('employer')->name('jobs.create');
Route::post('/jobs/create', [JobController::class, 'store'])->middleware('employer')->name('jobs.store');
Route::get('/jobs/{id}/edit', [JobController::class, 'edit'])->middleware('employer')->name('jobs.edit');
Route::post('/jobs/{id}/update', [JobController::class, 'update'])->middleware('employer')->name('jobs.update');
Route::get('/jobs/{id}/{job}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs/my-jobs', [JobController::class, 'myJobs'])->middleware('seeker')->name('my.jobs');
Route::get('/jobs/my-applications', [JobController::class, 'app'])->middleware('seeker')->name('my.applications');


//APPLICATIONS JOB CONTROLLER TOO
Route::post('/applications/{id}', [JobController::class, 'apply'])->name('jobs.apply');
Route::get('/jobs/applications', [JobController::class, 'applicant'])->name('jobs.applicants');
Route::get('/jobs/alljobs', [JobController::class, 'allJobs'])->name('jobs.all');


//COMPANY
Route::get('/company/{id}/{company}', [CompanyController::class, 'show'])->name('company.index');
Route::get('/company/create', [CompanyController::class, 'create'])->middleware('employer')->name('company.create');
Route::post('/company/create', [CompanyController::class, 'store'])->middleware('employer')->name('company.store');
Route::post('/company/coverphoto', [CompanyController::class, 'coverPhoto'])->middleware('employer')->name('cover.photo');
Route::post('/company/logo', [CompanyController::class, 'companyLogo'])->middleware('employer')->name('company.logo');
Route::get('/company/jobs', [CompanyController::class, 'jobsByCompany'])->middleware('employer')->name('company.jobsByCompany');

//USER PROFILE
Route::get('/user/profile', [UserController::class, 'index'])->middleware('seeker')->name('profile.index');
Route::post('/user/profile/create', [UserController::class, 'store'])->middleware('seeker')->name('profile.store');
Route::post('/user/coverletter', [UserController::class, 'coverletter'])->middleware('seeker')->name('cover.letter');
Route::post('/user/resume', [UserController::class, 'resume'])->middleware('seeker')->name('resume');
Route::post('/user/avatar', [UserController::class, 'avatar'])->middleware('seeker')->name('avatar');

//EMPLOYER
Route::view('employer/register', 'auth.employer-register')->name('employer.register');
Route::post('/employer/register', [EmployerRegisterController::class, 'employerRegister'])->name('emp.register');

//APPLICATIONS JOB CONTROLLER TOO
//Route::get('/applications/{id}', [JobController::class, 'apply'])->name('jobs.apply');




Auth::routes(['verify' => true]);

//HOME
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::view('/about', 'frontend.about');

//EMAIL VERIFY
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


//SAVE AND UNSAVE JOBS
Route::post('/save/{id}', [FavouriteController::class, 'saveJob']);
Route::post('/unsave/{id}', [FavouriteController::class, 'unSave']);

//SEARCH
Route::get('/jobs/search', [JobController::class, 'searchJobs'])->name('jobs.search');

//Category
Route::get('/category/{id}', [CategoryController::class, 'index'])->name('category.index');


//Company
Route::get('/companies', [CompanyController::class, 'companies'])->name('companies.all');

//Email
Route::post('/jobs/mail', [EmailController::class, 'send'])->name('mail');

//Admin
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('admin')->name('admin.dashboard');
Route::get('/dashboard/logout', [DashboardController::class, 'logout'])->middleware('admin')->name('admin.logout');


//Admin blog
Route::get('/blog', [DashboardController::class, 'allPosts'])->name('blog.allPosts');
Route::get('/blog-all', [DashboardController::class, 'index'])->middleware('admin')->name('blog.allposts');
Route::get('/blog/create', [DashboardController::class, 'create'])->middleware('admin')->name('blog.create');
Route::post('/blog/create', [DashboardController::class, 'store'])->middleware('admin')->name('blog.store');
Route::post('/blog/{id}/delete', [DashboardController::class, 'destroy'])->middleware('admin')->name('blog.destroy');
Route::get('/blog/{id}/edit', [DashboardController::class, 'edit'])->middleware('admin')->name('blog.edit');
Route::post('/blog/{id}/update', [DashboardController::class, 'update'])->middleware('admin')->name('blog.update');
Route::get('/blog/{id}/toggle', [DashboardController::class, 'toggle'])->middleware('admin')->name('blog.toggle');
Route::get('/blog/{id}/{slug}', [DashboardController::class, 'show'])->name('blog.show');


//Blog trash
Route::get('/dashboard/trash', [DashboardController::class, 'trash'])->middleware('admin')->name('blog.trash');
Route::get('/dashboard/{id}/trash', [DashboardController::class, 'restore'])->middleware('admin')->name('blog.restore');


//Admin users
Route::get('/dashboard/users/all', [UserController::class, 'allUsers'])->middleware('admin')->name('admin.allUsers');
Route::post('/dashboard/users/{id}/delete', [UserController::class, 'destroy'])->middleware('admin')->name('admin.users.destroy');
Route::get('/dashboard/users/{$id}/edit', [UserController::class, 'edit'])->middleware('admin')->name('admin.users.edit');

//Testimonial
Route::get('/testimonial', [TestimonialController::class, 'index'])->middleware('admin')->name('testimonial.index');
Route::get('/testimonial/create', [TestimonialController::class, 'create'])->middleware('admin')->name('testimonial.create');
Route::post('/testimonial/create', [TestimonialController::class, 'store'])->middleware('admin')->name('testimonial.store');

//Admin jobs
Route::get('/dashboard/jobs', [DashboardController::class, 'getAllJobs'])->middleware('admin')->name('admin.getAllJobs');
Route::get('/dashboard/jobs/{id}/toggle', [DashboardController::class, 'allJobsToggle'])->middleware('admin')->name('admin.getAllJobs.toggle');
Route::get('/categories', [DashboardController::class, 'indexCategories'])->middleware('admin')->name('backendCategory.index');
Route::get('/categories/create', [DashboardController::class, 'createCategory'])->middleware('admin')->name('backendCategory.create');
Route::post('/categories/store', [DashboardController::class, 'storeCategory'])->middleware('admin')->name('backendCategory.store');
Route::get('/categories/{id}/edit', [DashboardController::class, 'editCategory'])->middleware('admin')->name('backendCategory.edit');
Route::post('/categories/{id}/update', [DashboardController::class, 'updateCategory'])->middleware('admin')->name('backendCategory.update');
Route::post('/categories/{id}/delete', [DashboardController::class, 'destroyCategory'])->middleware('admin')->name('backendCategory.destroy');
