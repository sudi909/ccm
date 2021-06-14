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
    <div class="modal fade" id="modalAddItem" tabindex="-1" aria-labelledby="modalAddItem" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Tambah Barang
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.item.create') }}" method="POST" enctype="multipart/form-data">
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
							<a href="{{ route('admin.index') }}">Home</a>
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
										<th>Nama Barang</th>
										<th>Kategori Barang</th>
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
											<button class="btn btn-primary" data-toggle="modal" data-target="#modalUpdateItem{{ $item->id }}">Update</button>
                                            <a href="{{ route('admin.item.delete', $item->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-faw fa-trash"></i></a>
										</td>
									</tr>
                                    <div class="modal fade" id="modalUpdateItem{{ $item->id }}" tabindex="-1"  data-backdrop="false" aria-labelledby="modalUpdateItem" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    Update Barang
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
										<button type="button" class="btn btn-success float-right mb-1" data-toggle="modal" data-target="#modalAddItem">Tambah Barang</button>
									</div>
								</div>
							</div>
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
