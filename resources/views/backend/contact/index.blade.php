@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
	<h1>Dashboard</h1>
@stop

@section('content')

	<div class="alert alert-default-info" {{ session('status') ? '' : 'hidden' }}>{{ session('status') }}</div>
	<div class="card  card-secondary">
		<div class="card-header">
			<h3 class="card-title">Danh sách Liên hệ</h3>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
			<table class="table table-bordered">
				<thead>
				<tr>
					<th style="width: 10px">#</th>
					<th>Họ Tên</th>
					<th>Email & SĐT</th>
					<th>Địa chỉ</th>
					<th>Lời nhắn</th>
					<th>Ngày yêu cầu</th>
					<th>Trạng thái</th>
					<th style="width: 150px">Hành động</th>
				</tr>
				</thead>
				<tbody>
				@foreach($contacts as $item)
					<tr id="contact-{{ $item->id  }}">
						<td>#{{ $item->id }}</td>
						<td>{{ $item->fullname }}</td>
						<td>{{ $item->email }} - {{ $item->phone }}</td>
						<td>{{ $item->address }}</td>
						<td>{{ $item->message }}</td>
						<td>{{ $item->created_at }}</td>
						<td>
							{!!  $item->is_active ? '<span class="badge badge-success">Kích hoạt</span>' : '<span class="badge badge-danger">Tắt</span>' !!}
						</td>
						<td>
							<button type="button" class="btn btn-sm btn-danger" onclick="destroyPost('{{ route('admin.post.destroy', $item->slug) }}','{{ $item->title }}')">
								<i class="fas fa-trash"></i> Xoá</button>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
		<!-- /.card-body -->
		<div class="card-footer clearfix">
			{{ $contacts->links() }}
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
