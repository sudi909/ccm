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
							Profile
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
							Profile
						</div>
						<div class="panel-body">
							<form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="control-label">Nama</label>
                                    <input type="text" class="form-control" name="name" placeholder="Nama" value="{{ $user->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $user->email }}" required>
                                </div>
                                <br>
                                <strong>Diisi jika ingin mengganti Password Anda</strong>
                                <div class="form-group">
                                    <label class="control-label">Password Lama</label>
                                    <input type="password" class="form-control" name="password_1" placeholder="Password Lama">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Password Baru</label>
                                    <input type="password" class="form-control" name="password_2" placeholder="Password Baru">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control" name="password_3" placeholder="Konfirmasi Password Baru">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info">Simpan</button>
                                </div>
                            </form>
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
