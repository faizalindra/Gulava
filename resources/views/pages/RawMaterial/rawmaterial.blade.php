@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Bahan Baku'])
    <link rel="stylesheet" href="{{ asset('assets/css/jQuery_dataTables_1.13.6.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}" />

    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/jQuery_dataTables_1.13.6.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/select2.min.js') }}"></script>


    <div class="container-fluid py-4">
        <div class="row align-items-center">
            <div class="col-3">
                <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div>
            <div class="col-6">
                @if (session('success'))
                    <div id="rawMaterials-alert"
                        class="alert alert-success alert-dismissible fade show text-bold text-white" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div id="rawMaterials-alert" class="alert alert-danger alert-dismissible fade show text-bold text-white"
                        role="alert">
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
                    $("#rawMaterials-alert").fadeTo(4000, 500).slideUp(500, function() {
                        $("#rawMaterials-alert").alert('close');
                    });
                </script>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Tabel Bahan Baku</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="tableBahanBaku" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7  text-center">
                                            ID</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nama</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Kode</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Harga</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Stok</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rawMaterials as $rawMaterial)
                                        {{-- @dd($rawMaterials) --}}
                                        <tr>
                                            <td>
                                                <p class="text-lg font-weight-bold mb-0  text-center">{{ $rawMaterial->id }}
                                                </p>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-lg">{{ $rawMaterial->name }}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-lg font-weight-bold mb-0">{{ $rawMaterial->code }}</p>
                                            </td>
                                            <td>
                                                <p class="text-lg font-weight-bold mb-0">Rp.
                                                    {{ number_format($rawMaterial->price, 0, '.', '.') }}</p>
                                            </td>
                                            <td>
                                                <p class="text-lg text-center font-weight-bold mb-0">
                                                    @if ($rawMaterial->stock > $rawMaterial->stock_min + $rawMaterial->stock_min * 0.3)
                                                        <span
                                                            class="badge badge-pill badge-success bg-success">{{ $rawMaterial->stock . ' ' . $rawMaterial->unit }}</span>
                                                    @elseif (
                                                        $rawMaterial->stock > $rawMaterial->stock_min &&
                                                            $rawMaterial->stock < $rawMaterial->stock_min + $rawMaterial->stock_min * 0.3)
                                                        <span
                                                            class="badge badge-pill badge-warning bg-warning">{{ $rawMaterial->stock . ' ' . $rawMaterial->unit }}</span>
                                                    @else
                                                        <span
                                                            class="badge badge-pill badge-danger bg-danger">{{ $rawMaterial->stock . ' ' . $rawMaterial->unit }}</span>
                                                    @endif
                                                </p>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('raw-material.detail', ['id' => $rawMaterial->id]) }}"
                                                    class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                    data-original-title="Edit user">
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



        <!-- Modal Body-->
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalTitle">Edit Bahan Baku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-dark">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editRawMaterial" method="POST" action="{{ route('raw-material.create') }}">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label class="form-label" for="name">Nama</label>
                                <input class="form-control" id="name" name="name" type="text" value=""
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="price">Harga</label>
                                <input class="form-control" id="price" name="price" type="number" value=""
                                    required>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="stock">Stok</label>
                                    <input class="form-control" id="stock" name="stock" type="number"
                                        value="" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="stock_min">Stok Minimal</label>
                                    <input class="form-control" id="stock_min" name="stock_min" type="number"
                                        value="" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="unit">Unit</label>
                                    <input class="form-control" id="unit" name="unit" type="text"
                                        value="" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="suppliers">Supplier</label>
                                <select class="select2" id="suppliers" name="suppliers[]" multiple="">
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-grid pt-4">
                                <button class="btn btn-primary btn-lg" id="editSubmitButton"
                                    type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#tableBahanBaku').DataTable();
            });
            $('.select2').select2({
                width: '100%', // Set the width to 100% of its container
                dropdownCssClass: 'select2-dropdown-big', // Apply custom CSS class to the dropdown

            });
        </script>

        @include('layouts.footers.auth.footer')
    </div>
@endsection
