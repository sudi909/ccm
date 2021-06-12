<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
				@if(session('message'))
                    <div class="alert alert-info alert-dismissable fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-fw fa-close"></i></a>
                        {{ session('message') }}
                    </div>
                @endif
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
                            <a href="{{ route('index') }}" style="margin-right: 20px">Home</a>
                            @if($user)
                                <a href="{{ route('transaction.index') }}" role='button' aria-expanded='false' style='margin-left: 40px'>{{ $user->name }}</a>
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
									<form class="form-horizontal">
										<div class="form-group">
											<label class="col-md-4 control-label">Kode Transaksi :</label>
											<div class="col-md-6">
												<input id="kodeTransaksi" type="text" class="form-control" name="kodeTransaksi" value="{{ $transaction->code }}" disabled>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Tanggal Transaksi :</label>
											<div class="col-md-6">
												<input id="tglTransaksi" type="text" class="form-control" name="tglTransaksi" value="{{ date_format(new DateTime($transaction->date), 'F j, Y') }}" disabled>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Grand Total :</label>
											<div class="col-md-6">
												<input id="grandTotal" type="text" class="form-control" name="grandTotal" value="{{ number_format($transaction->grand_total) }}" disabled>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Nama Penerima :</label>
											<div class="col-md-6">
												<input id="namaPenerima" type="text" class="form-control" name="namaPenerima" value="{{ $transaction->customer_name }}" disabled>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">No. Telephone :</label>
											<div class="col-md-6">
												<input id="telPenerima" type="text" class="form-control" name="telPenerima" value="{{ $transaction->phone_number }}" disabled>
											</div>
										</div>
									</form>
									<form class="form-horizontal" method="POST" action="{{ route('transaction.edit') }}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
										<input id="id" type="hidden" name="id" value="{{ $transaction->id }}">
										<div class="form-group">
											<label class="col-md-4 control-label">Upload Bukti :</label>
											<div class="col-md-6">
												<div class="input-group">
													<span class="input-group-btn">
														<span class="btn btn-default btn-file">
															Browse… <input type="file" id="imgInp" name="imgInp" accept="image/x-png,image/gif,image/jpeg"/>
														</span>
													</span>
													<input type="text" id="image" name="image" class="form-control" readonly/>
												</div>
											</div>
										</div>
                                        <div class="form-group">
                                            <div class="text-center">
												<img id="img-upload" name="img-upload"/>
											</div>
                                        </div>
										<div class="row  text-center" style="margin-top: 50px">
											<button type="submit" class="btn btn-primary">Konfirmasi</button>
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
								<div class="footer-widget about-widget" style="margin-left: -300px">
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
								<div class="footer-widget info-widget" style="margin-left: 300px">
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
			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$("#img-upload").css("width","300");
						$("#img-upload").css("height","300");
						$('#img-upload').attr('src', e.target.result);

					}

					reader.readAsDataURL(input.files[0]);
				}
			}

			$("#imgInp").change(function(){
				readURL(this);
			});
		});
	</script>
</body>
</html>
