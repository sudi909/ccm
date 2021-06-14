<!DOCTYPE html>
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
                                <a href="{{ route('transaction.index') }}" role='button' aria-expanded='false' style='margin-left: 40px'>{{ $user->name }}</a>
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
									<table class="table table-hover table-responsive table-striped table-information">
										<thead>
											<tr>
												<th>No</th>
												<th>Nama Barang</th>
												<th>Harga Barang</th>
                                                <th>Berat Barang</th>
												<th>Kuantitas</th>
												<th>Total</th>
											</tr>
										</thead>
										<tbody>
                                        @php
                                        $price = 0;
                                        $weight = 0;
                                        $totalWeight = 0;
                                        $shipping = 0;
                                        $total = 0;
                                        $grandTotal = 0;
                                        $i = 1;
                                        foreach ($user->cart as $item) {
                                            $price = number_format($item->item->price);
                                            $weight = number_format($item->item->weight);
                                            $quantity = number_format($item->quantity);
                                            $totalWeight = $totalWeight + ($item->quantity * $item->item->weight);
                                            $shipping = (($item->item->weight / 1000) * $item->quantity)  * 10000;
                                            $total = $item->item->price * $item->quantity;
                                            $grandTotal = $grandTotal + $total;
                                            echo "<tr>
                                                    <td class='text-center' width='20px'>$i</td>
                                                    <td class='text-center'>" . $item->item->name . "</td>
                                                    <td class='text-center'>$price</td>
                                                    <td class='text-center'>$weight</td>
                                                    <td class='text-center'>$quantity</td>
                                                    <td class='text-center'>Rp. " . number_format($total) . "</td>
                                                <tr>";
                                            $i++;
                                        }
                                        if ($shipping <= 10000) {
                                            $totalShipping = 10000;
                                        } else {
                                            $totalShipping = ceil($shipping / 10000) * 10000;
                                        }
                                        echo "
											<input id='weight' type='hidden' name='weight' value=" . $totalWeight . ">
											<input id='grandTotal' type='hidden' name='grandTotal' value=" . $grandTotal . ">
											<tr>
												<td class='text-left' colspan='5'>Total Harga</td>
												<td class='text-center'>Rp. " . number_format($grandTotal) . "</td>
											<tr>"
                                        @endphp
										</tbody>
									</table>
									<form class="form-horizontal" method="POST" action="{{ route('transaction.create') }}">
                                        {{ csrf_field() }}
										<input id="total_price" type="hidden" name="total_price" value="{{ $grandTotal }}">
										<div class="form-group">
											<label class="col-md-4 control-label">Nama Penerima :</label>
											<div class="col-md-6">
												<input id="name" type="text" class="form-control" name="name" placeholder="Nama Penerima" value="{{ $user->name }}" required>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">No. Telephone :</label>
											<div class="col-md-6">
												<input id="phone_number" type="text" class="form-control" name="phone_number" placeholder="No. Telephone" value="{{ $user->phone_number }}" required>
											</div>
										</div>
                                        <div class="form-group">
											<label class="col-md-4 control-label">Provinsi</label>
											<div class="col-md-6">
                                                <input id="province" type="hidden" class="form-control" name="province" value="0" readonly>
                                                <select class="form-control" id="province_id" name="province_id" required>
                                                    @if($user->province_id)
                                                        <option value="">-- Pilih Provinsi --</option>
                                                        @foreach($provinces as $province)
                                                        <option value="{{ $province['province_id'] }}" @if($user->province_id == $province['province_id']) selected @endif>
                                                            {{ $province['province'] }}
                                                        </option>
                                                        @endforeach
                                                    @else
                                                        <option value="">-- Pilih Provinsi --</option>
                                                        @foreach($provinces as $province)
                                                        <option value="{{ $province['province_id'] }}">
                                                            {{ $province['province'] }}
                                                        </option>
                                                        @endforeach
                                                    @endif
                                                </select>
											</div>
										</div>
                                        <div class="form-group">
											<label class="col-md-4 control-label">Kota</label>
											<div class="col-md-6">
                                                <input id="city" type="hidden" class="form-control" name="city" value="0" readonly>
												<select class="form-control" id="city_id" name="city_id" required>
                                                    <option value="">-- Pilih Kota --</option>
                                                </select>
											</div>
										</div>
                                        <div class="form-group">
											<label class="col-md-4 control-label">Ongkir</label>
											<div class="col-md-6">
                                                <input id="shipping" type="hidden" class="form-control" name="shipping" value="0" readonly>
												<select class="form-control" id="shipping_id" name="shipping_id" required>
                                                    <option value="">-- Pilih Ongkir --</option>
                                                </select>
											</div>
										</div>
                                        <div class="form-group">
											<label class="col-md-4 control-label">Biaya Ongkir</label>
											<div class="col-md-6">
												<input id="shipping_price" type="hidden" class="form-control" name="shipping_price" value="0" readonly>
                                                <input id="shipping_value" type="text" class="form-control" name="shipping_value" value="0" readonly>
											</div>
										</div>
                                        <div class="form-group">
											<label class="col-md-4 control-label">Grand Total</label>
											<div class="col-md-6">
                                                <input id="grand_total" type="hidden" class="form-control" name="grand_total" value="0" readonly>
												<input id="grand_total_value" type="text" class="form-control" name="grand_total_value" value="0" readonly>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Alamat :</label>
											<div class="col-md-6">
												<textarea class="form-control" rows="3" id="address" name="address" placeholder="Alamat" required autofocus>{{ $user->address }}</textarea>
											</div>
										</div>
									<div class="row text-center" style="margin-top: 50px">
										<button type="submit" class="btn btn-primary">Konfirmasi</button>
									</div>
									</form>
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
        $(document).ready(function(){
            $('select[name="province_id"]').on('change', function () {
                $('input[name="province"]').val($('#province_id option:selected').text());
                let token = $('meta[name="csrf-token"]').attr('content');
                let provinceId = $(this).val();
                if (provinceId) {
                    $.ajax({
                        url: 'cart/cities/' + provinceId,
                        type: "GET",
                        header:{
                          'X-CSRF-TOKEN': token
                        },
                        dataType: "json",
                        success: function (response) {
                            $('select[name="city_id"]').empty();
                            $('select[name="city_id"]').append('<option value="">-- Pilih Kota --</option>');
                            $.each(response, function (key, value) {
                                $('select[name="city_id"]').append('<option value="' + value['city_id'] + '">' + value['city_name'] + '</option>');
                            });
                        },
                    });
                } else {
                    $('select[name="city_id"]').append('<option value="">-- Pilih Kota --</option>');
                }
            });

            $('select[name="city_id"]').on('change', function () {
                $('input[name="city"]').val($('#city_id option:selected').text());
                let token = $('meta[name="csrf-token"]').attr('content');
                let city_id = $(this).val();
                let weight = $('input[name="weight"]').val();
                if (city_id) {
                    $.ajax({
                        url: 'cart/shipping/' + city_id + '/' + weight,
                        type: "GET",
                        header:{
                          'X-CSRF-TOKEN': token
                        },
                        dataType: "json",
                        success: function (response) {
                            $('select[name="shipping_id"]').empty();
                            $('select[name="shipping_id"]').append('<option value="">-- Pilih Ongkir --</option>');
                            $.each(response[0]['costs'], function (key, value) {
                                $('select[name="shipping_id"]').append('<option value="' + value['cost'][0]['value'] + '">' + value['service'] + '</option>');
                            });
                        },
                    });
                } else {
                    $('select[name="city_id"]').append('<option value="">-- Pilih Ongkir --</option>');
                }
            });

            $('select[name="shipping_id"]').on('change', function () {
                $('input[name="shipping"]').val($('#shipping_id option:selected').text());
                let cost = $(this).val();
                let total = $('input[name="total_price"]').val();
                $('input[name="shipping_price"]').val(cost);
                $('input[name="shipping_value"]').val(addCommas(cost));
                $('input[name="grand_total"]').val(parseInt(cost)+parseInt(total));
                $('input[name="grand_total_value"]').val(addCommas(parseInt(cost)+parseInt(total)));
            });

            function addCommas(nStr) {
                nStr += '';
                x = nStr.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }
        });
    </script>
</body>
</html>
