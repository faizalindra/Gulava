@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Sales'])
    <link rel="stylesheet" href="{{ asset('assets/css/jQuery_dataTables_1.13.6.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}" />

    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/jQuery_dataTables_1.13.6.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/core/select2.min.js') }}"></script> --}}


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
                        <h6>Daftar Sales</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive table-sm p-0">
                            <div class="container">
                                <table id="salesTable" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 1px"
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                #</th>
                                            <th style="width: 5%"
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Kode</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                style="width: 15%;">Nama</th>
                                            <th style="width: 10%"
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                HP</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                style="width: 150px;">Alamat</th>
                                            {{-- <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Email</th> --}}

                                            <th class="text-secondary opacity-7"></th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @foreach ($salespersons as $sales)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $sales->code }}</td>
                                                <td>{{ $sales->name }}</td>
                                                <td>{{ $sales->phone }}</td>
                                                <td>{{ $sales->address }}</td>
                                                {{-- <td>{{ $sales->email }}</td> --}}
                                                <td class="text-end"><a
                                                        href="{{ route('salesperson.detail', ['id' => $sales->id]) }}"><i
                                                            class="fa fa-eye"></i></a>
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
        </div>



        <!-- Modal Body-->
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalTitle">Tambah Sales</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-dark">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addSalesperson" method="POST" action="{{ route('salesperson.create') }}">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label class="form-label" for="nik">Nomor Induk Kependudukan (NIK)</label>
                                <input class="form-control" id="nik" name="nik" type="number" value=""
                                    length="16" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="name">Nama</label>
                                <input class="form-control" id="name" name="name" type="text" value=""
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="male"
                                        value="M" required>
                                    <label class="form-check-label" for="male">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="female"
                                        value="F" required>
                                    <label class="form-check-label" for="female">Perempuan</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input class="form-control" id="email" name="email" type="text" value=""
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="phone">No Telp</label>
                                <input class="form-control" id="phone" name="phone" type="number" value=""
                                    maxlength="15" minlength="8" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="address">Alamat:</label>
                                <textarea class="form-control" id="address" name="address" rows="2" required></textarea>
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
                $('#salesTable').DataTable();
            });
        </script>

        @include('layouts.footers.auth.footer')
    </div>
@endsection
