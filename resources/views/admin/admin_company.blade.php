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
				<a href="{{ route('admin.index') }}">
					<img src="{{ asset('images/' . $company->logo_path) }}" width="160">
				</a>
			</div>
			<div class="panel-heading" style="margin-bottom: 30px">
                <a href="{{ route('admin.index') }}" style="margin-right: 20px">Home</a>
                @if($user)
                    <a href="{{ route('admin.item.index') }}" role='button' aria-expanded='false' style='margin-left: 40px'>Barang</a>
                    <a href="{{ route('admin.category.index') }}" role='button' aria-expanded='false' style='margin-left: 40px'>Kategori</a>
                    <a href="{{ route('admin.transaction.index') }}" role='button' aria-expanded='false' style='margin-left: 40px'>Transaksi</a>
                    <a href="{{ route('admin.user.index') }}" role='button' aria-expanded='false' style='margin-left: 40px'>User</a>
                    <a href="{{ route('admin.company.index') }}" role='button' aria-expanded='false' style='margin-left: 40px'>Perusahaan</a>
                    <a href="{{ route('auth.logout') }}" style='margin-left: 40px'>Log Out</a>
                @else
                    <a href="{{ route('auth.login') }}" role='button' aria-expanded='false' style='margin-left: 40px'>Login</a>
                @endif
            </div>
			<div class="container" style="margin-top: 20px">
				<div class="row">
					<ol class="breadcrumb">
						<li>
							<a href="{{ route('admin.index') }}">Home</a>
						</li>
						<li class="active">
							Perusahaan
						</li>
					</ol>
					@if(session('message'))
                        <div class="alert alert-info alert-dismissable fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-fw fa-close"></i></a>
                            {{ session('message') }}
                        </div>
                    @endif
					<div class="panel panel-default">
						<div class="panel-heading">
							Perusahaan
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-8 col-md-offset-2">
									<h3>Edit Data</h3>
									<span class="hrdivider"></span>
									<div class="panel panel-default">
										<div class="panel-body">
											<form action="{{ route('admin.company.update') }}" method="post" enctype="multipart/form-data">
                                                {{ csrf_field() }}
												<input type="hidden" name="id" value="{{ $company->id }}">
												<div class="form-group">
													<label class="control-label">Nama Perusahaan</label>
													<input type="text" class="form-control" name="company_name" value="{{ $company->company_name }}" placeholder="Nama Perusahaan" required>
												</div>
                                                <div class="form-group">
													<label class="control-label">Email Perusahaan</label>
													<input type="text" class="form-control" name="email" value="{{ $company->email }}" placeholder="Email" required>
												</div>
												<div class="form-group">
													<label class="control-label">Nomor Telepon</label>
													<input type="text" class="form-control" name="phone_number" value="{{ $company->phone_number }}" placeholder="Nomor Telepon" required>
												</div>
                                                <div class="form-group">
													<label class="control-label">Alamat Perusahaan</label>
													<input type="text" class="form-control" name="address" value="{{ $company->address }}" placeholder="Alamat" required>
												</div>
                                                <div class="form-group">
													<label class="control-label">Provinsi</label>
													<select class="form-control" id="province_id" name="province_id" required>
                                                    @if($company->province_id)
                                                        <option value="">-- Pilih Provinsi --</option>
                                                        @foreach($provinces as $province)
                                                        <option value="{{ $province['province_id'] }}" @if($company->province_id == $province['province_id']) selected @endif>
                                                            {{ $province['province'] }}
                                                        </option>
                                                        @endforeach
                                                    @else
                                                        <option value="" selected>-- Pilih Provinsi --</option>
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
													<select class="form-control" id="city_id" name="city_id" required>
                                                        <option value="">-- Pilih Kota --</option>
                                                    </select>
												</div>
                                                <div class="form-group">
													<label class="control-label">Tentang</label>
													<textarea class="form-control" rows="3" id="about" name="about" placeholder="Tentang" required>{{ $company->about }}</textarea>
												</div>
												<div class="form-group">
													<label class="control-label">Upload Logo :</label>
													<br>Dihiraukan jika tidak ada perubahan<br>
													<div class="input-group">
														<span class="input-group-btn">
															<span class="btn btn-default btn-file">
																Browse… <input type="file" id="logo_path" name="logo_path" accept="image/x-png,image/gif,image/jpeg"/>
															</span>
														</span>
														<input type="text" id="image" name="image" class="form-control" readonly/>
													</div>
												</div>
												<div class="form-group">
													<button type="submit" class="btn btn-info">Simpan</button>
													<a href="barang.php" class="btn btn-default">Kembali</a>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</nav>
	<footer class="footer">
        <div class="container-fluid text-center">
            <p class="copyright">
                &copy; 2021 Central Cahaya Matahari
            </p>
        </div>
	</footer>
    <script>
		$(document).ready( function() {
			$(document).on('change', '.btn-file :file', function() {
			var input = $(this),
				label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [label]);
			});

			$('.btn-file :file').on('fileselect', function(event, label) {

				var input = $(this).parents('.input-group').find(':text'),
					log = label;

				if( input.length ) {
					input.val(log);
				} else {
					if( log ) alert(log);
				}

			});

			$('select[name="province_id"]').on('change', function () {
                var token = $('meta[name="csrf-token"]').attr('content');
                let provinceId = $(this).val();
                if (provinceId) {
                    $.ajax({
                        url: 'company/cities/'+provinceId,
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
