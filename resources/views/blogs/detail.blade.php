@extends('layouts.app', ['website' => [
	'title' => $post->title .' - '. config('app.name'),
	'description' => $post->description,
	'thumbnail' =>  url('images', $post->thumbnail),
	'url' =>  route('post.detail', $post->slug)
]])
@section('content')
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="mt-4">{{ $post->title }}</h1>
					<p class="lead">
					Danh mục	{{ $post->category->title }} - Posted on {{ $post->created_at->diffForHumans() }}
					</p>
					<hr>
					<img class="img-fluid rounded img-responsive" src="{{ url('images', $post->thumbnail) }}" alt="">
					<hr>
					<p class="lead">
						{{  $post->description }}
					</p>
					{!! $post->content !!}
				</div>
			</div>
		</div>
	</div>
@stop