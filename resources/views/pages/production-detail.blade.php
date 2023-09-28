@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', [
        'title' => 'Detail Produksi',
        'parents' => [['href' => route('production'), 'title' => 'Produksi']],
    ])
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/jQuery_dataTables_1.13.6.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/jquery.datetimepicker.full.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/jQuery_dataTables_1.13.6.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.datetimepicker.min.css') }}" />
    <div id="prod_id" value="{{ $production->id }}"></div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-2 text-start">
                @if ($production->is_active)
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalId">
                        Selesaikan
                    </button>
                @else
                    <button type="button" class="btn btn-success btn-sm">Selesai</button>
                @endif
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
            <div class="row">
                <div class="col">
                    <div class="card border border-primary shadow-0 ">
                        <div class="card-header pb-1 mb-1">
                            <h5>Detail - {{ $production->code }}</h5>
                        </div>
                        <div class="card-body pt-1 mt-1">
                            <div class="row">
                                <div class="col-5">
                                    <h3>{{ $production->product->name }}</h3>
                                    <hr class="hr">
                                    <div class="row">
                                        <div class="col-6">
                                            @if (!$production->is_active)
                                                <span class="badge bg-success">{{ number_format($production->period, 1) }}
                                                    Jam</span>
                                            @else
                                                <span class="badge bg-primary">- Jam</span>
                                            @endif
                                        </div>
                                        <div class="col-6">
                                            <p class="">{{ $production->created_at->format('D, d-m-Y H:i') }}</p>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row text-center">
                                        <div class="col-6">Estimasi Harga</div>
                                        <div class="col-6">Hasil Produksi</div>
                                    </div>
                                    <div class="row text-center">
                                        @if (!$production->is_active)
                                            <div class="col-6">Rp.
                                                {{ number_format($production->estimated_cost, 0, '.', '.') }}
                                            </div>
                                            <div class="col-6">{{ $production->quantity_produced }} Kg</div>
                                        @else
                                            <div class="col-6">Rp. -
                                            </div>
                                            <div class="col-6">- Kg</div>
                                        @endif
                                    </div>
                                    <hr class="hr">
                                    <span class="card-text">{{ $production->description }}</span>
                                </div>
                                <div class="col-7">
                                    <div class="card border border-primary shadow-0 ">
                                        <div class="card-body">
                                            <h5 class="card-title">Bahan Baku</h5>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Kode</th>
                                                            <th scope="col">Bahan Baku</th>
                                                            <th scope="col">Jumlah</th>
                                                            <th scope="col">Biaya</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $total_cost = 0; // Initialize the total_cost variable
                                                        @endphp
                                                        @foreach ($production->detail as $detail)
                                                            @php
                                                                $line_cost = $detail->rawMaterial->price * $detail->quantity_used;
                                                                $total_cost += $line_cost;
                                                            @endphp
                                                            <tr>
                                                                <td class="text-center">{{ $loop->iteration }}</th>
                                                                <td class="text-center">{{ $detail->rawMaterial->code }}</td>
                                                                <td class="text-center">{{ $detail->rawMaterial->name }}</td>
                                                                <td class="text-center">{{ $detail->quantity_used . ' ' . $detail->rawMaterial->unit }}
                                                                </td>
                                                                <td class="text-end">Rp.
                                                                    {{ number_format($detail->rawMaterial->price * $detail->quantity_used, 0, '.', '.') }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="4" class="text-end">Total</th>
                                                            <th>Rp.
                                                                {{ number_format($total_cost, 0, '.', '.') }}</th>
                                                        </tr>
                                                    </tfoot>
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
            <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
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
                                                            name="completed_at" data-sb-validations="required" required autocomplete="false"/>
                                                        <div class="invalid-feedback" data-sb-feedback="name:required">
                                                        </div>
                                                    </div>
                                                    <div class="mb-1">
                                                        <label class="form-label" for="name">Estimasi Harga</label>
                                                        <input class="form-control" id="estimated_cost"
                                                            name="estimated_cost" type="number"
                                                            placeholder="Estimasi Harga" data-sb-validations="required"
                                                            required />
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
            </div>






            <script>
                $(document).ready(function() {
                    // $('#productionTable').DataTable();
                    // $('#salesTaketable').DataTable({
                    //     "pageLength": 5
                    // });
                    $('.datetimepicker').datetimepicker({
                        format: 'Y-m-d H:i:s', // Your desired format
                        step: 1, // Optional: specify the time increment (1 second in this case)
                    });
                    $("#alert-alert").fadeTo(4000, 500).slideUp(500, function() {
                        $("#alert-alert").alert('close');
                    });
                });

                // function showConfirmation() {
                //     var prod_url = "{{ route('production.finish', ['id' => $production->id]) }}";
                //     var csrfToken = $('meta[name="csrf-token"]').attr('content');
                //     Swal.fire({
                //         title: 'Selesaikan Produksi?',
                //         text: 'Produksi akan dianggap selesai dan tidak dapat diubah kembali',
                //         icon: 'warning',
                //         showCancelButton: true,
                //         confirmButtonText: 'Yes, Selesaikan!',
                //         cancelButtonText: 'No, Batalkan!',
                //     }).then((result) => {
                //         if (result.isConfirmed) {
                //             $.ajax({
                //                 type: "POST",
                //                 url: prod_url,
                //                 data: {
                //                     _token: csrfToken,
                //                 },
                //                 success: function(data, status) {
                //                     console.log(data);
                //                     console.log(status);
                //                     Swal.fire('Selesai!', 'Produksi telah selesai!', 'success');
                //                     location.reload();
                //                 },
                //                 error: function(xhr, status, error) {
                //                     console.error(xhr.responseText);
                //                     Swal.fire('Error', 'An error occurred while deactivating your item.',
                //                         'error');
                //                     location.reload();
                //                 }
                //             });
                //             // Swal.fire('Nonaktifkan!', 'Your item has been deactivated.', 'success');
                //         } else if (result.dismiss === Swal.DismissReason.cancel) {
                //             Swal.fire('Cancelled', 'Produksi masih aktif.', 'error');
                //         }
                //     });
                // }
            </script>
            @include('layouts.footers.auth.footer')
        </div>
    @endsection
