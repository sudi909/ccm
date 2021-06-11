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
    <div class="modal fade" id="modalAddCategory" tabindex="-1" aria-labelledby="modalAddCategory" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Tambah Kategori
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.category.create') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Nama Kategori</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
							Kategori
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
							Kategori
						</div>
						<div class="panel-body">
							<table class="table table-hover table-bordered table-condensed table-responsive table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
                                @foreach($categories as $category)
									<tr>
										<td class="text-center" width="20px">1</td>
										<td class="text-center">{{ $category->name }}</td>
										<td class="text-center">
											<button class="btn btn-primary" data-toggle="modal" data-target="#modalUpdateCategory{{ $category->id }}">Update</button>
                                            <a href="{{ route('admin.category.delete', $category->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-faw fa-trash"></i></a>
										</td>
									</tr>
                                    <div class="modal fade" id="modalUpdateCategory{{ $category->id }}" tabindex="-1"  data-backdrop="false" aria-labelledby="modalUpdateCategory" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    Update Kategori
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.category.update') }}" method="POST" enctype="multipart/form-data">
                                                        <input type="hidden" id="id" name="id" value="{{ $category->id }}">
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <label>Nama Kategori</label>
                                                            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
								</tbody>
							</table>
						</div>
						<div class="panel-footer footer-fix">
							<div class="container-fluid">
								<div class="row">
									<div class="col-md-6 text-left">
										<button type="button" class="btn btn-success float-right mb-1" data-toggle="modal" data-target="#modalAddCategory">Tambah Kategori</button>
									</div>
								</div>
							</div>
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
