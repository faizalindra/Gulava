@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Produk'])
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
    <div class="container-fluid py-4">
        <div class="row align-items-center">
            <div class="col-3">
                <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal"
                    data-bs-target="#tambahProdukModal">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div>
            <div class="col-6">
                @if (session('success'))
                    <div id="product-alert" class="alert alert-success alert-dismissible fade show text-bold text-white" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div id="product-alert" class="alert alert-danger alert-dismissible fade show text-bold text-white" role="alert">
                        <strong>Oops!</strong><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-bold">{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                    <script>
                        $("#product-alert").fadeTo(4000, 500).slideUp(500, function() {
                            $("#product-alert").alert('close');
                        });
                    </script>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Tabel Produk</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7  text-center">
                                            ID</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nama Produk</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Kode</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Grade</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Stok</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Produksi</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0  text-center">{{ $product->id }}
                                                </p>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $product->name }}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $product->code }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $product->grade }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs text-center font-weight-bold mb-0">
                                                    {{ $product->stock }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($product->is_production)
                                                    <span class="badge badge-sm bg-gradient-success">
                                                        Produksi
                                                    </span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-info">
                                                        Free
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    @if ($product->is_active)
                                                        <span class="badge badge-sm bg-gradient-success">
                                                            Aktif
                                                        </span>
                                                    @else
                                                        <span class="badge badge-sm bg-gradient-danger">
                                                            Non-Aktif
                                                        </span>
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    <i class=" fas fa-eye text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Lihat Detail"></i>
                                                </a>
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


        <!-- Form Modal -->
        <div class="modal fade" id="tambahProdukModal" tabindex="-1" role="dialog"
            aria-labelledby="tambahProdukModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahProdukModalLabel">Tambah Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-dark">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- <div class="col-6"> -->
                        <div class="container">
                            <form id="contactForm" method="POST" action="{{ route('produks.create') }}">
                                @csrf
                                @method('post')
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="name">Nama</label>
                                        <input class="form-control" id="name" name="name" type="text"
                                            placeholder="Nama" data-sb-validations="required" required />
                                        <div class="invalid-feedback" data-sb-feedback="name:required">Nama is required.
                                        </div>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="price">Harga Satuan</label>
                                        <input class="form-control" id="price" name="price" type="number"
                                            placeholder="Harga Satuan (Rp.)" data-sb-validations="required" required />
                                        <div class="invalid-feedback" data-sb-feedback="price:required">Harga Satuan
                                            is
                                            required.</div>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="stock">Stok</label>
                                        <input class="form-control" id="stock" name="stock" type="number"
                                            value="0" placeholder="Stok Produk (Kg)" data-sb-validations="required"
                                            required />
                                        <div class="invalid-feedback" data-sb-feedback="stock:required">Stok Produk is
                                            required.</div>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="grade">Grade</label>
                                        <select class="form-select" id="grade" name="grade" aria-label="Grade"
                                            required>
                                            @foreach ($grades as $grade)
                                                <option value="{{ $grade->name }}">{{ $grade->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label for="description" class="form-label">Deskripsi Produk</label>
                                        <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-6"></div>
                                <div class="d-grid pt-4">
                                    <button class="btn btn-primary btn-lg" id="submitButton"
                                        type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- </div> -->

                        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
                    </div>
                    <!-- <div class="modal-footer">
                                                                                                                                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                                                                                                                <button type="button" class="btn bg-gradient-primary">Save changes</button>
                                                                                                                            </div> -->
                </div>
            </div>
        </div>


        @include('layouts.footers.auth.footer')
    </div>
@endsection
