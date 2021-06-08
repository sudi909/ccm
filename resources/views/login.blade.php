<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="main.css" />
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
					<div class="panel-heading">Login</div>
					<div class="panel-body" style="padding: 1em; overflow: hidden;">
						@if(session('message'))
                            <div class="alert alert-info alert-dismissable fade in">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-fw fa-close"></i></a>
                                {{ session('message') }}
                            </div>
						@endif
						<form class="form-horizontal" method="POST" action="{{ route('cont.login') }}">
                            {{ csrf_field() }}
							<div class="form-group">
								<label for="email" class="col-md-4 control-label">Email</label>
								<div class="col-md-6">
									<input id="email" type="text" class="form-control" name="email" placeholder="Email" required autofocus>
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="col-md-4 control-label">Password</label>
								<div class="col-md-6">
									<input id="password" type="password" class="form-control" placeholder="Password" name="password" required>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12" style="text-align: center; margin-top: 10px;">
									<button type="submit" class="btn btn-primary text-center" style="width:50%;">
										Login
									</button>
								</div>
								<div class="col-md-12" style="text-align: center; margin-top: 10px;">
									Belum memiliki akun ? <a href="{{ route('auth.register') }}" style="color: green;">Register</a>
								</div>
								<!-- <div class="col-md-6">
									<a href="register.php" class="btn btn-info-outline" style="width:100%;">Register</a>
								</div> -->
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
