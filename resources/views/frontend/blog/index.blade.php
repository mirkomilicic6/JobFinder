@extends('layouts.main')

@section('content')
<div class="unit-5 overlay" style="background-image: url('external/images/hero_1.jpg');">
    <div class="container text-center">
      <h2 class="mb-0">Blog</h2>
      <p class="mb-0 unit-6"><a href="/">Home</a> <span class="sep">></span> <span>Blog</span></p>
    </div>
  </div>


  <div class="site-section bg-light">
    <div class="container">
      <div class="row">
          @foreach ($posts as $post)
          <div class="col-md-6 mb-5 mb-lg-4 col-lg-3" data-aos="fade">
            <div class="position-relative unit-8">
            <a href="{{ route('blog.show', [$post->id, $post->slug]) }}" class="mb-3 d-block img-a"><img src="{{asset('uploads/blog/photos')}}/{{$post->blog_photo}}" alt="Image" class="img-fluid rounded"></a>
            <span class="d-block text-gray-500 text-normal small mb-3">By <a href="#">Admin</a> <span class="mx-2">&bullet;</span> {{ $post->created_at->diffForHumans() }}</span>
            <h2 class="h5 font-weihgt-normal line-height-sm mb-3"><a href="{{ route('blog.show', [$post->id, $post->slug]) }}" class="text-black">{{ $post->title }}</a></h2>
            <p>{{str_limit($post->body, 100)}}</p>
            </div>
          </div>

          @endforeach

      </div>
      {{ $posts->links() }}
    </div>
  </div>
@endsection
<style>
.img-fluid rounded{
    width: 255;
    height: 166;
    object-fit: contain;
}
</style>


