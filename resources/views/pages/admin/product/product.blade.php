@extends('layouts.admin.main')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  {{-- <div class="content-wrapper"> --}}
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header d-flex col-sm-12 justify-content-between">
                <div class="col-10">
                    <form action="{{ route('products') }}" method="GET">
                        <div class="input-group col-sm-4 mb-3">
                            <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                  {{-- <form action="product.php?aksi=cari" method="post">
                    <div class="input-group col-sm-4 mr-3">
                      <input type="text" name="search" id="search" class="form-control" placeholder="Search">
                      <div class="input-group-append">
                          <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                          </button>
                      </div>
                    </div>
                  </form> --}}
                </div>
                <!-- <h3 class="card-title col align-self-center">List Products</h3> -->
                <div class="col-sm-2">
                    <a href="{{ route('products.create') }}" class="btn btn-primary"><i class="nav-icon fas fa-plus mr-2"></i> Add Product</a>
                </div>
              </div>
              <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success bg-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Product Name</th>
                      <th>Category</th>
                      <th>Price</th>
                      <th>Image</th>
                      <th style="width: 200px;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $key => $product)
                    {{-- @dd($product) --}}
                    <tr>
                        <td>{{ $startNumber++ }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->category_name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                        @php
                            $images = json_decode($product->image);
                        @endphp
                        @if ($images)
                        <div class="text-center">
                            @foreach ($images as $image)
                            <img src="{{ asset('storage/image/' . $image) }}" alt="" width="100">
                            @endforeach
                        </div>
                        @endif
                        </td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info"><i class="nav-icon fas fa-edit mr-2"></i>Edit</a>
                            {{-- <a href="" class="btn btn-danger delete-product" data-product-id="{{ $product->id }}"><i class="nav-icon fas fa-trash-alt mr-2"></i>Delete</a> --}}
                            <form action="{{ route('products.delete', $product->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" type="submit"><i class="nav-icon fas fa-trash-alt mr-2"></i>Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->

              <div class="card-footer clearfix">
                <div class="float-right">
                    {{ $products->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  {{-- </div> --}}
  <!-- /.content-wrapper -->

@endsection

{{-- @section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Ambil semua elemen dengan class delete-product
            var deleteButtons = document.querySelectorAll('.delete-product');

            // Tambahkan event listener untuk setiap tombol delete
            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function (event) {
                    // Mencegah tindakan default agar tidak mengarahkan ke halaman baru
                    event.preventDefault();

                    // Tampilkan konfirmasi popup
                    var productId = button.getAttribute('data-product-id');
                    var confirmation = confirm('Are you sure you want to delete this product?');

                    // Jika pengguna mengonfirmasi, redirect ke route delete
                    if (confirmation) {
                        window.location.href = '/products/' + productId;
                    }
                });
            });
        });
    </script>
@endsection --}}
