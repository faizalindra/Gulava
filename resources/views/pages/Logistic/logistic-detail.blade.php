@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', [
        'title' => 'Logistic Detail',
        'parents' => [['href' => route('logistic'), 'title' => 'Logistic']],
    ])
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/jQuery_dataTables_1.13.6.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/sweetalert2.all.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/jQuery_dataTables_1.13.6.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css') }}" />
    {{-- <div id="prod_id" value="{{ $product->id }}"></div> --}}
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col text-start">
                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                    data-bs-target="#editProdukModal"><i class="fa fa-pencil fa-sm"></i>Edit</button>
            </div>
            <div class="col text-center">
                
            </div>
            <div class="col text-end">
                {{-- @if ($product->is_active)
                    <button type="button" class="btn btn-danger btn-sm" id="diableProductButton"
                        onclick="showConfirmation('disable')">Nonaktifkan</button>
                @else
                    <button type="button" class="btn btn-success btn-sm" id="diableProductButton"
                        onclick="showConfirmation('enable')">Aktifkan</button>
                @endif --}}
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body"></div>
                </div>
            </div>
        </div>


        <!-- Form Modal -->
        <div class="modal fade" id="editProdukModal" tabindex="-1" role="dialog"
            aria-labelledby="editProdukModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProdukModalLabel">Selesaikan Logistik </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-dark">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="container">
                                    {{-- <form id="produkForm" method="post"
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
                                    </form> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
        </script>
        @include('layouts.footers.auth.footer')
    </div>
    </div>
@endsection
