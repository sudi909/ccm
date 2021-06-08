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
							<div class="col-md-8">
								<a href="{{ route('index') }}" style="margin-right: 20px">HOME</a>
							</div>
							<div class="input-group">
								<input name="search" placeholder="Cari Barang" class="form-control" type="text" id="search">
								<span class="input-group-btn">
									<button class="btn btn-primary" type="button" id="SearchButton" name="SearchButton">
										<span class="fa fa-fw fa-search"></span>
									</button>
								</span>
							</div>
						</div>
						<div class="panel-heading">
							<ul class="nav nav-pills" id="kategori">
                                @foreach($categories as $category)
                                    <li id="{{ $category->id }}"><a data-toggle='pill'>{{ $category->name }}</a></li>
                                @endforeach
							</ul>
						</div>
						<div id="myCarousel" class="carousel slide" data-ride="carousel" style="width: 800px; margin: 0 auto" name="myCarousel">
							 <ol class="carousel-indicators">
								<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
								<li data-target="#myCarousel" data-slide-to="1"></li>
								<li data-target="#myCarousel" data-slide-to="2"></li>
							</ol>
							<div class="carousel-inner">

{{--									$sqlFoto = "SELECT * FROM tblBanner ORDER BY orderBy ASC";--}}
{{--									$queryFoto = mysqli_query($con, $sqlFoto);--}}

{{--									$i = 0;--}}

{{--									while ($rowFoto = mysqli_fetch_array($queryFoto)) {--}}
{{--										if ($i == 0) {--}}
{{--											echo '<div class="item active">--}}
                                            <div class="item active">
												<img src="{{ asset('images/slide-banner/1.jpg') }}" class="tales">
                                            </div>
                                            <div class="item">
                                                <img src="{{ asset('images/slide-banner/2.jpg') }}" class="tales">
                                            </div>
                                            <div class="item">
                                                <img src="{{ asset('images/slide-banner/3.jpg') }}" class="tales">
                                            </div>
{{--											</div>';--}}
{{--										} else {--}}
{{--											echo '<div class="item">--}}
{{--												<img src="asset/images/slide-banner' . $rowFoto['foto'] . '" class="tales">--}}
{{--											</div>';--}}
{{--										}--}}
{{--										$i++;--}}
{{--									}--}}

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
						<div class="panel-body">
							<div class="tab-pane">
								<div class="row">
									<div id="barang">
                                        @foreach($items as $item)
                                        <div class='col-xs-12 col-sm-4 col-md-2'>
                                            <div class='card center-block' style='height: 380px'>
                                                <a href={{ route('item.index', $item->id) }}>
                                                    <img class='lazyload' src="{{ asset($item->images->first()->path) }}" alt="{{ $item->name }}" style='height: 200px'/>
                                                    <div class='container-fluid'>
                                                        <h4>{{ $item->name }}</h4>
                                                        <p>Rp {{ number_format($item->price) }}</p>
                                                        <div class='panel-footer' style='position: absolute; bottom: 24px;'>
                                                            <form method='POST' action={{ route('cart.create') }}>
                                                                {{ csrf_field() }}
                                                                <input type='hidden' name='id' value="{{ $item->id }}">
                                                                <input type='hidden' name='quantity' value="1">
                                                                <button type='submit' class='btn btn-primary'><i class='fa fa-fw fa-plus'></i> Keranjang</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
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
										<p>Central Cahaya Matahari merupakan usaha dagang yang telah berdiri cukup lama sejak tanggal 22 Juli 1997. Central Cahaya Matahari adalah usaha dagang yang berorientasi local yang bergerak di bidang material bahan bangunan. Jenis kategori barang yang dijual di Central Cahaya Matahari ada beragam diantaranya, yaitu Semen, Besi, Seng Aluminium, Tripleks, serta material kecil lainnya. Produk yang disediakan juga terdiri dari berbagai merek dan kelas untuk memudahkan pelanggan dalam memilih barang berdasarkan kebutuhan.</p>
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
										<li>Jl. Imam Bonjol</li>
										<li>0812 3456 7891</li>
										<li>centralcahayamatahari@gmail.com</li>
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
// $(document).ready(function() {
// 	$("#SearchButton").on("click", function() {
// 		var search = $("#search").val();
// 		$("#myCarousel").empty();
// 		$("#item").empty();
// 		$("#kategori li.active").removeClass("active");
// 		$.post("php/ajaxBarang.php", { nama: search }, function(data){
// 			$("#item").append(data);
// 		});
// 	});
//
// 	$("#kategori li").on("click", function() {
// 		$("#myCarousel").empty();
// 		$("#item").empty()
// 		$.post("php/ajaxBarang.php", { idKategori: this.id }, function(data){
// 			$("#item").append(data);
// 		});
// 	});
// });
</script>
</body>
</html>
