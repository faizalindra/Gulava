@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Bahan Baku'])
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/jQuery_dataTables_1.13.6.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/jQuery_dataTables_1.13.6.min.css') }}" />

    <div class="container-fluid py-4">
        <div class="row align-items-center">
            <div class="col-3">
                <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal"
                    data-bs-target="#tambahBahanBakuModal">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div>
            <div class="col-6">
                @if (session('success'))
                    <div id="rawMaterials-alert" class="alert alert-success alert-dismissible fade show text-bold text-white"
                        role="alert">
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
                                                <p class="text-xs font-weight-bold mb-0  text-center">{{ $rawMaterial->id }}
                                                </p>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $rawMaterial->name }}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $rawMaterial->code }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">Rp. {{ number_format($rawMaterial->price, 0,'.','.') }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs text-center font-weight-bold mb-0">
                                                    {{ $rawMaterial->stock . ' ' . $rawMaterial->unit }}
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
        <script>
            $(document).ready(function() {
                $('#tableBahanBaku').DataTable();
            });
        </script>


        <!-- Form Modal -->
        {{-- <div class="modal fade" id="tambahBahan BakuModal" tabindex="-1" role="dialog"
            aria-labelledby="tambahBahan BakuModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahBahan BakuModalLabel">Tambah Bahan Baku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-dark">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-7">
                                <div class="container">
                                    <form id="Bahan BakuForm" method="POST" action="{{ route('Bahan Bakus.create') }}">
                                        @csrf
                                        @method('post')
                                        <div class="col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="name">Nama</label>
                                                <input class="form-control" id="name" name="name" type="text"
                                                    placeholder="Nama" data-sb-validations="required" required />
                                                <div class="invalid-feedback" data-sb-feedback="name:required">Nama is
                                                    required.
                                                </div>
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label" for="price">Harga Satuan</label>
                                                <input class="form-control" id="price" name="price" type="number"
                                                    placeholder="Harga Satuan (Rp.)" data-sb-validations="required"
                                                    required />
                                                <div class="invalid-feedback" data-sb-feedback="price:required">Harga
                                                    Satuan
                                                    is
                                                    required.</div>
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label" for="stock">Stok</label>
                                                <input class="form-control" id="stock" name="stock" type="number"
                                                    value="0" placeholder="Stok Bahan Baku (Kg)"
                                                    data-sb-validations="required" required />
                                                <div class="invalid-feedback" data-sb-feedback="stock:required">Stok
                                                    Bahan Baku is
                                                    required.</div>
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label" for="grade">Grade</label>
                                                <select class="form-select" id="grade" name="grade"
                                                    aria-label="Grade" required>
                                                    @foreach ($grades as $grade)
                                                        <option value="{{ $grade->name }}">{{ $grade->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-1">
                                                <label for="description" class="form-label">Deskripsi Bahan Baku</label>
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
                            </div>
                            <div class="col-5">
                                <form id="Bahan BakuGradeForm" method="POST" action="{{ route('Bahan Baku.grade.create') }}">
                                    @csrf
                                    @method('post')
                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="name">Nama Grade</label>
                                            <input class="form-control" id="name" name="name" type="text"
                                                placeholder="Nama" data-sb-validations="required" required />
                                            <div class="invalid-feedback" data-sb-feedback="name:required">Nama is
                                                required.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6"></div>
                                    <div class="d-grid pt-4">
                                        <button class="btn btn-primary btn-lg" id="submitButton"
                                            type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
                    </div>
                    <!-- <div class="modal-footer">
                                                                                                                                                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                                                                                                                                        <button type="button" class="btn bg-gradient-primary">Save changes</button>
                                                                                                                                                    </div> -->
                </div>
            </div>
        </div> --}}


        @include('layouts.footers.auth.footer')
    </div>
@endsection
