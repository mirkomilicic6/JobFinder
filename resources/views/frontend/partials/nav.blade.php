<div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->


    <div class="site-navbar-wrap js-site-navbar bg-white">

      <div class="container">
        <div class="site-navbar bg-light">
          <div class="py-1">
            <div class="row align-items-center">
              <div class="col-2">
                <h2 class="mb-0 site-logo"><a href="{{ route('jobs.index') }}">Job<strong class="font-weight-bold">Finder</strong> </a></h2>
              </div>
              <div class="col-10">
                <nav class="site-navigation text-right" role="navigation">
                  <div class="container">
                    <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

                    <ul class="site-menu js-clone-nav d-none d-lg-block">
                    @if(!Auth::check())
                      <li><a href="/register">Job Seekers</a></li>
                      <li>
                        <a href="{{ route('employer.register') }}">Employers</a>
                      </li>
                    @elseif (Auth::user()->user_type=='seeker')
                    <li class="has-children">
                        <a href="#">Profile</a>
                        <ul class="dropdown arrow-top">
                            <li><a href="/user/profile">User profile</a></li>
                            <li><a href="{{ route('my.applications') }}">My applications</a></li>
                            <li><a href="/jobs/my-jobs">Saved jobs</a></li>
                        </ul>

                    </li>
                    @elseif (Auth::user()->user_type=='employer')
                    <li>
                        <a href="{{ route('jobs.create') }}" class="btn btn-primary text-white py-3 px-4 rounded">Post a job</a>
                    </li>
                    <li class="has-children">
                        <a href="#">My company</a>
                        <ul class="dropdown arrow-top">
                            <li><a href="/company/create">Company profile</a></li>
                            <li><a href="{{ route('jobs.applicants') }}">Applicants</a></li>
                            <li><a href="{{ route('company.jobsByCompany') }}">My company jobs</a></li>
                        </ul>
                    </li>
                    @endif
                      <li><a href="{{ route('companies.all') }}">Companies</a></li>
                      <li><a href="{{ route('jobs.all') }}">Jobs</a></li>
                      <li><a href="{{ route('blog.allPosts') }}">Blog</a></li>
                      <li><a href="/about">About me</a></li>
                      <li>
                    @if(!Auth::check())
                        <button type="button" class="btn btn-primary text-white py-3 px-4 rounded" data-toggle="modal" data-target="#exampleModal">
                            Login
                        </button>
                    @else
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                     <b>{{ __('Logout') }}</b>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                    @endif


                      </li>


                    </ul>
                  </div>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div style="height: 150px;"></div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Login</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-12">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-8 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">


                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">
            {{ __('Login') }}
        </button>
        </form>
        </div>
      </div>
    </div>
  </div>
