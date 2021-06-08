<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Register</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-default" style="margin-top: 10em;">
					<div class="panel-heading">Register</div>
					<div class="panel-body" style="padding: 1em; overflow: hidden;">
						<form class="form-horizontal" method="POST" action="{{ route('cont.register') }}">
                            {{ csrf_field() }}
							<div class="form-group">
								<label class="col-md-4 control-label">Nama</label>
								<div class="col-md-6">
									<input id="name" type="text" class="form-control" name="name" placeholder="Nama" required autofocus>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Tanggal Lahir</label>
								<div class="col-md-6">
									<input id="birthdate" type="date" class="form-control" name="birthdate" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">No Hp</label>
								<div class="col-md-6">
									<input id="phone_number" type="text" class="form-control" name="phone_number" placeholder="No. Hp" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Email</label>
								<div class="col-md-6">
									<input id="email" type="text" class="form-control" name="email" placeholder="Email" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">Password</label>
								<div class="col-md-6">
									<input id="password" type="password" class="form-control" placeholder="Password" name="password" required>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6">
									<a href="{{ route('auth.login') }}" class="btn btn-primary-outline" style="width:100%;"><i class="fa fa-fw fa-chevron-left"></i>Kembali</a>
								</div>
								<div class="col-md-6">
									<button type="submit" class="btn btn-primary" style="width:100%;">
										Register
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
