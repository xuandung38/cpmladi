@extends('layouts.app', ['website' => [
	'title' => 'Blog',
	'description' => 'Blog',
	'thumbnail' => null,
	'url' => null
]])
@section('css')
	<link rel="stylesheet" href="{{ asset('assets/css/main.css')  }}"/>
@stop
@section('content')
	<div class="section container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form" action="{{ route('admin.contact.index') }}">
				@csrf
				@method('POST')
					<span class="contact100-form-title">
					Liên hệ
					</span>
				<div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate="Name is required">
					<span class="label-input100">Họ Và Tên *</span>
					<input class="input100" type="text" name="name" placeholder="Enter your name">
				</div>
				<div class="wrap-input100 rs1-wrap-input100">
					<span class="label-input100">Địa chỉ email *</span>
					<input class="input100" type="text" name="email" placeholder="Enter your email">
				</div>
				<div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate="Name is required">
					<span class="label-input100">Số điện thoại *</span>
					<input class="input100" type="text" name="name" placeholder="Enter your name">
				</div>
				<div class="wrap-input100 rs1-wrap-input100">
					<span class="label-input100">Địa chỉ phòng game *</span>
					<input class="input100" type="text" name="email" placeholder="Enter your email">
				</div>
				<div class="wrap-input100 validate-input" data-validate="Message is required">
					<span class="label-input100">Tin nhắn</span>
					<textarea class="input100" name="message" placeholder="Your message here..."></textarea>
				</div>
				<div class="container-contact100-form-btn">
					<div class="wrap-contact100-form-btn">
						<div class="contact100-form-bgbtn"></div>
						<button class="contact100-form-btn" >
							Submit
						</button>
					</div>
				</div>
			</form>
		</div>
		<span class="contact100-more">
		Call us on +098 765 3333
		</span>
	</div>
@stop
@section('js')
	<script>
        $('#submit').click({
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
        });
	</script>
@stop