@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
	<h1>Dashboard</h1>
@stop

@section('content')
	<div class="col-md-6">
		<div class="card card-secondary">
			<div class="card-header">
				<h3 class="card-title">Custom Elements</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="alert alert-default-info" {{ session('status') ? '' : 'hidden' }}>{{ session('status') }}</div>
				<form method="POST" action="{{ route('admin.blogCategory.update',$blogCategory->slug ) }}">
					@csrf
					@method('PATCH')
					<input name="id" value="{{ $blogCategory->id }}" hidden>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="parent_id">Danh mục cha</label>
								<select class="form-control" id="parent_id" name="parent_id">
									<option value="">---</option>
									@foreach($categories as $item)
										<option value="{{ $item->id }}" {{ ($blogCategory->parent_id == $item->id) ? 'selected' : '' }}>{{ $item->title }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group">
								<label for="title">Icon</label>
								<input type="text" class="form-control" id="icon" name="icon" placeholder="vd: fas fa-book" value="{{ $blogCategory->icon }}">
								@error('icon')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							<!-- checkbox -->
							<div class="form-group">
								<label for="title">Tiêu đề</label>
								<input type="text" class="form-control" id="title" name="title" value="{{ $blogCategory->title }}">
								@error('title')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group">
								<label for="description">Mô Tả</label>
								<textarea class="form-control" name="description" id="description" rows="3">{{ $blogCategory->description }}</textarea>
								@error('description')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>

							<div class="form-group">
								<div class="custom-control custom-switch">
									<input type="checkbox" class="custom-control-input" id="is_active" name="is_active" {{ $blogCategory->is_active ? 'checked' : '' }}>
									<label class="custom-control-label" for="is_active">Kích hoạt</label>
								</div>
							</div>

							<div class="form-group clearfix">
								<a href="{{ route('admin.blogCategory.index') }}" class="btn btn-danger float-left"><i class="fa fa-backward"></i> Quay lại</a>
								<button type="submit" class="btn btn-success float-right"><i class="fa fa-save"></i> Lưu</button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- /.card-body -->
		</div>
	</div>
@stop

@section('css')
	<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
	<script> console.log('Hi!'); </script>
@stop