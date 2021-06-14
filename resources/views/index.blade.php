<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    .center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 100%;
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
                @if(session('message'))
                    <div class="alert alert-info alert-dismissable fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-fw fa-close"></i></a>
                        {{ session('message') }}
                    </div>
                @endif
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
                            <div class="col-md-4">
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
                            <div class="col-md-4">
                                <select class="form-control" id="category_id" name="category_id" required>
                                    <option value="" selected>-- Kategori Barang --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
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
                        <div id="myCarousel" class="carousel slide" data-ride="carousel" style="width: 800px; height: 400px; margin: 0 auto">
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img src="{{ asset('images/slide-banner/banner_1.jpg') }}" alt="Los Angeles" class="center">
                                </div>
                                <div class="item">
                                    <img src="{{ asset('images/slide-banner/banner_2.png') }}" alt="Chicago" class="center">
                                </div>
                                <div class="item">
                                    <img src="{{ asset('images/slide-banner/banner_3.jpeg') }}" alt="New York" class="center">
                                </div>
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
									<div id="item">
                                        @foreach($items as $item)
                                        <div class="col-xs-12 col-sm-4 col-md-2">
                                            <div class="card center-block">
                                                <a href={{ route('item.index', $item->id) }}>
                                                    <img class="lazyload" src="{{ asset("images/".$item->image_1) }}" alt="{{ $item->name }}" style="height: 200px"/>
                                                    <div class="container-fluid">
                                                        <h4>{{ $item->name }}</h4>
                                                        <p>Rp {{ number_format($item->price) }}</p>
                                                        <div class="text-center">
                                                            <form method="POST" action={{ route("cart.create") }}>
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                                <input type="hidden" name="quantity" value="1">
                                                                <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i>Keranjang</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
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
$(document).ready(function() {
	$("#SearchButton").on("click", function() {
	    let token = $('meta[name="csrf-token"]').attr('content');
        let search = $("#search").val();
        if (search) {
            $.ajax({
                url: 'search/' + search,
                type: "GET",
                header:{
                  'X-CSRF-TOKEN': token
                },
                dataType: "json",
                success: function (response) {
                    $('#item').empty();
                    $.each(response, function (key, value) {
                        $('select[name="category_id"]').val('');
                        $('#item').append('<div class="col-xs-12 col-sm-4 col-md-2"> <div class="card center-block"> <a href={{ route('item.index', $item->id) }}> <img class="lazyload" src="{{ asset("images/".$item->image_1) }}" alt="{{ $item->name }}" style="height: 200px"/> <div class="container-fluid"> <h4>{{ $item->name }}</h4> <p>Rp {{ number_format($item->price) }}</p> <div class="text-center"> <form method="POST" action={{ route("cart.create") }}>{{ csrf_field() }}<input type="hidden" name="id" value="{{ $item->id }}"> <input type="hidden" name="quantity" value="1"> <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i>Keranjang</button> </form> </div> </div> </a> </div> </div>');
                    });
                },
            });
        } else {
            location.reload();
        }
	});

	$('select[name="category_id"]').on('change', function () {
        let token = $('meta[name="csrf-token"]').attr('content');
        let category_id = $(this).val();
        if (category_id) {
            $.ajax({
                url: 'category/' + category_id,
                type: "GET",
                header:{
                  'X-CSRF-TOKEN': token
                },
                dataType: "json",
                success: function (response) {
                    $('#item').empty();
                    $.each(response, function (key, value) {
                        $('#item').append('<div class="col-xs-12 col-sm-4 col-md-2"> <div class="card center-block"> <a href={{ route('item.index', $item->id) }}> <img class="lazyload" src="{{ asset("images/".$item->image_1) }}" alt="{{ $item->name }}" style="height: 200px"/> <div class="container-fluid"> <h4>{{ $item->name }}</h4> <p>Rp {{ number_format($item->price) }}</p> <div class="text-center"> <form method="POST" action={{ route("cart.create") }}>{{ csrf_field() }}<input type="hidden" name="id" value="{{ $item->id }}"> <input type="hidden" name="quantity" value="1"> <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i>Keranjang</button> </form> </div> </div> </a> </div> </div>');
                    });
                },
            });
        } else {
            location.reload();
        }
    });
});
</script>
</body>
</html>
