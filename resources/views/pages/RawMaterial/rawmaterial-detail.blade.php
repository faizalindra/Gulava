@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', [
        'title' => 'Detail Produksi',
        'parents' => [['href' => route('production'), 'title' => 'Produksi']],
    ])

    <link rel="stylesheet" href="{{ asset('assets/css/jQuery_dataTables_1.13.6.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}" />

    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/jQuery_dataTables_1.13.6.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/select2.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/core/jquery.datetimepicker.full.min.js') }}"></script> --}}


    {{-- <link rel="stylesheet" href="{{ asset('assets/css/jquery.datetimepicker.min.css') }}" /> --}}
    <div id="material_id" value="{{ $material->id }}"></div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-2 text-start">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal">
                    Edit
                </button>
            </div>
            <div class="col">
                <div class="col-6">
                    @if (session('success'))
                        <div id="alert-alert" class="alert alert-success alert-dismissible fade show text-bold text-white"
                            role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div id="alert-alert" class="alert alert-danger alert-dismissible fade show text-bold text-white"
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
                        $("#alert-alert").fadeTo(4000, 500).slideUp(500, function() {
                            $("#alert-alert").alert('close');
                        });
                    </script>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card border border-primary shadow-0 ">
                    <div class="card-header pb-1 mb-1">
                        <h5>Detail - {{ $material->code }}</h5>
                    </div>
                    <div class="card-body pt-1 mt-1">
                        <div class="row">
                            <div class="col-5">
                                <h3>{{ $material->name }}</h3>
                                <hr class="hr">
                                <div class="row text-center">
                                    <div class="col">Stok</div>
                                    <div class="col">harga Bahan Baku</div>
                                </div>
                                <div class="row text-center">
                                    <div class="col">
                                        @if ($material->stock > $material->stock_min + $material->stock_min * 0.3)
                                            <span
                                                class="badge badge-pill badge-success bg-success">{{ $material->stock . ' ' . $material->unit }}</span>
                                        @elseif ($material->stock > $material->stock_min && $material->stock < $material->stock_min + $material->stock_min * 0.3)
                                            <span
                                                class="badge badge-pill badge-warning bg-warning">{{ $material->stock . ' ' . $material->unit }}</span>
                                        @else
                                            <span
                                                class="badge badge-pill badge-danger bg-danger">{{ $material->stock . ' ' . $material->unit }}</span>
                                        @endif
                                    </div>
                                    <div class="col">Rp. {{ number_format($material->price, 0, '.', '.') }}</div>
                                </div>
                                <div class="row mt-4 pt-4">
                                    <span class="text-card">List Supplier :
                                        <ul>
                                            @foreach ($material->suppliers as $supplier)
                                                <li><a href="{{ route('profile') }}">{{ $supplier->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </span>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="card border border-primary shadow-0 ">
                                    <div class="card-body">
                                        <h5 class="card-title">Histori Bahan Baku</h5>
                                        <div class="table-responsive">
                                            <table id="flowsTable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col"></th>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Supplier</th>
                                                        <th scope="col">Jumlah</th>
                                                        <th scope="col">Harga</th>
                                                        <th scope="col">Tanggal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($material->flows as $flow)
                                                        <tr>
                                                            <td class="text-center">
                                                                @if ($flow->is_in == true)
                                                                    <button
                                                                        class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                                                            class="fas fa-arrow-up"></i></button>
                                                                @else
                                                                    <button
                                                                        class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                                                            class="fas fa-arrow-down"></i></button>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">{{ $loop->iteration }}</th>
                                                            <td class="text-center">{{ $flow->supplier->name }}</td>
                                                            <td class="text-center">
                                                                {{ $flow->quantity . ' ' . $material->unit }}</td>
                                                            <td class="text-center">Rp.
                                                                {{ number_format($flow->price, 0, '.', '.') }}</td>
                                                            <td class="text-center">{{ $flow->created_at }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--  Modal trigger button  -->


        <!-- Modal Body-->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalTitle">Edit Bahan Baku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-dark">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editRawMaterial" method="POST"
                            action="{{ route('raw-material.update', ['id' => $material->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="code">Kode</label>
                                <input class="form-control" id="code" name="code" type="text"
                                    value="{{ $material->code }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="name">Nama</label>
                                <input class="form-control" id="name" name="name" type="text"
                                    value="{{ $material->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="price">Harga</label>
                                <input class="form-control" id="price" name="price" type="number"
                                    value="{{ $material->price }}" required>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="stock">Stok</label>
                                    <input class="form-control" id="stock" name="stock" type="number"
                                        value="{{ $material->stock }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="stock_min">Stok Minimal</label>
                                    <input class="form-control" id="stock_min" name="stock_min" type="number"
                                        value="{{ $material->stock_min }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="unit">Unit</label>
                                    <input class="form-control" id="unit" name="unit" type="text"
                                        value="{{ $material->unit }}" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="suppliers">Supplier</label>
                                <select class="select2" id="suppliers" name="suppliers[]" multiple="">
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}"
                                            {{ in_array($supplier->id, $material->suppliers->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="d-grid pt-4">
                                <button class="btn btn-primary btn-lg" id="editSubmitButton" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <script>
            $(document).ready(function() {
                $('#flowsTable').DataTable({
                    "pageLength": 5,
                    "lengthChange": false,
                });

                $('.select2').select2({
                    width: '100%', // Set the width to 100% of its container
                    dropdownCssClass: 'select2-dropdown-big', // Apply custom CSS class to the dropdown

                });

                //send editRawMaterial via ajax


                $("#alert-alert").fadeTo(4000, 500).slideUp(500, function() {
                    $("#alert-alert").alert('close');
                });
            });
        </script>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
