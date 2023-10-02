@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Logistik'])
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
                        <h6>Tabel Logistik</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="tableLogistic" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th rowspan="2"
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7  text-center">
                                            #</th>
                                        <th rowspan="2"
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Kode</th>
                                        <th rowspan="2"
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Sales</th>
                                        <th colspan="3"
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">
                                            Periode</th>
                                        <th rowspan="2"
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Total Harga</th>
                                        <th rowspan="2"
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            List Produk</th>
                                        <th rowspan="2"
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th rowspan="2" class="text-secondary opacity-7"></th>
                                    </tr>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mulai</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Berakhir</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Durasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        function getDuration($start, $end)
                                        {
                                            $start = Carbon\Carbon::parse($start);
                                            $end = Carbon\Carbon::parse($end);
                                            $diff = $start->diffInHours($end);
                                            return $diff;
                                        }
                                    @endphp
                                    @foreach ($outgoingGoods as $og)
                                        <tr>
                                            <td class="text-xs font-weight-bold mb-0">{{$loop->iteration}}</td>
                                            <td class="text-xs font-weight-bold mb-0">{{$og->code}}</td>
                                            <td class="text-xs font-weight-bold mb-0">{{$og->salesperson->name}}</td>
                                            <td class="text-xs font-weight-bold mb-0 text-center">
                                                {{ date('Y-m-d', strtotime($og->created_at)) }}<br>
                                                {{ date('H:i:s', strtotime($og->created_at)) }}
                                            </td>
                                            <td class="text-xs font-weight-bold mb-0 text-center">
                                                @if ($og->has('returningGoods') && $og->returningGoods->is_active)
                                                    {{ date('Y-m-d', strtotime($og->returningGoods->created_at)) }}<br>
                                                    {{ date('H:i:s', strtotime($og->returningGoods->created_at)) }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            
                                            <td class="text-xs font-weight-bold mb-0 text-center">
                                                @if ($og->has('returningGoods') && $og->returningGoods->is_active)
                                                    {{ getDuration($og->created_at, $og->returningGoods->created_at) }} Jam
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-xs font-weight-bold mb-0 text-end">
                                                @if ($og->has('returningGoods') && $og->returningGoods->is_active)
                                                    Rp. {{ number_format($og->returningGoods->total_price, 0, ',', '.') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-xs font-weight-bold mb-0">
                                                <ul>
                                                    @foreach ($og->products as $product)
                                                        <li>{{$product->name}}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td class="text-xs font-weight-bold mb-0">
                                                @if ($og->has('returningGoods'))
                                                    @if ($og->returningGoods->is_active)
                                                        <span class="badge badge-sm bg-gradient-info">
                                                            Proses
                                                        </span>
                                                    @else
                                                        <span class="badge badge-sm bg-gradient-success">
                                                            Selesai
                                                        </span>
                                                    @endif
                                                    
                                                @else
                                                    <span class="badge badge-sm bg-gradient-info">-</span>
                                                @endif
                                            </td>
                                            <td class="text-xs font-weight-bold mb-0">
                                                {{-- <a href="{{ route('logistic.detail', ['id' => $og->id]) }}"
                                                    class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                    data-original-title="Edit user"> --}}
                                                    <i class=" fas fa-eye text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Lihat Detail"></i>
                                                {{-- </a> --}}
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
                            {{-- <form id="productionForm" method="POST" action="{{ route('production.create') }}">
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
                                    <input id="material_count" type="number" name="material_count" value="0" hidden>
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
                            </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional: Place to the bottom of scripts -->
    <script>
        $(document).ready(function() {
            $('#tableLogistic').DataTable({
                // dom: 'Bfrtip',
                // buttons: [
                //     'copy', 'csv', 'excel', 'pdf', 'print'
                // ]
            });
        });

        // const myModal = new bootstrap.Modal(document.getElementById('modalProduction'), options)
        // Function to add a new material row
        // function addMaterialRow() {
        //     const materialRow = `
    //         <div class="row material">
    //             <div class="col mb-1">
    //                 <div class="form-group">
    //                     <label for="material_id">Bahan Baku:</label>
    //                     <select class="form-control" name="materials[id][]" required>
    //                         <option value=""  selected disabled hidden>Pilih Bahan Baku</option>
    //                     </select>
    //                 </div>
    //             </div>
    //             <div class="col mb-1">
    //                 <label class="form-label" for="quantity_used">Jumlah:</label>
    //                 <input class="form-control" type="number" name="materials[quantity_used][]" required>
    //             </div>
    //             <div class="col mb-1">
    //                 <label class="form-label" for="estimated_cost">Estimasi Biaya:</label>
    //                 <input class="form-control" type="number" name="materials[estimated_cost][]" required>
    //             </div>
    //             <div class="col-1 mb-1">
    //                 <button class="removeMaterial btn btn-danger mt-3 p-3" onclick="removeMaterialRow(event)" type="button"><i class="fa fa-trash"></i></button>
    //             </div>
    //         </div>
    //     `;
        //     updateMaterialCount(1);
        //     let count = $('#material_count').val();
        //     console.log(count);
        //     $("#materials").append(materialRow);
        // }

        // Function to remove a material row
        function removeMaterialRow(event) {
            $(event.target).closest(".material").remove();
            updateMaterialCount(-1);
            let count = $('#material_count').val();
            console.log(count);
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
    </script>

    @include('layouts.footers.auth.footer')
    </div>
@endsection
