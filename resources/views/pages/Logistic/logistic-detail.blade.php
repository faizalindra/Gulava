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
            <div class="col-4 text-start">
                @if (!$outgoingGoods->returningGoods)
                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                        data-bs-target="#editLogisticModal"><i class="fa fa-pencil fa-sm"></i> Edit</button>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                        data-bs-target="#finishLogisticModal"><i class="fa-solid fa-list-check"></i> Finish</button>
                @endif

            </div>
            <div class="col-4 text-center">
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
            </div>
            @if (!$outgoingGoods->returningGoods)
                <div class="col-4 text-end">
                    <a href="{{ route('logistic.print', ['id' => $outgoingGoods->id, 'type' => 'surat-jalan']) }}"
                        target="_blank" class="btn btn-success btn-sm"><i class="fa fa-print fa-sm"></i> Print</a>
                </div>
            @endif
        </div>

        {{-- Card Logistic Returing Goods --}}
        @if ($outgoingGoods->returningGoods)
            <div class="row justify-content-end">
                <div class="col-4 text-end">
                    <a href="{{ route('logistic.print', ['id' => $outgoingGoods->returningGoods->id, 'type' => 'surat-jalan']) }}"
                        target="_blank" class="btn btn-success btn-sm"><i class="fa fa-print fa-sm"></i> Print</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row text-center text-dark">
                                <h4><u>LAPORAN PERJALANAN</u></h4>
                            </div>
                            <div class="row justify-content-between">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-4">Kode</div>
                                        <div class="col-8">: {{ $outgoingGoods->returningGoods->code }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">Kode Surat</div>
                                        <div class="col-8">: {{ $outgoingGoods->code }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">Sales</div>
                                        <div class="col-8">: {{ $outgoingGoods->salesperson->name }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">Durasi</div>
                                        <div class="col-8">:
                                            @php
                                                $start = Carbon\Carbon::parse($outgoingGoods->created_at);
                                                $end = Carbon\Carbon::parse($outgoingGoods->returningGoods->created_at);
                                                $diff = $start->diffInHours($end);
                                                echo $diff;
                                            @endphp
                                            Jam
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="row">
                                        <div class="col-4">Tanggal</div>
                                        <div class="col-8">:
                                            {{ $outgoingGoods->returningGoods->created_at->format('Y-d-m H:i') }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">Telp</div>
                                        <div class="col-8">:
                                            {{ $outgoingGoods->salesperson->phone }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-4">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="table-light">
                                            <tr class="text-center">
                                                <th rowspan="2" scope="col">No</th>
                                                <th rowspan="2" scope="col">Nama Produk</th>
                                                <th rowspan="2" scope="col">Kode/SKU</th>
                                                <th colspan="3" scope="col">Sales</th>
                                                <th rowspan="3" scope="col">Harga</th>
                                                <th rowspan="3" scope="col">Total Harga</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Awal</th>
                                                <th scope="col">Akhir</th>
                                                <th scope="col">Sisa</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($outgoingGoods->returningGoods->products as $product)
                                                <tr>
                                                    <td scope="row">{{ $loop->iteration }}</td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->code }}</td>
                                                    <td class="text-end">
                                                        {{ $outgoingGoods->products[$loop->iteration - 1]->pivot->quantity }}
                                                        Kg</td>
                                                    <td class="text-end">{{ $product->pivot->quantity }} Kg</td>
                                                    <td class="text-end">
                                                        {{ $product->pivot->quantity - $product->pivot->quantity }} Kg</td>
                                                    <td class="text-end">Rp.
                                                        {{ number_format($product->pivot->price, 0, '.', '.') }}</td>
                                                    <td class="text-end">Rp.
                                                        {{ number_format($product->pivot->total_price, 0, '.', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="th" scope="row" aria-colspan="5">
                                            <tr>
                                                <td colspan="7" class="text-end">Sub-Total</td>
                                                <td class="text-end">Rp.
                                                    {{ number_format($outgoingGoods->total_price, 0, '.', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" class="text-end">Sales Fee</td>
                                                <td class="text-end">Rp. -
                                                    {{ number_format($outgoingGoods->returningGoods->salesFee->price, 0, '.', '.') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" class="text-end">Total</td>
                                                <td class="text-end text-bold text-dark">Rp.
                                                    {{ number_format($outgoingGoods->returningGoods->total_amount - $outgoingGoods->returningGoods->salesFee->price, 0, '.', '.') }}
                                                </td>
                                            </tr>
                                        </tfoot>
                                        <caption>Catatan : {{ $outgoingGoods->returningGoods->description }}</caption>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($outgoingGoods->returningGoods)
            <div class="row justify-content-end pt-3 mt-3">
                <div class="col-4 text-end">
                    <a href="{{ route('logistic.print', ['id' => $outgoingGoods->id, 'type' => 'surat-jalan']) }}"
                        target="_blank" class="btn btn-success btn-sm"><i class="fa fa-print fa-sm"></i> Print</a>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row text-center text-dark">
                            <h4><u>SURAT JALAN</u></h4>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-4">Kode</div>
                                    <div class="col-8">: {{ $outgoingGoods->code }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-4">Sales</div>
                                    <div class="col-8">: {{ $outgoingGoods->salesperson->name }}</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-4">Tanggal</div>
                                    <div class="col-8">: {{ $outgoingGoods->created_at->format('Y-d-m H:i') }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-4">Telp</div>
                                    <div class="col-8">: {{ $outgoingGoods->salesperson->phone }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-4">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Produk</th>
                                            {{-- <th scope="col">Deskripsi</th> --}}
                                            <th scope="col">Kode/SKU</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($outgoingGoods->products as $product)
                                            <tr>
                                                <td scope="row">{{ $loop->iteration }}</td>
                                                <td>{{ $product->name }}</td>
                                                {{-- <td>{{ $product->description }}</td> --}}
                                                <td>{{ $product->code }}</td>
                                                <td class="text-end">{{ $product->pivot->quantity }} Kg</td>
                                                <td class="text-end">Rp.
                                                    {{ number_format($product->pivot->price, 0, '.', '.') }}</td>
                                                <td class="text-end">Rp.
                                                    {{ number_format($product->pivot->total_price, 0, '.', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="th" scope="row" aria-colspan="5">
                                        <tr>
                                            <td colspan="5" class="text-end">Total</td>
                                            <td class="text-end">Rp.
                                                {{ number_format($outgoingGoods->total_price, 0, '.', '.') }}</td>
                                        </tr>
                                    </tfoot>
                                    <caption>Catatan : {{ $outgoingGoods->description }}</caption>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8"></div>
                            <div class="col-4 text-center">
                                <span class="text-bold">Pengirim</span>
                                <br> <br> <br>
                                <span
                                    class="text-bold text-underline">{{ $outgoingGoods->user->firstname . ' ' . $outgoingGoods->user->lastname }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form --}}
        @if (!$outgoingGoods->returningGoods)
            {{-- Form Edit Logistic --}}
            <div class="modal fade" id="editLogisticModal" tabindex="-1" role="dialog"
                aria-labelledby="editProdukModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProdukModalLabel">Edit Logistik </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="text-dark">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="container">
                                        <form id="logisticForm" method="post"
                                            action="{{ route('logistic.update', ['id' => $outgoingGoods->id]) }}">
                                            @csrf
                                            @method('put')
                                            <div class="col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="salesperson_id">Sales</label>
                                                    <select class="form-control" id="salesperson_id"
                                                        name="salesperson_id"
                                                        value="{{ $outgoingGoods->salespersons_id }}" required>
                                                        @foreach ($salesperson as $sales)
                                                            <option value="{{ intval($sales->id) }}"
                                                                {{ $outgoingGoods->salespersons_id == $sales->id ? 'selected' : '' }}>
                                                                {{ $sales->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col mb-1">
                                                <label class="form-label" for="total_price">Jumlah (Rp.) :</label>
                                                <input class="form-control" type="number" name="total_price"
                                                    value="{{ $outgoingGoods->total_price }}" id="total_price" readonly>
                                            </div>
                                            <div class="mb-1 mb-2">
                                                <label class="form-label" for="description">Deskripsi</label>
                                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Deskripsi">{{ $outgoingGoods->description }}</textarea>
                                            </div>
                                            <input id="product_count" type="number" name="product_count"
                                                value="{{ count($outgoingGoods->products) }}" hidden>
                                            <div id="products">
                                                @foreach ($outgoingGoods->products as $product)
                                                    <div class="row logistic">
                                                        <div class="col mb-1">
                                                            <div class="form-group">
                                                                <label for="logistic_id">Produk:</label>
                                                                <select class="form-control" name="products[product_id][]"
                                                                    required>
                                                                    <option value="" selected disabled hidden>Pilih
                                                                        Produk</option>
                                                                    @foreach ($products as $p)
                                                                        <option value="{{ intval($p->id) }}"
                                                                            data-price="{{ $p->price }}"
                                                                            {{ $p->id == $product->id ? 'selected' : '' }}>
                                                                            {{ $p->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col mb-1">
                                                            <label class="form-label" for="quantity_used">Jumlah:</label>
                                                            <input class="form-control" type="number"
                                                                value="{{ $product->pivot->quantity }}"
                                                                name="products[quantity][]" required>
                                                        </div>
                                                        <div class="col mb-1">
                                                            <label class="form-label" for="price">Harga
                                                                Satuan:</label>
                                                            <input class="form-control" type="number"
                                                                value="{{ $product->pivot->price }}"
                                                                name="products[price][]" required>
                                                        </div>
                                                        <div class="col mb-1">
                                                            <label class="form-label" for="total_price">Total
                                                                Harga:</label>
                                                            <input class="form-control" type="number"
                                                                value="{{ $product->pivot->total_price }}"
                                                                name="products[total_price][]" readonly>
                                                        </div>
                                                        <div class="col-1 mb-1">
                                                            <button class="removeLogistic btn btn-danger mt-3 p-3"
                                                                onclick="removeLogisticRow(event)" type="button"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button id="addLogistic" onclick="addLogisticRow()" type="button"
                                                class="btn btn-primary">Add
                                                Bahan Baku</button>
                                            <div class="col-6"></div>
                                            <div class="d-grid pt-4 modal-footer">
                                                <div class="row">
                                                    <div class="col"><button class="btn btn-secondary btn-lg"
                                                            type="button" data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                    <div class="col"><button class="btn btn-primary btn-lg"
                                                            id="submit" type="submit">Submit</button></div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form Finish Logistic --}}
            <div class="modal fade" id="finishLogisticModal" tabindex="-1" role="dialog"
                aria-labelledby="editProdukModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
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
                                        <form id="logisticForm" method="post"
                                            action="{{ route('logistic.finish', ['id' => $outgoingGoods->id]) }}">
                                            @csrf
                                            @method('post')
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row">
                                                        <h6><b>{{ $outgoingGoods->salesperson->name }}</b></h6>
                                                    </div>
                                                    <div class="row">
                                                        <h6><b>Rp.
                                                                {{ number_format($outgoingGoods->total_price, 0, '.', '.') }}</b>
                                                        </h6>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-2"><b>Catatan</b></div>
                                                        <div class="col-8"><b>: {{ $outgoingGoods->description }}</b>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="table-responsive">
                                                                <table class="table table-sm table-bordered">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th scope="col">Nama</th>
                                                                            <th scope="col">Jumlah</th>
                                                                            <th scope="col">Harga</th>
                                                                            <th scope="col">Total Harga</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($outgoingGoods->products as $product)
                                                                            <tr>
                                                                                <td>{{ $product->name }}</td>
                                                                                <td class="text-end">
                                                                                    {{ $product->pivot->quantity }}
                                                                                    Kg</td>
                                                                                <td class="text-end">Rp.
                                                                                    {{ number_format($product->pivot->price, 0, '.', '.') }}
                                                                                </td>
                                                                                <td class="text-end">Rp.
                                                                                    {{ number_format($product->pivot->total_price, 0, '.', '.') }}
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                    <tfoot class="th" scope="row">
                                                                        <tr>
                                                                            <td colspan="3" class="text-end">
                                                                                Total</td>
                                                                            <td class="text-end">Rp.
                                                                                {{ number_format($outgoingGoods->total_price, 0, '.', '.') }}
                                                                            </td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="col mb-1">
                                                        <label class="form-label" for="total_price">Jumlah (Rp.) :</label>
                                                        <input class="form-control" type="number" name="total_price_"
                                                            value="{{ $outgoingGoods->total_price }}" id="total_price_"
                                                            readonly>
                                                    </div>
                                                    <div class="col mb-1">
                                                        <label class="form-label" for="sales_fee_">Sales Fee (Rp.) :</label>
                                                        <input class="form-control" type="number"
                                                            value="{{ ceil($outgoingGoods->total_price * 0.1) }}" min="0"
                                                            name="sales_fee_" id="sales_fee__">
                                                    </div>
                                                    <div class="mb-1 mb-2">
                                                        <label class="form-label" for="description">Deskripsi :</label>
                                                        <textarea class="form-control" id="description" name="description_" rows="2" placeholder="Deskripsi"></textarea>
                                                    </div>
                                                    <div id="products_">
                                                        @foreach ($outgoingGoods->products as $produk)
                                                            {{-- @dd($produk->toArray()) --}}
                                                            <div class="row logistic_">
                                                                <input type="number" name="produk_id_"
                                                                    value="{{ $produk->id }}" hidden>
                                                                <input type="number" name="price_"
                                                                    value="{{ $produk->pivot->price }}" hidden>
                                                                <div class="col mb-1">
                                                                    <label class="form-label"
                                                                        for="products_[name][]">Produk :</label>
                                                                    <input class="form-control" type="text"
                                                                        value="{{ $produk->name }}"
                                                                        name="products_[name][]" id="name" readonly>
                                                                </div>
                                                                <input class="form-control" type="number"
                                                                    value="{{ $produk->pivot->price }}"
                                                                    name="products_[price][]" required hidden>
                                                                <div class="col mb-1">
                                                                    <label class="form-label"
                                                                        for="products[quantity][]">Jumlah (Kg) :</label>
                                                                    <input class="form-control" type="number"
                                                                        value="{{ $produk->pivot->quantity }}"
                                                                        max="{{ $produk->pivot->quantity }}"
                                                                        min="0"
                                                                        name="products_[quantity][]"id="quantity">
                                                                </div>
                                                                <div class="col mb-1">
                                                                    <label class="form-label"
                                                                        for="products_[total_price][]">Total Harga
                                                                        (Rp.):</label>
                                                                    <input class="form-control" type="number"
                                                                        value="{{ $produk->pivot->price * $produk->pivot->quantity }}"
                                                                        max="{{ $produk->pivot->price * $produk->pivot->quantity }}"
                                                                        min="0" name="products_[total_price][]"
                                                                        required readonly>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-grid pt-4 modal-footer">
                                                <div class="row">
                                                    <div class="col"><button class="btn btn-secondary btn-lg"
                                                            type="button" data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                    <div class="col"><button class="btn btn-primary btn-lg"
                                                            id="submit" type="submit">Submit</button></div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif


        <script>
            $(document).ready(function() {
                $('#productionTable').DataTable();
                $("#alert-alert").fadeTo(4000, 500).slideUp(500, function() {
                    $("#alert-alert").alert('close');
                });
            });
            $("#alert-alert").fadeTo(4000, 500).slideUp(500, function() {
                $("#alert-alert").alert('close');
            });

            // Attach event listeners to existing rows
            $("#products .logistic").each(function() {
                attachEventListenersToRow($(this));
            });

            $("#products_ .logistic_").each(function() {
                attachEventListenersToRow($(this));
            });

            function addLogisticRow() {
                const logisticRow = `
                      <div class="row logistic">
                          <div class="col mb-1">
                              <div class="form-group">
                                  <label for="logistic_id">Produk:</label>
                                  <select class="form-control" name="products[product_id][]" required>
                                      <option value="" selected disabled hidden>Pilih Produk</option>
                                      @foreach ($products as $product)
                                          <option value="{{ intval($product->id) }}" data-price="{{ $product->price }}">{{ $product->name }}
                                          </option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="col mb-1">
                              <label class="form-label" for="quantity_used">Jumlah:</label>
                              <input class="form-control" type="number" name="products[quantity][]" required>
                          </div>
                          <div class="col mb-1">
                              <label class="form-label" for="price">Harga Satuan:</label>
                              <input class="form-control" type="number" name="products[price][]" required>
                          </div>
                          <div class="col mb-1">
                              <label class="form-label" for="total_price">Total Harga:</label>
                              <input class="form-control" type="number" name="products[total_price][]"
                                  readonly>
                          </div>
                          <div class="col-1 mb-1">
                              <button class="removeLogistic btn btn-danger mt-3 p-3"
                                  onclick="removeLogisticRow(event)" type="button"><i
                                      class="fa fa-trash"></i></button>
                          </div>
                      </div>`;
                updateLogisticCount(1);
                let count = $('#product_count').val();
                console.log(count);
                $("#products").append(logisticRow);
                // Get the newly added row
                const newRow = $("#products .logistic").last();
                attachEventListenersToRow(newRow);
            }

            // Function to remove a logistic row
            function removeLogisticRow(event) {
                $(event.target).closest(".logistic").remove();
                updateLogisticCount(-1);
                let count = $('#product_count').val();
                updateTotalPrice();
                console.log(count);
            }

            function attachEventListenersToRow(row) {
                // Add event listeners for quantity and price fields in the new row
                row.find(
                    "input[name='products[quantity][]'], input[name='products[price][]'], input[name='products_[quantity][]'], input[name='products_[price][]']"
                    ).on("input", function() {
                    // Get quantity and price values from the current row
                    const quantity = parseFloat(row.find("input[name='products[quantity][]']").val()) || 0;
                    const quantity_ = parseFloat(row.find("input[name='products_[quantity][]']").val()) || 0;
                    const price = parseFloat(row.find("input[name='products[price][]']").val()) || 0;
                    const price_ = parseFloat(row.find("input[name='products_[price][]']").val()) || 0;

                    // Calculate the total price
                    const total = quantity * price;
                    const total_ = quantity_ * price_;

                    // Update the total price field in the current row
                    row.find("input[name='products[total_price][]']").val(total);
                    row.find("input[name='products_[total_price][]']").val(total_);
                    updateTotalPrice();
                });

                // Add event listener for the product selection dropdown
                row.find("select[name='products[product_id][]']").on("change", function() {
                    // Get the selected option
                    const selectedOption = $(this).find("option:selected");

                    // Get the data-price attribute value
                    const price = parseFloat(selectedOption.data("price")) || 0;

                    // Update the price input field with the selected price
                    row.find("input[name='products[price][]']").val(price);

                    // Calculate and update the total price
                    const quantity = parseFloat(row.find("input[name='products[quantity][]']").val()) || 0;
                    const total = quantity * price;
                    row.find("input[name='products[total_price][]']").val(total);
                    updateTotalPrice();
                });
            }

            function updateLogisticCount(change) {
                const logisticCountInput = $('#product_count');
                const currentCount = parseInt(logisticCountInput.val());
                const newCount = currentCount + change;

                // Ensure the count is not negative
                if (newCount >= 0) {
                    logisticCountInput.val(newCount);
                }
            }

            function updateTotalPrice() {
                let totalPrice = 0;
                let totalPrice_ = 0;

                // Iterate through all rows and sum up the total prices
                $("#products .logistic").each(function() {
                    const total = parseFloat($(this).find("input[name='products[total_price][]']").val()) || 0;
                    totalPrice += total;
                });
                $("#products_ .logistic_").each(function() {
                    const total_ = parseFloat($(this).find("input[name='products_[total_price][]']").val()) || 0;
                    totalPrice_ += total_;
                });

                // Update the "Jumlah" field with the calculated total price
                $("#total_price").val(totalPrice);
                $("#total_price_").val(totalPrice_);

                // Update the "Sales Fee" field with the calculated total price
                $("#sales_fee__").val(Math.ceil(parseInt($("#total_price_").val()) * 0.1));

            }
        </script>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
