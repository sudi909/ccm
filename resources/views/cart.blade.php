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
												<td class="text-center">{{ number_format($cart->item->price) }}</td>
                                                <td class="text-center">{{ $cart->item->weight }}</td>
												<form action={{ route('cart.update') }} method="post">
                                                    {{ csrf_field() }}
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
