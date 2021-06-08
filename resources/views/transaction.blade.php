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
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<a href="{{ route('index') }}" style="margin-right: 20px">HOME</a>
						</div>
						<div class="panel-body">
							<div class="tab-pane col-md-12">
								<div class="row">
									<table class="table table-hover table-responsive table-striped table-information">
										<thead>
											<tr>
												<th>No</th>
												<th>Kode Transaksi</th>
												<th>Tanggal Transaksi</th>
												<th>Alamat Penerima</th>
												<th>Status</th>
												<th>Grand Total</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
                                        @foreach($user->transactions as $key => $transaction)
                                            <tr>
												<td class="text-center" width="20px">{{ $key++ }}</td>
												<td class="text-center">{{ $transaction->code }}</td>
												<td class="text-center">{{ date_format(new DateTime($transaction->date), 'F j, Y') }}</td>
												<td class="text-center">{{ $transaction->address }}</td>
												<td class="text-center"><h4>
												@if($transaction->status == '1')
                                                    <span class="label label-default">Pesanan Pending</span>
                                                @elseif($transaction->status == '2')
                                                    <span class="label label-info">Pesanan sedang diproses</span>
                                                @else
                                                    <span class="label label-success">Pesanan selesai</span>
                                                @endif
                                                </td>
												<td class="text-center">Rp. {{ number_format($transaction->grand_total) }}
												</h4></td>
												<td class="text-center">
													@if($transaction->status == '1')
													    <a href="{{ route('transaction.proof', $transaction->id) }}" class="btn btn-primary btn-sm">Upload Bukti</a>
                                                    @endif
												</td>
											<tr>
                                        @endforeach
										</tbody>
									</table>
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
