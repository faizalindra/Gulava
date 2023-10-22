@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', [
        'title' => 'Detail Sales',
        'parents' => [['href' => route('salesperson'), 'title' => 'Sales']],
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
    <div id="salesperson_id" value="{{ $salesperson->id }}"></div>
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
                        <h5>Detail - {{ $salesperson->code }}</h5>
                    </div>
                    <div class="card-body pt-1 mt-1">
                        <div class="row">
                            <div class="col">
                                <h3>{{ $salesperson->name }}</h3>
                                <hr class="hr">
                                <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
                                    <tr>
                                        <td style="padding: 10px; text-align: left;">NIK</td>
                                        <td style="padding: 10px; text-align: left;">{{ $salesperson->nik }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px; text-align: left;">Jenis Kelamin</td>
                                        <td style="padding: 10px; text-align: left;">
                                            @if ($salesperson->gender == 'M')
                                                Laki-laki
                                            @else
                                                Perempuan
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px; text-align: left;">Alamat</td>
                                        <td style="padding: 10px; text-align: left;">{{ $salesperson->address }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px; text-align: left;">Nomor Telepon/HP</td>
                                        <td style="padding: 10px; text-align: left;">{{ $salesperson->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px; text-align: left;">Email</td>
                                        <td style="padding: 10px; text-align: left;">{{ $salesperson->email }}</td>
                                    </tr>
                                </table>

                            </div>
                            {{-- <div class="col-7">
                                <div class="card border border-primary shadow-0 ">
                                    <div class="card-header">
                                        <div class="row justify-content-between">
                                            <div class="col">
                                                <h5 class="card-title">Histori Bahan Baku</h5>
                                            </div>
                                            <div class="col text-end">
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#addNewFlow">
                                                    Tambah
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
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
                                                    {{-- @foreach ($salesperson->flows as $flow)
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
                                                                {{ $flow->quantity . ' ' . $salesperson->unit }}</td>
                                                            <td class="text-center">Rp.
                                                                {{ number_format($flow->price, 0, '.', '.') }}</td>
                                                            <td class="text-center">{{ $flow->created_at }}</td>
                                                        </tr>
                                                    @endforeach --}}
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
                    <form id="editSalesperson" method="POST"
                        action="{{ route('salesperson.update', ['id' => $salesperson->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label" for="code">Kode</label>
                            <input class="form-control" id="code" name="code" type="text"
                                value="{{ $salesperson->code }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="name">Nama</label>
                            <input class="form-control" id="name" name="name" type="text"
                                value="{{ $salesperson->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="price">Harga</label>
                            <input class="form-control" id="price" name="price" type="number"
                                value="{{ $salesperson->price }}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="stock">Stok</label>
                                <input class="form-control" id="stock" name="stock" type="number"
                                    value="{{ $salesperson->stock }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="stock_min">Stok Minimal</label>
                                <input class="form-control" id="stock_min" name="stock_min" type="number"
                                    value="{{ $salesperson->stock_min }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="unit">Unit</label>
                                <input class="form-control" id="unit" name="unit" type="text"
                                    value="{{ $salesperson->unit }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="suppliers">Supplier</label>
                            <select class="select2" id="suppliers" name="suppliers[]" multiple="">
                                {{-- @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}"
                                            {{ in_array($supplier->id, $salesperson->suppliers->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach --}}
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

            $("#alert-alert").fadeTo(4000, 500).slideUp(500, function() {
                $("#alert-alert").alert('close');
            });


            const quantityInput = $('#quantity_');
            const priceInput = $('#price_');
            const totalPriceInput = $('#total_price_');

            // Function to calculate the total price
            function calculateTotalPrice() {
                const quantity = parseFloat(quantityInput.val()) || 0;
                const price = parseFloat(priceInput.val()) || 0;
                const total = quantity * price;
                totalPriceInput.val(total);
            }

            // Function to calculate the price
            function calculatePrice() {
                const quantity = parseFloat(quantityInput.val()) || 0;
                const total = parseFloat(totalPriceInput.val()) || 0;

                if (quantity > 0) {
                    const price = total / quantity;
                    priceInput.val(price);
                } else {
                    priceInput.val('0.00');
                }
            }

            // Add event listeners to quantity, price, and total_price inputs
            quantityInput.on('input', function() {
                calculateTotalPrice();
                calculatePrice();
            });
            priceInput.on('input', function() {
                calculateTotalPrice();
            });
            totalPriceInput.on('input', function() {
                calculatePrice();
            });

        });
    </script>
    @include('layouts.footers.auth.footer')
    </div>
@endsection
