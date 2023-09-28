@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', [
        'title' => 'Detail Produksi',
        'parents' => [['href' => route('production'), 'title' => 'Produksi']],
    ])
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/jQuery_dataTables_1.13.6.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/sweetalert2.all.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/core/jquery.datetimepicker.full.min.js') }}"></script> --}}

    <link rel="stylesheet" href="{{ asset('assets/css/jQuery_dataTables_1.13.6.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/jquery.datetimepicker.min.css') }}" /> --}}
    <div id="material_id" value="{{ $material->id }}"></div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-2 text-start">
                {{-- @if ($production->is_active)
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalId">
                        Selesaikan
                    </button>
                @else
                    <button type="button" class="btn btn-success btn-sm">Selesai</button>
                @endif --}}
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
                                    <div class="col">Estimasi Harga</div>
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
        {{-- <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahProdukModalLabel">Selesaikan Produksi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-dark">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <form id="finishProduction" method="POST"
                                            action="{{ route('production.finish', ['id' => $production->id]) }}">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="is_active" value="0">
                                            <div class="col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="name">Selesai Pada</label>
                                                    <input class="form-control datetimepicker" id="completed_at"
                                                        name="completed_at" data-sb-validations="required" required
                                                        autocomplete="false" />
                                                    <div class="invalid-feedback" data-sb-feedback="name:required">
                                                    </div>
                                                </div>
                                                <div class="mb-1">
                                                    <label class="form-label" for="name">Estimasi Harga</label>
                                                    <input class="form-control" id="estimated_cost" name="estimated_cost"
                                                        type="number" placeholder="Estimasi Harga"
                                                        data-sb-validations="required" required />
                                                    <div class="invalid-feedback" data-sb-feedback="name:required">
                                                    </div>
                                                </div>
                                                <div class="mb-1">
                                                    <label class="form-label" for="name">Hasil Produksi</label>
                                                    <input class="form-control" id="quantity_produced"
                                                        name="quantity_produced" type="number"
                                                        placeholder="Hasil Produksi" data-sb-validations="required"
                                                        required />
                                                    <div class="invalid-feedback" data-sb-feedback="name:required">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}


        <script>
            $(document).ready(function() {
                $('#flowsTable').DataTable({
                    "pageLength": 5,
                    "lengthChange": false,
                });
                // $('.datetimepicker').datetimepicker({
                //     format: 'Y-m-d H:i:s', // Your desired format
                //     step: 1, // Optional: specify the time increment (1 second in this case)
                // });
                $("#alert-alert").fadeTo(4000, 500).slideUp(500, function() {
                    $("#alert-alert").alert('close');
                });
            });
        </script>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
