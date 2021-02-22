@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
	<h1>Dashboard</h1>
@stop

@section('content')
	<div class="card  card-secondary">
		<div class="card-header">
			<h3 class="card-title">Danh sách bài viết Blog</h3>
			<div class="card-tools">
				<a href="{{ route('admin.post.create') }}" class="btn btn-success">
					<i class="fas fa-plus-circle"></i> Thêm
				</a>
			</div>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
			<div class="alert alert-default-info" {{ session('status') ? '' : 'hidden' }}>{{ session('status') }}</div>
			<table class="table table-bordered">
				<thead>
				<tr>
					<th style="width: 10px">#</th>
					<th>Tiêu đề</th>
					<th>Danh mục</th>
					<th>Ngày viết</th>
					<th>Trạng thái</th>
					<th style="width: 150px">Hành động</th>
				</tr>
				</thead>
				<tbody>
				@foreach($posts as $post)
					<tr id="post-{{ $post->id  }}">
						<td>#{{ $post->id }}</td>
						<td><a href="{{ route('admin.blogCategory.show', $post) }}">{{ $post->title }} </a></td>
						<td>{{ $post->category->title }}</td>
						<td>{{ $post->created_at }}</td>
						<td>
							{!!  $post->is_active ? '<span class="badge badge-success">Kích hoạt</span>' : '<span class="badge badge-danger">Tắt</span>' !!}
						</td>
						<td>
							<a href="{{ route('admin.post.edit', $post->slug) }}" class="btn btn-sm btn-dark"><i
										class="fas fa-pen"></i> Sửa</a>
							<button type="button" class="btn btn-sm btn-danger" onclick="destroyPost('{{ route('admin.post.destroy', $post->slug) }}','{{ $post->title }}')">
								<i class="fas fa-trash"></i> Xoá</button>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
		<!-- /.card-body -->
		<div class="card-footer clearfix">
			{{ $posts->links() }}
		</div>
	</div>
	<!-- /.card -->

@stop

@section('js')
	<script>
        function destroyPost(route,post){
            Swal.fire({
                title: 'Bạn chắc chứ?',
                text: "Danh mục " +post+ " sẽ không thể khôi phục sau khi xoá",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Vâng, Xoá nó!',
                cancelButtonText: 'Huỷ bỏ!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        method: 'DELETE',
                        url: route,
                        dataType: 'json',
                        success: function (data) {
                            if (data.status === true) {
                                Swal.fire(
                                    'Đã Xoá!',
                                    post + ' đã được xoá.',
                                    'success'
                                );
                                let row = document.getElementById("post-" +data.id);
                                row.remove();
                            } else {
                                Swal.fire(
                                    'Đã Xoá!',
                                    'Có lỗi xảy ra',
                                    'error'
                                )
                            }
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });
                }
            })
        }
	</script>
@stop
