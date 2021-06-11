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
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="margin-top: 15px"><b>{{ $user->name }}</font></b></a>
						<ul class="dropdown-menu" role="menu">
                            <li><a href="banner.php"><b>Banner</b></a></li>
                            <li><a href="barang.php"><b>Barang</b></a></li>
                            <li><a href="jenis.php"><b>Jenis</b></a></li>
                            <li><a href="kategori.php"><b>Kategori</b></a></li>
                            <li><a href="transaksi.php"><b>Transaksi <span class="badge badge-secondary"></span></b></a></li>
						</ul>
					</li>
                    <li><a href="php/logout.php" style="margin-top: 15px"><b>Log Out</b></a></li>
				</ul>
			</div>
			<div class="container" style="margin-top: 20px">
				<div class="row">
					<ol class="breadcrumb">
						<li>
							<a href="home.php">Home</a>
						</li>
						<li class="active">
							User
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
							User
						</div>
						<div class="panel-body">
							<table class="table table-hover table-bordered table-condensed table-responsive table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
                                        <th>Email</th>
                                        <th>Nomor Telepon</th>
                                        <th>Level</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
                                @foreach($users as $u)
									<tr>
										<td class="text-center" width="20px">1</td>
										<td class="text-center">{{ $u->name }}</td>
                                        <td class="text-center">{{ $u->email }}</td>
                                        <td class="text-center">{{ $u->phone_number }}</td>
                                        @if($u->level == 1)
                                            <td class="text-center">User</td>
                                        @else
                                            <td class="text-center">Admin</td>
                                        @endif
										<td class="text-center">
                                            <a href="{{ route('admin.user.update', $u->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-faw fa-arrow-up"></i></a>
                                            <a href="{{ route('admin.user.reset', $u->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-faw fa-refresh"></i></a>
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
	<div class="container-fluid text-center">
		<p class="copyright">
			&copy; 2021 Central Cahaya Matahari
		</p>
	</div>
	</footer>
</body>
</html>
