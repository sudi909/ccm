<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Central Cahaya Matahari</title>
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
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ route('index') }}">
					<img src={{ asset('images/logo.png') }} width="100" height="30">
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
						<a href="{{ route('cart.index') }}" role='button' aria-expanded='false' style='margin-top: 15px'><b>Keranjang Belanja</b></a>
                        </li>
                        <li><a href="{{ route('auth.logout') }}" style='margin-top: 15px'><b>Log Out</b></a></li>
                    @else
                        <li>
                        <a href="{{ route('auth.login') }}" role='button' aria-expanded='false' style='margin-top: 12px'><b>Login</b></a>
                        </li>
                    @endif

				</ul>
			</div>
			<div class="container-fluid">
				<div class="row" style="margin-top: 20px">
					<div class="col-md-12">
						<ol class="breadcrumb">
							<li>
								<a class="defaulta">{{ $item->name }}</a>
							</li>
						</ol>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						</div>
						<div class="col-md-4">
							<div id="myCarousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
                                @foreach( $item->images as $key => $image )
                                    @if($key == 0)
                                        <div class="item active">
                                            <img src="{{ asset($image->path) }}" class="tales">
                                        </div>
                                    @else
                                        <div class="item">
                                            <img src="{{ asset($image->path) }}" class="tales">
                                        </div>
                                    @endif
                                    <a href="#tab_c{{$key++}}" role="tab" data-toggle="tab"></a>
                                @endforeach
							</div>
							<a class="left carousel-control" href="#myCarousel" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="#myCarousel" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
						</div>
						<div class="col-md-8" style="font-size: 15px">
							<div class="row">
								<div class="col-md-3"><h4>Harga</h4></div>
								<div class="col-md-1"><h4>:</h4></div>
								<div class="col-md-8"><h4>{{ number_format($item->price) }}</h4></div>
							</div>
							<div class="row">
								<div class="col-md-3"><h4>Berat</h4></div>
								<div class="col-md-1"><h4>:</h4></div>
								<div class="col-md-8"><h4>{{ $item->weight }} gram</h4></div>
							</div>
							<div class="row">
								<h4 class="col-md-3">Deskripsi</h4>
								<div class="col-md-1"><h4>:</h4></div>
								<div class="col-md-8"><h4>
									<div style="min-height: 150px; overflow: auto;">
										<p>{{ $item->description }}</p>
									</div>
                                    </h4>
                                </div>
							</div>
                            <div class="row">
								<h4 class="col-md-3">Stock</h4>
								<div class="col-md-1"><h4>:</h4></div>
								<div class="col-md-8"><h4>{{ $item->stock }}</h4></div>
							</div>
							<form action={{ route('cart.create') }} method="post">
                                {{ csrf_field() }}
								<input type="hidden" name="id" value="{{ $item->id }}">
								<div class="row">
									<div class="col-md-3"><h4>Kuantitas</h4></div>
									<div class="col-md-1"><h4>:</h4></div>
									<div class="col-md-3"><h4><input type="number" name="quantity" class="form-control" value="1"></h4></div>
								</div>
								<div class="row  text-center" style="margin-top: 50px">
									<button type="submit" class="btn btn-primary">Tambah Keranjang</button>
								</div>
							</form>
						</div>
					</div>
				</div>
            <div style="margin-top: 150px">
            </div>
{{--				<div class="well well-kembali" onclick="window.history.back();">--}}
{{--					<div class="text-center"><h4><i class="fa fa-fw fa-chevron-left"></i>Kembali</h4></div>--}}
{{--				</div>--}}
			</div>
		</div>
	</nav>
	<div class="container-fluid">
	</div>
	<footer class="main-footer">
		<div class="container">
			<!--Widgets Section-->
			<div class="widgets-section">
				<div class="row clearfix">

					<!--Column-->
					<div class="big-column col-lg-6 col-md-12 col-sm-12">
						<div class="row clearfix">

							<!--Footer Column-->
							<div class="footer-column col-lg-12 col-md-12 col-sm-12">
								<div class="footer-widget about-widget">
									<h1 style="margin-bottom: 20px">
										Tentang Kami
									</h1>
									<div class="text">
										<p>UD. Baja Mas merupakan usaha dagang yang telah berdiri cukup lama sejak tanggal 22 Juli 1997. UD. Baja Mas adalah usaha dagang yang berorientasi local yang bergerak di bidang material bahan bangunan. Jenis kategori barang yang dijual di UD. Baja Mas ada beragam diantaranya, yaitu Semen, Besi, Seng Aluminium, Tripleks, serta material kecil lainnya. Produk yang disediakan juga terdiri dari berbagai merek dan kelas untuk memudahkan pelanggan dalam memilih barang berdasarkan kebutuhan.</p>
									</div>
								</div>
							</div>

							<!--Footer Column-->
							<!-- <div class="footer-column col-lg-5 col-md-6 col-sm-12">
								<div class="footer-widget links-widget">
								</div>
							</div> -->

						</div>
					</div>

					 <!--Column-->
					<div class="big-column col-lg-6 col-md-12 col-sm-12">
						<div class="row clearfix">

							<!--Footer Column-->
							<div class="footer-column col-lg-6 col-md-6 col-sm-12">
								<div class="footer-widget gallery-widget">
								</div>
							</div>

							<!--Footer Column-->
							<div class="footer-column col-lg-6 col-md-6 col-sm-12">
								<div class="footer-widget info-widget">
									<h2>Kontak</h2>
									<ul class="info-list">
										<li>Jl. Imam Bonjol</li>
										<li>0812 3456 7891</li>
										<li>bajamas@gmail.com</li>
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
