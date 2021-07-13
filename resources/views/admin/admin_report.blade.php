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
				<a href="{{ route('admin.index') }}">
					<img src="{{ asset('images/' . $company->logo_path) }}" width="160">
				</a>
			</div>
			<div class="panel-heading" style="margin-bottom: 30px">
                <a href="{{ route('admin.index') }}" style="margin-right: 20px">Home</a>
                <a href="{{ route('about') }}" role='button' aria-expanded='false' style='margin-left: 40px'>Tentang</a>
                @if($user)
                    <a href="{{ route('admin.profile.index') }}" role='button' aria-expanded='false' style='margin-left: 40px'>{{ $user->name }}</a>
                    <a href="{{ route('admin.item.index') }}" role='button' aria-expanded='false' style='margin-left: 40px'>Barang</a>
                    <a href="{{ route('admin.category.index') }}" role='button' aria-expanded='false' style='margin-left: 40px'>Kategori</a>
                    <a href="{{ route('admin.transaction.index') }}" role='button' aria-expanded='false' style='margin-left: 40px'>Transaksi</a>
                    <a href="{{ route('admin.user.index') }}" role='button' aria-expanded='false' style='margin-left: 40px'>User</a>
                    <a href="{{ route('admin.company.index') }}" role='button' aria-expanded='false' style='margin-left: 40px'>Perusahaan</a>
                    <a href="{{ route('auth.logout') }}" style='margin-left: 40px'>Log Out</a>
                @else
                    <a href="{{ route('auth.login') }}" role='button' aria-expanded='false' style='margin-left: 40px'>Login</a>
                @endif
            </div>
			<div class="container" style="margin-top: 20px">
				<div class="row">
					<ol class="breadcrumb">
						<li>
							<a href="{{ route('admin.index') }}">Home</a>
						</li>
						<li class="active">
							<a href="{{ route('admin.transaction.index') }}">Transaksi</a>
						</li>
                        <li class="active">
							Laporan
						</li>
					</ol>
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="text-left col-md-6">
								Transaksi
							</div>
							<div class="text-right">
								<form class="form-horizontal" method="POST" action="{{ route('admin.transaction.export') }}">
                                    {{ csrf_field() }}
									<input type="hidden" name="firstDate" value="{{ $firstDate }}">
									<input type="hidden" name="lastDate" value="{{ $lastDate }}">
									<input type="hidden" name="status" value="{{ $status }}">
									<button type="submit" class="btn btn-info">Export</button>
								</form>
							</div>
						</div>
						<div class="panel-body">
							<table class="table table-hover table-bordered table-condensed table-responsive table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Transaksi</th>
										<th>Tanggal Transaksi</th>
										<th>Nama Penerima</th>
										<th>Tel. Penerima</th>
										<th>Status</th>
                                        <th>Total Harga</th>
                                        <th>Ongkir</th>
										<th>Grand Total</th>
									</tr>
								</thead>
								<tbody>
									@php($grandTotal = 0)
                                    @foreach($transactions as $key => $transaction)
                                        @php($grandTotal = $grandTotal + $transaction->grand_total)
                                        <tr>
                                            <td class="text-center" width="20px">{{ ++$key }}</td>
                                            <td class="text-center">{{ $transaction->code }}</td>
                                            <td class="text-center">{{ $transaction->date }}</td>
                                            <td class="text-center">{{ $transaction->customer_name }}</td>
                                            <td class="text-center">{{ $transaction->phone_number }}</td>
                                            @if($transaction->status == 1)
                                                <td class="text-center">Pending</td>
                                            @elseif($transaction->status == 2)
                                                <td class="text-center">Proses</td>
                                            @else
                                                <td class="text-center">Selesai</td>
                                            @endif
                                            <td class="text-center">Rp. {{ number_format($transaction->total_price) }}</td>
                                            <td class="text-center">Rp. {{ number_format($transaction->shipping_price) }}</td>
                                            <td class="text-center">Rp. {{ number_format($transaction->grand_total) }}</td>
                                        </tr>
                                    @endforeach
									<tr>
										<td colspan="6">Total Keseluruhan</td>
										<td class="text-center">Rp. {{ number_format($grandTotal) }}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</nav>
	<footer class="footer">
        <div class="container-fluid text-center">
            <p class="copyright">
                &copy; 2021 Central Cahaya Matahari
            </p>
        </div>
	</footer>
</body>
</html>
