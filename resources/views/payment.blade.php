<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>UD BAJA MAS</title>
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
			<div class="collapse navbar-collapse" id="app-navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
                    @if($user)
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style='margin-top: 15px'><b>{{ $user->name }}<i class="fa fa-fw fa-caret-down"></i></b></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="profile.php"><b><i class="fa fa-fw fa-user"></i>Profil</b></a></li>
                                <li><a href="{{ route('transaction.index') }}"><b><i class="fa fa-fw fa-first-order"></i>Transaksi</b></a></li>
                            </ul>
                        </li>
                        <li>
						<a href='cart.php' role='button' aria-expanded='false' style='margin-top: 15px'><b>Keranjang Belanja</b></a>
                        </li>
                        <li><a href="{{ route('auth.logout') }}" style='margin-top: 15px'><b>Log Out</b></a></li>
                    @else
                        <li>
                        <a href="{{ route('auth.login') }}" role='button' aria-expanded='false' style='margin-top: 12px'><b>Login</b></a>
                        </li>
                    @endif

				</ul>
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
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style='margin-left: 40px'><b>{{ $user->name }}<i class="fa fa-fw fa-caret-down"></i></b></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="profile.php"><b><i class="fa fa-fw fa-user"></i>Profil</b></a></li>
                                    <li><a href="{{ route('transaction.index') }}"><b><i class="fa fa-fw fa-first-order"></i>Transaksi</b></a></li>
                                </ul>
                                <a href="{{ route('cart.index') }}" role='button' aria-expanded='false' style='margin-left: 40px'><b>Keranjang Belanja</b></a>
                                <a href="{{ route('auth.logout') }}" style='margin-left: 40px'><b>Log Out</b></a>
                            @else
                                <a href="{{ route('auth.login') }}" role='button' aria-expanded='false' style='margin-left: 40px'><b>Login</b></a>
                            @endif
						</div>
						<div class="panel-body">
							<div class="tab-pane col-md-12">
								<div class="row">
									<div class="text-center">
										<p>SILAHKAN LAKUKAN PEMBAYARAN KE NO. REK</p>
										<p>BCA</p>
										<p>123456789</p>
										<p>LAMPIRKAN BUKTI PEMBAYARAN DIMENU ORDER</p>
										<p>KLIK NAMA (diatas kanan/sebelah keranjang belanja) > ORDER</p>
									</div>
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
</body>
</html>
