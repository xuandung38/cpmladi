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
			<form method="POST" action="{{ route('admin.blogCategory.store') }}">
				@csrf
				@method('POST')
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label for="parent_id">Danh mục cha</label>
							<select class="form-control" id="parent_id" name="parent_id">
								<option value="">---</option>
								@foreach($categories as $item)
									<option value="{{ $item->id }}">{{ $item->title }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="title">Icon</label>
							<input type="text" class="form-control" id="icon" name="icon" placeholder="vd: fas fa-book">
							@error('icon')
							<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
						<div class="form-group">
							<label for="title">Tiêu đề</label>
							<input type="text" class="form-control" id="title" name="title">
							@error('title')
							<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
						<div class="form-group">
							<label for="description">Mô Tả</label>
							<textarea class="form-control" name="description" id="description" rows="3"></textarea>
							@error('description')
							<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>

						<div class="form-group">
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" id="status" name="status" checked>
								<label class="custom-control-label" for="status">Kích hoạt</label>
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
	<link rel="stylesheet" href="{{ asset('/css/admin_custom.css') }}">

@stop

@section('js')
	<script> $(function() {
            $(document).on("change",".uploadFile", function()
            {
                var uploadFile = $(this);
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

                if (/^image/.test( files[0].type)){ // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function(){ // set image data as background of div
                        //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                        uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
                    }
                }

            });
        });
	</script>
@stop