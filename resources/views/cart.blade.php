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
							<a href="{{ route('index') }}" style="margin-right: 20px">HOME</a>
						</div>
						<div class="panel-body">
							<div class="tab-pane col-md-12">
								<div class="row">
									<table class="table table-hover table-bordered table-responsive table-striped table-information">
										<thead>
											<tr>
												<th>No</th>
												<th>Nama Barang</th>
												<th>Harga Barang</th>
                                                <th>Berat Barang</th>
												<th>Kuantitas</th>
												<th>Total</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
                                        @foreach( $user->cart as $key => $cart )
                                            <tr>
												<td class="text-center" width="20px">{{ ++$key }}</td>
												<td class="text-center">{{ $cart->item->name }}</td>
												<td class="text-center">{{ $cart->item->price }}</td>
                                                <td class="text-center">{{ $cart->item->weight }}</td>
												<form action={{ route('cart.update') }} method="post">
													<td class="text-center" width="30px">
														<input class="form-control" type="number" name="quantity" value="{{  number_format($cart->quantity) }}">
													</td>
													<td class="text-center">{{ number_format($cart->item->price * $cart->quantity) }}</td>
													<td class="text-center">
														<input type="hidden" name="id" value="{{ $cart->item->id }}">
														<button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-faw fa-save"></i></button>
														<a href="{{ route('cart.destroy', $cart->item->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></a>
													</td>
												</form>
                                            <tr>
                                        @endforeach
										</tbody>
									</table>
									<div class="row  text-center" style="margin-top: 50px; margin-bottom: 50px">
										<a href="{{ route('checkout.index') }}" class="btn btn-primary">Checkout</a>
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
