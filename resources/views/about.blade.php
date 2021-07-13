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
<style>
pre, strong {
    font-family: Consolas, Menlo, Monaco, Lucida Console, Liberation Mono, DejaVu Sans Mono, Bitstream Vera Sans Mono, Courier New, monospace, serif;
    font-size: 24px;
}
</style>
<body>
	<nav class="navbar navbar-default navbar-static-top navbar-menu">
		<div class="container-fluid">
			<div class="text-center">
				<a href="{{ route('index') }}">
					<img src="{{ asset('images/' . $company->logo_path) }}" width="160">
				</a>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
                            <a href="{{ route('index') }}" style="margin-right: 20px">Home</a>
                            <a href="{{ route('about') }}" role='button' aria-expanded='false' style='margin-left: 40px'>Tentang</a>
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
                                    <div class="text-center">
                                        <strong>Tentang Central Cahaya Matahari</strong>
                                    </div>
                                    <pre>
Central Cahaya Matahari merupakan toko yang bergerak dibidang penjualan pelengkapan rumah dan alat tukang yang masih perlu
adanya perluasan wilayah dalam penjualan dan pemasaran produk yang disediakan baik untuk pelanggan di wilayah batam maupun
diluar batam. Central Cahaya Matahari merupakan usaha dagang yang telah berdiri cukup lama sejak tanggal 22 Juli 1997. Central
Cahaya Matahari adalah usaha dagang yang berorientasi local yang bergerak dibidang material bahan bangunan. Jenis kategori
barang yang dijual di Central Cahaya Matahari ada beragam diantaranya, yaitu Semen, Besi, Seng Aluminium, Tripleks, serta
material kecil lainnya. Produk yang disediakan juga terdiri dari berbagai merek dan kelas untuk memudahkan pelanggan dalam
memilih barang berdasarkan kebutuhan. Pada Toko Central Cahaya Matahari adalah pelanggan harus secara langsung ke toko untuk
melihat dan ditawarkan langsung oleh toko sehingga pelanggan diluar batam akan susah mendapatkan informasi. Dengan membangun
sistem informasi penjualan berbasis web pada Toko Central Cahaya Matahari maka dapat membantu toko dan pelanggan dalam
melakukan transaksi jual beli, juga membantu pelanggan mendapatkan informasi produk dan dapat membantu toko mempromosikan
produk melalui internet.
                                    </pre>
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
</script>
</body>
</html>
