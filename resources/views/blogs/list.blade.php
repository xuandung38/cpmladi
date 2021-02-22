@extends('layouts.app', ['website' => [
	'title' => 'Blog',
	'description' => 'Blog',
	'thumbnail' => null,
	'url' => null
]])
@section('content')
	<div class="section">
		<div class="container">
			<div class="row">
				@foreach($posts as $item)
				<div class="col-12 col-sm-8 col-md-6 col-lg-4">
					<div class="ui-card ui-curve color-card shadow-xl">
						<img class="card-img" src="{{ url('images', $item->thumbnail) }}" alt="Bologna">
						<div class="card-body">
							<h4 class="card-title"><a href="{{ route('post.detail', $item->slug) }}">{{ $item->title }}</a> </h4>
							<small class="text-muted cat">
								<i class="far fa-clock text-info"></i> {{ $item->created_at->diffForHumans() }}</small>
							<p class="card-text">{{ Str::limit($item->description, 255) }}</p>
							<a href="{{ route('post.detail', $item->slug) }}" class="btn btn-info">Xem thêm</a>
						</div>
						<div class="card-footer text-muted d-flex justify-content-between bg-transparent border-top-0">
							<div class="views">{{ $item->category->title }}</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
@stop