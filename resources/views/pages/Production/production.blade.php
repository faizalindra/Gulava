@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Produksi'])
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/jQuery_dataTables_1.13.6.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/core/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/js/core/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/buttons.print.min.js') }}"></script> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/jQuery_dataTables_1.13.6.min.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/buttons.dataTables.min.css') }}" /> --}}

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
                            <table id="tableProduction">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7  text-center">
                                            #</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Kode</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal Produksi</th>
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
                                                <p class="text-xs font-weight-bold mb-0  text-center">{{ $loop->iteration }}
                                                </p>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $production->code }}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $production->created_at }}
                                                </p>
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
                                                    @if (!$production->is_active)
                                                        {{ $production->period }} Jam
                                                    @else
                                                        -
                                                    @endif
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
                                                <a href="{{ route('production.detail', ['id' => $production->id]) }}"
                                                    class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                    data-original-title="Edit user">
                                                    <i class=" fas fa-eye text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Lihat Detail"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
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
                            <form id="productionForm" method="POST" action="{{ route('production.create') }}">
                                @csrf
                                @method('post')
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="produks_id">Produk</label>
                                        <select class="form-control" id="produks_id" name="produks_id" required>
                                            <option value="" selected disabled hidden>Pilih Produk</option>
                                            @foreach ($products as $product)
                                                <option value="{{ intval($product->id) }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label for="material_total_price" class="form-label">Estimasi Total Biaya
                                            Produksi</label>
                                        <input type="number" class="form-control" id="material_total_price"
                                            name="material_total_price" readonly>
                                    </div>
                                    <input id="material_count" type="number" name="material_count" value="0"
                                        hidden>
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
                                        Bahan Baku</button>
                                </div>
                                <div class="col-6"></div>
                                <div class="d-grid pt-4 modal-footer">
                                    <div class="row">
                                        <div class="col"><button class="btn btn-secondary btn-lg" type="button"
                                                data-bs-dismiss="modal">Cancel</button></div>
                                        <div class="col"><button class="btn btn-primary btn-lg" id="submit"
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
            $('#tableProduction').DataTable({
                // dom: 'Bfrtip',
                // buttons: [
                //     'copy', 'csv', 'excel', 'pdf', 'print'
                // ]
            });
        });

        // const myModal = new bootstrap.Modal(document.getElementById('modalProduction'), options)
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
                                    <option value="{{ $material->id }}" data-unit="{{ $material->unit }}" data-price="{{ $material->price }}" data-stock="{{ $material->stock }}">{{ $material->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col mb-1">
                        <label class="form-label" for="quantity_used">Jumlah:</label>
                        <input class="form-control" type="number" name="materials[quantity_used][]" required>
                    </div>
                    <div class="col mb-1">
                        <label class="form-label" for="price">Harga Per-Unit:</label>
                        <input class="form-control" type="number" name="materials[price][]" required>
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
            updateMaterialCount(1);
            let count = $('#material_count').val();
            $("#materials").append(materialRow);
            const newRow = $("#materials .material").last();

            // Add event listeners for quantity and price fields in the new row
            newRow.find("input[name='materials[quantity_used][]'], input[name='materials[price][]']").on("input",
                function() {
                    // Get quantity and price values from the current row
                    const quantity = parseFloat(newRow.find("input[name='materials[quantity_used][]']").val()) || 0;
                    const price = parseFloat(newRow.find("input[name='materials[price][]']").val()) || 0;

                    // Calculate the total price
                    const total = quantity * price;

                    // Update the total price field in the current row
                    newRow.find("input[name='materials[estimated_cost][]']").val(total);
                    updateTotalPrice();
                });

            // Add event listener for the product selection dropdown
            newRow.find("select[name='materials[id][]']").on("change", function() {
                console.log("change");
                // Get the selected option
                const selectedOption = $(this).find("option:selected");

                // Get the data-price attribute value
                const price = parseFloat(selectedOption.data("price")) || 0;

                // Update the price input field with the selected price
                newRow.find("input[name='materials[price][]']").val(price);

                // Calculate and update the total price
                const quantity = parseFloat(newRow.find("input[name='materials[quantity_used][]']").val()) || 0;
                const total = quantity * price;
                newRow.find("input[name='materials[estimated_cost][]']").val(total);
                updateTotalPrice();
            });
        }

        // Function to remove a material row
        function removeMaterialRow(event) {
            $(event.target).closest(".material").remove();
            updateMaterialCount(-1);
            let count = $('#material_count').val();
            updateTotalPrice();
        }

        function updateMaterialCount(change) {
            const materialCountInput = $('#material_count');
            const currentCount = parseInt(materialCountInput.val());
            const newCount = currentCount + change;

            // Ensure the count is not negative
            if (newCount >= 0) {
                materialCountInput.val(newCount);
            }
        }

        function updateTotalPrice() {
            let totalPrice = 0;

            // Iterate through all rows and sum up the total prices
            $("#materials .material").each(function() {
                console.log("each");
                const total = parseFloat($(this).find("input[name='materials[estimated_cost][]']").val()) || 0;
                totalPrice += total;
            });
            // Update the "Jumlah" field with the calculated total price
            $("#material_total_price").val(totalPrice);
        }
    </script>

    @include('layouts.footers.auth.footer')
    </div>
@endsection
