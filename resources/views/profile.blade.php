<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ $company->company_name }}</title>
	<!-- Styles -->
	<link href={{ asset('css/bootstrap.min.css') }} rel="stylesheet">
	<link href={{ asset('css/font-awesome.min.css') }} rel="stylesheet">
	<link href={{ asset('css/footer.css') }} rel="stylesheet">
	<link href={{ asset('css/megabaut.css') }} rel="stylesheet">
	<link href={{ asset('css/responsive.css') }} rel="stylesheet">
	<link href={{ asset('css/toastr.min.css') }} rel="stylesheet">
	<script type="text/javascript" src={{ asset('js/jquery.min.js') }}></script>
	<script type="text/javascript" src={{ asset('js/bootstrap.min.js') }}></script>
	<script type="text/javascript" src={{ asset('js/lazysizes.min.js') }}></script>
	<script type="text/javascript" src={{ asset('js/toastr.min.js') }}></script>
</head>
<body>
	<nav class="navbar navbar-default navbar-static-top navbar-menu">
		<div class="container-fluid">
			<div class="text-center">
				<a href="{{ route('index') }}">
					<img src="{{ asset('images/' . $company->logo_path) }}" width="160">
				</a>
			</div>
			<div class="row">
                @if(Session::get('message'))
                    <div class="alert alert-info alert-dismissable fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-fw fa-close"></i></a>
                        {{ Session::get('message') }}
                    </div>
                @endif
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
                            <a href="{{ route('index') }}" style="margin-right: 20px">Home</a>
                            @if($user)
                                <a href="{{ route('user.index') }}" role='button' aria-expanded='false' style='margin-left: 40px'>{{ $user->name }}</a>
                                <a href="{{ route('transaction.index') }}" role='button' aria-expanded='false' style='margin-left: 40px'>Transaksi</a>
                                <a href="{{ route('cart.index') }}" role='button' aria-expanded='false' style='margin-left: 40px'>Keranjang Belanja</a>
                                <a href="{{ route('auth.logout') }}" style='margin-left: 40px'>Log Out</a>
                            @else
                                <a href="{{ route('auth.login') }}" role='button' aria-expanded='false' style='margin-left: 40px'>Login</a>
                            @endif
						</div>
						<div class="panel-body">
							<div class="tab-pane col-md-12">
								<div class="row">
									<form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label class="control-label">Nama</label>
                                            <input type="text" class="form-control" name="name" placeholder="Nama" value="{{ $user->name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $user->email }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Tanggal Lahir</label>
                                            <input id="tglLahir" type="date" class="form-control" name="birthdate" value="{{ $user->birthdate }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">No. Hp</label>
                                            <input type="text" class="form-control" name="phone_number" placeholder="No. Hp" value="{{ $user->phone_number }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Alamat</label>
                                            <input type="text" class="form-control" name="address" placeholder="Alamat" value="{{ $user->address }}" required>
                                        </div>
                                        <div class="form-group">
											<label class="control-label">Provinsi</label>
                                                <select class="form-control" id="province_id" name="province_id" required>
                                                    @if($user->province_id)
                                                        <option value="">-- Pilih Provinsi --</option>
                                                        @foreach($provinces as $province)
                                                        <option value="{{ $province['province_id'] }}" @if($user->province_id == $province['province_id']) selected @endif>
                                                            {{ $province['province'] }}
                                                        </option>
                                                        @endforeach
                                                    @else
                                                        <option value="">-- Pilih Provinsi --</option>
                                                        @foreach($provinces as $province)
                                                        <option value="{{ $province['province_id'] }}">
                                                            {{ $province['province'] }}
                                                        </option>
                                                        @endforeach
                                                    @endif
                                                </select>
										</div>
                                        <div class="form-group">
											<label class="control-label">Kota</label>
                                                <input id="city" type="hidden" class="form-control" name="city" value="0" readonly>
												<select class="form-control" id="city_id" name="city_id" required>
                                                    <option value="">-- Pilih Kota --</option>
                                                </select>
										</div>
                                        <br>
                                        <strong>Diisi jika ingin mengganti Password Anda</strong>
                                        <div class="form-group">
                                            <label class="control-label">Password Lama</label>
                                            <input type="password" class="form-control" name="password_1" placeholder="Password Lama">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Password Baru</label>
                                            <input type="password" class="form-control" name="password_2" placeholder="Password Baru">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Konfirmasi Password Baru</label>
                                            <input type="password" class="form-control" name="password_3" placeholder="Konfirmasi Password Baru">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info">Simpan</button>
                                        </div>
                                    </form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</nav>
	<div class="container-fluid">
	</div>
	<footer class="main-footer">
		<div class="container">
			<div class="widgets-section">
				<div class="row clearfix">
					<div class="big-column col-lg-6 col-md-12 col-sm-12">
						<div class="row clearfix">
							<div class="footer-column col-lg-12 col-md-12 col-sm-12">
								<div class="footer-widget about-widget">
									<h1 style="margin-bottom: 20px">
										Tentang Kami
									</h1>
									<div class="text">
										<p>{{ $company->about }}</p>
									</div>
								</div>
							</div>
							 <div class="footer-column col-lg-5 col-md-6 col-sm-12">
								<div class="footer-widget links-widget">
								</div>
							</div>

						</div>
					</div>
					<div class="big-column col-lg-6 col-md-12 col-sm-12">
						<div class="row clearfix">
							<div class="footer-column col-lg-6 col-md-6 col-sm-12">
								<div class="footer-widget gallery-widget">
								</div>
							</div>
							<div class="footer-column col-lg-6 col-md-6 col-sm-12">
								<div class="footer-widget info-widget">
									<h2>Kontak</h2>
									<ul class="info-list">
										<li>{{ $company->address }}</li>
										<li>{{ $company->phone_number }}</li>
										<li>{{ $company->email }}</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
    <script>
        $(document).ready(function(){
            $('select[name="province_id"]').on('change', function () {
                $('input[name="province"]').val($('#province_id option:selected').text());
                let token = $('meta[name="csrf-token"]').attr('content');
                let provinceId = $(this).val();
                if (provinceId) {
                    $.ajax({
                        url: 'user/cities/' + provinceId,
                        type: "GET",
                        header:{
                          'X-CSRF-TOKEN': token
                        },
                        dataType: "json",
                        success: function (response) {
                            $('select[name="city_id"]').empty();
                            $('select[name="city_id"]').append('<option value="">-- Pilih Kota --</option>');
                            $.each(response, function (key, value) {
                                $('select[name="city_id"]').append('<option value="' + value['city_id'] + '">' + value['city_name'] + '</option>');
                            });
                        },
                    });
                } else {
                    $('select[name="city_id"]').append('<option value="">-- Pilih Kota --</option>');
                }
            });
        });
    </script>
</body>
</html>
