@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
	<h1>Dashboard</h1>
@stop

@section('content')
	<div class="col-md-12">
		<div class="alert alert-default-info" {{ session('status') ? '' : 'hidden' }}>{{ session('status') }}</div>

		<div class="card card-secondary">
			<div class="card-header">
				<h3 class="card-title">Chỉnh sửa template index</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<form method="POST" action="{{ route('admin.ladi.update') }}">
					@csrf
					@method('PATCH')
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="description">Nội dung</label>
								<textarea class="form-control" name="code"
								          id="code">{{ request()->input('content', $html) }}</textarea>
								@error('content')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group clearfix">
								<a href="{{ route('admin.ladi.reset') }}" class="btn btn-danger float-left"><i
											class="fa fa-recycle"></i> Reset Template Gốc</a>
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

@section('js')

	<script>
        var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
            lineNumbers: true,
            mode: "text/html",
            matchBrackets: true,
            styleActiveLine: true,
            theme: "night",
        });

	</script>
@stop