@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Barang Jalan'])
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/jQuery_dataTables_1.13.6.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/jQuery_dataTables_1.13.6.min.css') }}" />

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col">
                <!-- Modal trigger button -->
                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalProduction">
                    Buat Surat Jalan
                </button>
            </div>
        </div>
    </div>



    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    {{-- <div class="modal fade" id="modalProduction" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
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
                            <form id="productionForm" method="post" action="{{route('production.create')}}">
                                @csrf
                                @method('post')
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="product_id">Produk</label>
                                        <input class="form-control" id="product_id" name="product_id" type="number"
                                            placeholder="Produk" required />
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
                                        <div class="col"><button class="btn btn-primary btn-lg" id="submitButton"
                                                type="submit">Submit</button></div>
                                        <div class="col"><button class="btn btn-secondary btn-lg" type="button"
                                                data-bs-dismiss="modal">Cancel</button></div>
                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}



    <!-- Optional: Place to the bottom of scripts -->
    <script>
        const myModal = new bootstrap.Modal(document.getElementById('modalProduction'), options)
        // Function to add a new material row
        function addMaterialRow() {
            const materialRow = `
                <div class="row material">
                    <div class="col mb-1">
                        <label class="form-label" for="material_id">Material ID:</label>
                        <input class="form-control" type="number" name="materials[id][]" required>
                    </div>
                    <div class="col mb-1">
                        <label class="form-label" for="quantity_used">Quantity Used:</label>
                        <input class="form-control" type="number" name="materials[quantity_used][]" required>
                    </div>
                    <div class="col mb-1">
                        <label class="form-label" for="estimated_cost">Estimated Cost:</label>
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

        $("#productionForm").submit(function (event) {
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
