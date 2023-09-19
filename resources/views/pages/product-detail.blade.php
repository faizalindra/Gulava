@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', [
        'title' => 'Produk Detail',
        'parents' => [['href' => route('product'), 'title' => 'Produk']],
    ])
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/jQuery_dataTables_1.13.6.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/jQuery_dataTables_1.13.6.min.css') }}" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2/dist/sweetalert2.all.min.js"
        integrity="sha256-Cci6HROOxRjlhukr+AVya7ZcZnNZkLzvB7ccH/5aDic=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2/dist/sweetalert2.min.css"
        integrity="sha256-VJuwjrIWHWsPSEvQV4DiPfnZi7axOaiWwKfXaJnR5tA=" crossorigin="anonymous">
    <div id="prod_id" value="{{ $product->id }}"></div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col text-start">
                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                    data-bs-target="#editProdukModal"><i class="fa fa-pencil fa-sm"></i> Edit</button>
            </div>
            <div class="col text-center">
                @if (session('success'))
                    <div id="product-alert" class="alert alert-success alert-dismissible fade show text-bold text-white"
                        role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div id="product-alert" class="alert alert-danger alert-dismissible fade show text-bold text-white"
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
            </div>
            <div class="col text-end">
                @if ($product->is_active)
                    <button type="button" class="btn btn-danger btn-sm" id="diableProductButton"
                        onclick="showConfirmation()">Nonaktifkan</button>
                @else
                    <button type="button" class="btn btn-success btn-sm" id="diableProductButton"
                        onclick="showConfirmation()">Aktifkan</button>
                @endif
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-5 mb-2 mt-2">
                <div class="card">
                    <img class="card-img-top w-auto d-flex" style="max-height: 300px" src="https://placehold.co/1920x1080"
                        alt="Title">
                    <div class="card-body p-2 m-2">
                        <div class="row">
                            <div class="col text-start">
                                <h4 class="card-title">
                                    <p class="card-title">{{ $product->code }} - {{ $product->name }}</p>
                                </h4>
                                <p class="card-text">Est. Rp. {{ number_format($product->price * $product->stock, 0,'.','.') }}</p>
                            </div>
                            <div class="col text-end">
                                <p class="card-text">{{ number_format($product->stock, 0,'.','.') . ' Kg' }}</p>
                                <p class="card-text">Rp. {{ number_format($product->price, 0,'.','.') . '/Kg' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-2 m-2">
                        <div class="horizontal dark mt-0"></div>
                        <div class="row">
                            <div class="col-12">
                                <p class="card-text">Deskripsi: {{ $product->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-7 mb-2 mt-2">
                <div class="card mb-4">
                    <div class="card-body">
                        <p class="card-title">
                        <h4>Sales history</h4>
                        </p>
                        <div>
                            <div class="table-responsive">
                                <table id="salesTaketable" class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Status</th>
                                            <th scope="col">Kode</th>
                                            <th scope="col">Sales</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Pendapatan</th>
                                            {{-- <th scope="col">Start</th> --}}
                                            {{-- <th scope="col">End</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="">
                                            <td scope="row">
                                                <div class="align-items-center justify-content-center"
                                                    style="color: #00ff33;">
                                                    <i class="far fa-check-circle fa-lg"></i> Success
                                                </div>
                                            </td>
                                            <td>SG001</td>
                                            <td>Sukirno</td>
                                            <td>150Kg</td>
                                            <td class="text-end">Rp. 1.500.000</td>
                                            {{-- <td>2023-09-10 12:00:00</td>
                                            <td>2023-09-11 09:00:00</td> --}}
                                        </tr>
                                        <tr class="">
                                            <td scope="row">
                                                <div class="align-items-center justify-content-center"
                                                    style="color: #00ff33;">
                                                    <i class="far fa-check-circle fa-lg"></i> Success
                                                </div>
                                            </td>
                                            <td>SG002</td>
                                            <td>Putri</td>
                                            <td>50Kg</td>
                                            <td class="text-end">Rp. 500.000</td>
                                            {{-- <td>2023-09-10 07:45:00</td>
                                            <td>2023-09-11 12:00:00</td> --}}
                                        </tr>
                                        <tr class="">
                                            <td scope="row">
                                                <div class="align-items-center justify-content-center"
                                                    style="color: #00ff33;">
                                                    <i class="far fa-check-circle fa-lg"></i> Success
                                                </div>
                                            </td>
                                            <td>SG003</td>
                                            <td>Mahroni</td>
                                            <td>300Kg</td>
                                            <td class="text-end">Rp. 3.000.000</td>
                                            {{-- <td>2023-09-10 10:13:00</td>
                                            <td>2023-09-10 12:04:00</td> --}}
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    {{-- <img class="card-img-top" src="holder.js/100x180/?text=Image cap" alt="Card image cap"> --}}
                    <div class="card-body">
                        <h4 class="card-title">Produksi</h4>
                    </div>
                    <div class="container">
                        <div class="table-responsive">
                            <table id="productionTable" class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">#</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Kode</th>
                                        <th scope="col">Total Produksi</th>
                                        <th scope="col">Estimasi Harga</th>
                                        <th scope="col">Start</th>
                                        <th scope="col">Selesai</th>
                                        {{-- <th scope="col">Deskripsi</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product->production as $production)
                                        <tr class="">
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>
                                                @if ($production->completed_at != null)
                                                    <div class="align-items-center justify-content-center"
                                                        style="color: #00ff33;"><i class="far fa-check-circle fa-lg"></i>
                                                        Success</div>
                                                @else
                                                    <div class="align-items-center justify-content-center"
                                                        style="color: #ffef42;"><i class="fa fa-cogs fa-lg"></i> Process
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $production->code }}</td>
                                            <td class="text-center">{{ number_format($production->quantity_produced, 0,'.','.') }}</td>
                                            <td class="text-center">Rp. {{ number_format($production->estimated_cost, 0,'.','.') }}</td>
                                            <td>{{ $production->created_at }}</td>
                                            <td>{{ $production->completed_at ?? '' }}</td>
                                            {{-- <td>{{ Str::limit($production->description, 15)}}</td> --}}
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Modal -->
        <div class="modal fade" id="editProdukModal" tabindex="-1" role="dialog"
            aria-labelledby="editProdukModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProdukModalLabel">Edit Produk </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-dark">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="container">
                                    <form id="produkForm" method="post"
                                        action="{{ route('produks.update', ['id' => $product->id]) }}">
                                        @csrf
                                        @method('post')
                                        <div class="col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="name">Nama</label>
                                                <input class="form-control" id="name" name="name" type="text"
                                                    placeholder="Nama" data-sb-validations="required"
                                                    value="{{ $product->name }}" required />
                                                <div class="invalid-feedback" data-sb-feedback="name:required">Nama is
                                                    required.
                                                </div>
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label" for="price">Harga Satuan</label>
                                                <input class="form-control" id="price" name="price" type="number"
                                                    placeholder="Harga Satuan (Rp.)" data-sb-validations="required"
                                                    value="{{ $product->price }}" required />
                                                <div class="invalid-feedback" data-sb-feedback="price:required">Harga
                                                    Satuan
                                                    is
                                                    required.</div>
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label" for="estimated_sales">Estimasi Total</label>
                                                <input class="form-control" id="estimated_sales" name="estimated_sales"
                                                    type="number" placeholder="Harga Satuan (Rp.)"
                                                    data-sb-validations="required"
                                                    value="{{ $product->estimated_sales }}" />
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label" for="stock">Stok</label>
                                                <input class="form-control" id="stock" name="stock" type="number"
                                                    value="0" placeholder="Stok Produk (Kg)"
                                                    data-sb-validations="required" value="{{ $product->stock }}"
                                                    required />
                                                <div class="invalid-feedback" data-sb-feedback="stock:required">Stok
                                                    Produk is
                                                    required.</div>
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label" for="grade">Grade</label>
                                                <select class="form-select" id="grade" name="grade"
                                                    aria-label="Grade" value="{{ $product->grade }}" required>
                                                    @foreach ($grades as $grade)
                                                        <option value="{{ $grade->name }}">{{ $grade->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-1">
                                                <label for="description" class="form-label">Deskripsi Produk</label>
                                                <textarea class="form-control" name="description" id="description" value={{ $product->description }}
                                                    rows="3"></textarea>
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

                        {{-- <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script> --}}
                    </div>
                </div> -->
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#productionTable').DataTable();
                // $('#salesTaketable').DataTable({
                //     "pageLength": 5
                // });
                $("#product-alert").fadeTo(4000, 500).slideUp(500, function() {
                    $("#product-alert").alert('close');
                });
            });

            function showConfirmation() {
                // prod_id = $('#prod_id').attr('date-value');
                var prod_url = "{{ route('produk.disable', ['id' => $product->id]) }}";
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                Swal.fire({
                    title: 'Nonaktifkan Produk?',
                    text: 'Produk akan dinonaktifkan dan tidak dapat digunakan untuk produksi.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Nonaktifkan!',
                    cancelButtonText: 'No, cancel!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: prod_url,
                            data: {
                                _token: csrfToken,
                            },
                            success: function(data, status) {
                                console.log(data);
                                console.log(status);
                                Swal.fire('Nonaktifkan!', 'Your item has been deactivated.', 'success');
                                location.reload();
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire('Error', 'An error occurred while deactivating your item.',
                                    'error');
                                location.reload();
                            }
                        });
                        // Swal.fire('Nonaktifkan!', 'Your item has been deactivated.', 'success');
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire('Cancelled', 'Your item is still active.', 'error');
                    }
                });
            }
        </script>
        @include('layouts.footers.auth.footer')
    </div>
    </div>
@endsection
