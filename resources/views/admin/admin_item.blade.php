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
    <div class="modal fade" id="modalTambahBarang" tabindex="-1" aria-labelledby="modalTambahBarang" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Tambah Barang
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.item.create') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Kategori Barang</label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label>Harga Barang</label>
                            <input type="number" class="form-control" id="price" name="price">
                        </div>
                        <div class="form-group">
                            <label>Berat Barang</label>
                            <input type="number" class="form-control" id="weight" name="weight">
                        </div>
                        <div class="form-group">
                            <label>Stok Barang</label>
                            <input type="number" class="form-control" id="stock" name="stock">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Barang</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>
                        <div class="form-group">
                            <label>Gambar 1</label>
                            <input type="file" id="image_1" name="image_1" accept="image/x-png,image/gif,image/jpeg"/>
                        </div>
                        <div class="form-group">
                            <label>Gambar 2</label>
                            <input type="file" id="image_2" name="image_2" accept="image/x-png,image/gif,image/jpeg"/>
                        </div>
                        <div class="form-group">
                            <label>Gambar 3</label>
                            <input type="file" id="image_3" name="image_3" accept="image/x-png,image/gif,image/jpeg"/>
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
							Barang
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
							Barang
						</div>
						<div class="panel-body">
							<table class="table table-hover table-bordered table-condensed table-responsive table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Kategori Barang</th>
										<th>Nama Barang</th>
										<th>Harga Barang</th>
                                        <th>Berat Barang</th>
										<th>Stok Barang</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
                                @foreach($items as $item)
									<tr>
										<td class="text-center" width="20px">1</td>
										<td class="text-center">{{ $item->name }}</td>
										<td class="text-center">{{ $item->category->name }}</td>
										<td class="text-center">Rp. {{ number_format($item->price) }}</td>
										<td class="text-center">{{ number_format($item->weight) }}</td>
										<td class="text-center">{{ number_format($item->stock) }}</td>
										<td class="text-center">
											<button class="btn btn-primary" data-toggle="modal" data-target="#modalUpdateBarang{{ $item->id }}">Update</button>
                                            <a href="{{ route('admin.item.delete') }}" class="btn btn-danger btn-sm"><i class="fa fa-faw fa-trash"></i></a>
										</td>
									</tr>
                                    <div class="modal fade" id="modalUpdateBarang{{ $item->id }}" tabindex="-1"  data-backdrop="false" aria-labelledby="modalUpdateBarang" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    Tambah Barang
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.item.update') }}" method="POST" enctype="multipart/form-data">
                                                        <input type="hidden" id="id" name="id" value="{{ $item->id }}">
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <label>Kategori Barang</label>
                                                            <select class="form-control" id="category_id" name="category_id" required>
                                                                @foreach($categories as $category)
                                                                    @if($category->id == $item->category_id)
                                                                        <option value="{{ $category->id }}" selected>
                                                                            {{ $category->name }}
                                                                        </option>
                                                                    @else
                                                                        <option value="{{ $category->id }}">
                                                                            {{ $category->name }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nama Barang</label>
                                                            <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Harga Barang</label>
                                                            <input type="number" class="form-control" id="price" name="price" value="{{ $item->price }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Berat Barang</label>
                                                            <input type="number" class="form-control" id="weight" name="weight" value="{{ $item->weight }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Stok Barang</label>
                                                            <input type="number" class="form-control" id="stock" name="stock" value="{{ $item->stock }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Deskripsi Barang</label>
                                                            <input type="text" class="form-control" id="description" name="description" value="{{ $item->description }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Gambar 1</label>
                                                            <input type="file" id="image_1" name="image_1" accept="image/x-png,image/gif,image/jpeg"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Gambar 2</label>
                                                            <input type="file" id="image_2" name="image_2" accept="image/x-png,image/gif,image/jpeg"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Gambar 3</label>
                                                            <input type="file" id="image_3" name="image_3" accept="image/x-png,image/gif,image/jpeg"/>
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
										<button type="button" class="btn btn-success float-right mb-1" data-toggle="modal" data-target="#modalTambahBarang">Tambah Barang</button>
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
    <script>
		$(document).ready( function() {
			$(document).on('change', '.btn-file :file', function() {
			var input = $(this),
				label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [label]);
			});

			$('.btn-file :file').on('fileselect', function(event, label) {

				var input = $(this).parents('.input-group').find(':text'),
					log = label;

				if( input.length ) {
					input.val(log);
				} else {
					if( log ) alert(log);
				}

			});
		});
	</script>
</body>
</html>
