@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Produk Detail'])
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/jQuery_dataTables_1.13.6.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/jQuery_dataTables_1.13.6.min.css') }}" />
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col text-start">
                <button type="button" class="btn btn-info btn-sm"><i class="fa fa-pencil fa-sm"></i> Edit</button>
            </div>
            <div class="col text-end">
                <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-cross fa-sm"></i> Nonaktifkan</button>
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
                                <p class="card-text">Est. Rp. {{ $product->price * $product->stock }}</p>
                            </div>
                            <div class="col text-end">
                                <p class="card-text">{{ $product->stock . ' Kg'}}</p>
                                <p class="card-text">Rp. {{ $product->price . '/Kg'}}</p>
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
                                            <td class="text-center">{{ $production->quantity_produced }}</td>
                                            <td class="text-center">Rp. {{ $production->estimated_cost }}</td>
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
        <script>
            $(document).ready(function() {
                $('#productionTable').DataTable();
                // $('#salesTaketable').DataTable({
                //     "pageLength": 5
                // });
            });
        </script>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
