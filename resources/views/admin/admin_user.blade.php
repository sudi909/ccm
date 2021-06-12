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
