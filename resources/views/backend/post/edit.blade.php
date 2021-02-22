@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
	<h1>Dashboard</h1>
@stop

@section('content')
	<div class="col-md-12">
		<div class="card card-secondary">
			<div class="card-header">
				<h3 class="card-title">Custom Elements</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<form method="POST" action="{{ route('admin.post.update', $post->slug) }}" enctype="multipart/form-data">
					@csrf
					@method('PATCH')

					<input name="id" value="{{ $post->id }}" hidden>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="blog_category_id">Danh mục</label>
								<select class="form-control" id="blog_category_id" name="blog_category_id">
									<option>Chọn danh mục</option>
									@foreach($categories as $item)
										<option value="{{ $item->id }}"  {{ (request()->input('blog_category_id',  $post->blog_category_id) == $item->id) ? 'selected' : '' }}>{{ $item->title }}</option>
									@endforeach
								</select>

								@error('blog_category_id')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-sm-4 imgUp">
										<div class="imagePreview" style="background: url('{{ url('images', $post->thumbnail) }}') ; background-size:cover"></div>
										<label class="btn btn-chose-file">
											Chọn Og:image
											<input type="file" class="uploadFile img" name="thumbnail" style="width: 0px;height: 0px;overflow: hidden;">
										</label>
									</div><!-- col-2 -->
								</div><!-- row -->

								@error('thumbnail')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group">
								<label for="title">Tiêu đề</label>
								<input type="text" class="form-control" id="title" name="title"  value="{{ request()->input('title', $post->title) }}">
								@error('title')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group">
								<label for="description">Mô Tả</label>
								<textarea class="form-control" name="description" id="description" rows="3">{{ request()->input('description',$post->description) }}</textarea>
								@error('description')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group">
								<label for="description">Nội dung</label>
								<textarea class="form-control" name="content" id="content" rows="3">{{ request()->input('content', $post->content) }}</textarea>
								@error('content')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>


							<div class="form-group">
								<div class="custom-control custom-switch">
									<input type="checkbox" class="custom-control-input" id="is_active" name="is_active"
									       checked>
									<label class="custom-control-label" for="is_active">Kích hoạt</label>
								</div>
							</div>
							<div class="form-group clearfix">
								<a href="{{ route('admin.post.index') }}" class="btn btn-danger float-left"><i
											class="fa fa-backward"></i> Quay lại</a>
								<button type="submit" class="btn btn-success float-right"><i class="fa fa-save"></i> Lưu
								</button>
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
	<script>
        CKEDITOR.replace( 'content' );
        $(function () {
            $(document).on("change", ".uploadFile", function () {
                var uploadFile = $(this);
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

                if (/^image/.test(files[0].type)) { // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function () { // set image data as background of div
                        //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                        uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url(" + this.result + ")");
                    }
                }

            });
        });
	</script>
@stop