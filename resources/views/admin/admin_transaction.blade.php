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
                @if($user)
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
							<a href="home.php">Home</a>
						</li>
						<li class="active">
							Transaksi
						</li>
					</ol>
					@if(session('message'))
                        <div class="alert alert-info alert-dismissable fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-fw fa-close"></i></a>
                            {{ session('message') }}
                        </div>
                    @endif
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="text-left col-md-6">
								Transaksi
							</div>
							<div class="text-right">
								<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Laporan</button>
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
										<th>Grand Total</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									@foreach($transactions as $key => $transaction)
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
										<td class="text-center">Rp. {{ number_format($transaction->grand_total) }}</td>
										<td class="text-center">
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalUpdateTransaction{{ $transaction->id }}">Update</button>
                                            <div class="modal fade" id="modalUpdateTransaction{{ $transaction->id }}" tabindex="-1"  data-backdrop="false" aria-labelledby="modalUpdateTransaction" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            Detail Transaksi
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div>
                                                                <label class="lbel">Kode Transaksi : {{ $transaction->code }}</label>
                                                                <label class="lbel">Nama Penerima : {{ $transaction->name }}</label>
                                                                @if($transaction->status == 1)
                                                                    <label class="lbel">Status Transaksi : Pending</label>
                                                                @elseif($transaction->status == 2)
                                                                    <label class="lbel">Status Transaksi : Proses</label>
                                                                @else
                                                                    <label class="lbel">Status Transaksi : Selesai</label>
                                                                @endif

                                                            </div>
                                                            <div>
                                                                <label class="lbel">Tanggal Transaksi : {{ $transaction->date }}</label>
                                                                <label class="lbel">Alamat Penerima : {{ $transaction->address }}</label>
                                                                <label class="lbel">Tanggal Pembayaran : {{ $transaction->payment_date }}</label>
                                                            </div>
                                                            <div>
                                                                <label class="lbel">Nama Penerima : {{ $transaction->customer_name }}</label>
                                                                <label class="lbel">Tel. Penerima : {{ $transaction->phone_number }}</label>
                                                            </div>
                                                            <div class="text-center">
                                                                <img style="width: 250px; height: 250px" class="lazyload img-fluid"
                                                                     src="{{ asset('images/' . $transaction->payment_path) }}" />
                                                            </div>
                                                            <table class="table table-hover table-bordered table-condensed table-responsive table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Nama Barang</th>
                                                                        <th>Kuantitas Barang</th>
                                                                        <th>Harga Barang</th>
                                                                        <th>Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                    $grandTotal = 0;
                                                                    @endphp
                                                                    @foreach($transaction->details as $key => $detail)
                                                                    <tr>
                                                                        <td class="text-center" width="20px">{{ ++$key }}</td>
                                                                        <td class="text-center">{{ $detail->item->name }}</td>
                                                                        <td class="text-center">{{ $detail->quantity }}</td>
                                                                        <td class="text-center">Rp. {{ number_format($detail->price) }}</td>
                                                                        <td class="text-center">Rp. {{ number_format($detail->total) }}</td>
                                                                    </tr>
                                                                        @php
                                                                        $grandTotal = $grandTotal + $detail->total;
                                                                        @endphp
                                                                    @endforeach
                                                                    <tr>
                                                                        <td class="text-left" colspan="4">Total Keseluruhan</td>
                                                                        <td class="text-center">Rp. {{ number_format($grandTotal) }}</td>
                                                                    <tr>
                                                                </tbody>
                                                            </table>
                                                            <form class="form-horizontal" method="POST" action="{{ route('admin.transaction.update') }}">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="id" value="{{ $transaction->id }}">
                                                                Resi :
                                                                <input class="form-control" type="text" name="resi" value="">
                                                                <select class="form-control" id="status" name="status" required>
                                                                    <option value="1" @if($transaction->status == 1) selected @endif>
                                                                        Pending
                                                                    </option>
                                                                    <option value="2" @if($transaction->status == 2) selected @endif>
                                                                        Proses
                                                                    </option>
                                                                    <option value="3" @if($transaction->status == 3) selected @endif>
                                                                        Selesai
                                                                    </option>
                                                                </select>
                                                                <div class="row text-center" style="margin-top: 50px">
                                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
{{--											<div class="btn-group" role="group" aria-label="Basic example">--}}
{{--												<form action="../asset/pdf/invoice.php" method="post" target="_blank">--}}
{{--													<input type="hidden" name="idTransaksi" value="<?php echo $row['idTransaksi'] ?>">--}}
{{--													<?php--}}
{{--													if($row['statusTransaksi'] == 'progress') {--}}
{{--													?>--}}
{{--													<a href="detailTransaksi.php?id=<?php echo $row['idTransaksi'] ?>" class="btn btn-warning btn-sm"><i class="fa fa-faw fa-check"></i></a>--}}
{{--													<?php--}}
{{--													}--}}
{{--													?>--}}
{{--													<?php--}}
{{--													if($row['statusTransaksi'] == 'complete') {--}}
{{--														echo '<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-fw fa-print"></i></button>';--}}
{{--													}--}}
{{--													?>--}}
{{--												</form>--}}
{{--											</div>--}}
										</td>
									</tr>

                                    @endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</nav>
	<div class="modal" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Laporan Transaksi</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="POST" action="laporan.php">
						<div class="form-group">
							<label class="col-md-4 control-label">Tanggal Awal</label>
							<div class="col-md-6">
								<input id="tglAwal" type="date" class="form-control" name="tglAwal" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Tanggal Akhir</label>
							<div class="col-md-6">
								<input id="tglAkhir" type="date" class="form-control" name="tglAkhir" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Status</label>
							<div class="col-md-6">
								<select class="form-control" id="status" name="status" required>
									<option value="0">Semuanya</option>
									<option value="1">Complete</option>
									<option value="2">Progress</option>
									<option value="3">Pending</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12 text-center">
								<button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>

			</div>
		</div>
	</div>
	<div class="container-fluid">
	</div>
	<footer class="footer">
	<div class="container-fluid text-center">
		<p class="copyright">
			&copy; 2019 UD. BAJA MAS
		</p>
	</div>
	</footer>
</body>
</html>
