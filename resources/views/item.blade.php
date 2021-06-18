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
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="margin-bottom: 30px">
                            <a href="{{ route('index') }}" style="margin-right: 20px">Home</a>
                            @if($user)
                                <a href="{{ route('user.index') }}" role='button' aria-expanded='false' style='margin-left: 40px'>{{ $user->name }}</a>
                                <a href="{{ route('transaction.index') }}" role='button' aria-expanded='false' style='margin-left: 40px'>Transaksi</a>
                                <a href="{{ route('cart.index') }}" role='button' aria-expanded='false' style='margin-left: 40px'>Keranjang Belanja</a>
                                <a href="{{ route('auth.logout') }}" style='margin-left: 40px'>Log Out</a>
                            @else
                                <a href="{{ route('auth.login') }}" role='button' aria-expanded='false' style='margin-left: 40px'>Login</a>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @if($item->image_1)
                                    <div class="item active">
                                        <img src="{{ asset('images/' . $item->image_1) }}" class="tales">
                                    </div>
                                    @endif
                                    @if($item->image_2)
                                    <div class="item">
                                        <img src="{{ asset('images/' . $item->image_2) }}" class="tales">
                                    </div>
                                    @endif
                                    @if($item->image_3)
                                    <div class="item">
                                        <img src="{{ asset('images/' . $item->image_3) }}" class="tales">
                                    </div>
                                    @endif
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
                                <div class="row text-center">
                                    <button type="submit" class="btn btn-primary">Tambah Keranjang</button>
                                </div>
                            </form>
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
</body>
</html>
