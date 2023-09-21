@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Produksi'])
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/jQuery_dataTables_1.13.6.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/jQuery_dataTables_1.13.6.min.css') }}" />

    <div class="container-fluid py-4">
        <div class="row align-items-center">
            <div class="col-3">
                <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modalProduction">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div>
            <div class="col-6">
                @if (session('success'))
                    <div id="production-alert" class="alert alert-success alert-dismissible fade show text-bold text-white"
                        role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div id="production-alert" class="alert alert-danger alert-dismissible fade show text-bold text-white"
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
                    $("#production-alert").fadeTo(4000, 500).slideUp(500, function() {
                        $("#production-alert").alert('close');
                    });
                </script>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Tabel Produksi</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="tableProduction" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7  text-center">
                                            ID</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Kode</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Produk</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Hasil Produksi</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Estimasi Harga</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Periode</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productions as $production)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0  text-center">{{ $production->id }}
                                                </p>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $production->code }}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $production->product->name }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $production->quantity_produced }} Kg</p>
                                            </td>
                                            <td>
                                                <p class="text-xs text-center font-weight-bold mb-0">
                                                    Rp. {{ number_format($production->estimated_cost, 0, '.', '.') }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs text-center font-weight-bold mb-0">
                                                    {{ $production->period }} Jam
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if (!$production->is_active)
                                                    <span class="badge badge-sm bg-gradient-success">
                                                        Selesai
                                                    </span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-info">
                                                        Proses
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('produks.detail', ['id' => $production->id]) }}"
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
    </div>



    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="modalProduction" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalProduksiTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProduksiTitleId">Form Produksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <form id="productionForm" method="post" action="{{ route('production.create') }}">
                                @csrf
                                @method('post')
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="product_id">Produk</label>
                                        <select class="form-control" id="product_id" name="product_id" required>
                                            <option value="" selected disabled hidden>Pilih Produk</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-1 mb-2">
                                        <label class="form-label" for="description">Deskripsi</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"
                                            placeholder="Description of the product"></textarea>
                                    </div>
                                    <div id="materials">
                                        <!-- Material rows will be added here -->
                                    </div>
                                    <button id="addMaterial" onclick="addMaterialRow()" type="button"
                                        class="btn btn-primary">Add
                                        Material</button>
                                </div>
                                <div class="col-6"></div>
                                <div class="d-grid pt-4 modal-footer">
                                    <div class="row">
                                        <div class="col"><button class="btn btn-secondary btn-lg" type="button"
                                                data-bs-dismiss="modal">Cancel</button></div>
                                        <div class="col"><button class="btn btn-primary btn-lg" id="submitButton"
                                                type="submit">Submit</button></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional: Place to the bottom of scripts -->
    <script>
        $(document).ready(function() {
            $('#tableProduction').DataTable();
        });

        const myModal = new bootstrap.Modal(document.getElementById('modalProduction'), options)
        // Function to add a new material row
        function addMaterialRow() {
            const materialRow = `
                <div class="row material">
                    <div class="col mb-1">
                        <div class="form-group">
                            <label for="material_id">Bahan Baku:</label>
                            <select class="form-control" name="materials[id][]" required>
                                <option value=""  selected disabled hidden>Pilih Bahan Baku</option>
                                @foreach ($materials as $material)
                                    <option value="{{ $material->id }}">{{ $material->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col mb-1">
                        <label class="form-label" for="quantity_used">Jumlah:</label>
                        <input class="form-control" type="number" name="materials[quantity_used][]" required>
                    </div>
                    <div class="col mb-1">
                        <label class="form-label" for="estimated_cost">Estimasi Biaya:</label>
                        <input class="form-control" type="number" name="materials[estimated_cost][]" required>
                    </div>
                    <div class="col-1 mb-1">
                        <button class="removeMaterial btn btn-danger mt-3 p-3" onclick="removeMaterialRow(event)" type="button"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            `;
            $("#materials").append(materialRow);
        }

        // Function to remove a material row
        function removeMaterialRow(event) {
            $(event.target).closest(".material").remove();
        }

        $("#productionForm").submit(function(event) {
            event.preventDefault();
            const formData = $(this).serializeArray();
            console.log(formData);
            // You can now send the formData to your API for processing.
            // Implement your API call here.
        });
    </script>

    @include('layouts.footers.auth.footer')
    </div>
@endsection
