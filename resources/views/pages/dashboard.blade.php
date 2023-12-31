@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Penjualan Bulan ini</p>
                                    <h5 class="font-weight-bolder">
                                        Rp. {{ number_format($sales['thisMonthSales'], 0, '.', '.') }}
                                    </h5>
                                    <p class="mb-0">
                                        @if ($sales['percentageChange'] > 0)
                                            <span class="text-success text-sm font-weight-bolder">
                                                <i class="fa fa-arrow-up"></i>
                                                {{ $sales['percentageChange'] }}%
                                            </span>
                                        @elseif ($sales['percentageChange'] == 0)
                                            <span class="text-warning text-sm font-weight-bolder">
                                                <i class="fa fa-arrow-right"></i>
                                                {{ $sales['percentageChange'] }}%
                                            </span>
                                        @else
                                            <span class="text-danger text-sm font-weight-bolder">
                                                <i class="fa fa-arrow-down"></i>
                                                {{ $sales['percentageChange'] }}%
                                            </span>
                                        @endif
                                        since last month
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Produksi Bulan ini</p>
                                    <h5 class="font-weight-bolder">
                                        {{ number_format($production['thisMonthProduction'], 0, '.', '.') }} Kg
                                    </h5>
                                    <p class="mb-0">
                                        @if ($production['percentageChange'] > 0)
                                            <span class="text-success text-sm font-weight-bolder">
                                                <i class="fa fa-arrow-up"></i>
                                                {{ $production['percentageChange'] }}%
                                            </span>
                                        @elseif ($production['percentageChange'] == 0)
                                            <span class="text-warning text-sm font-weight-bolder">
                                                <i class="fa fa-arrow-right"></i>
                                                {{ $production['percentageChange'] }}%
                                            </span>
                                        @else
                                            <span class="text-danger text-sm font-weight-bolder">
                                                <i class="fa fa-arrow-down"></i>
                                                {{ $production['percentageChange'] }}%
                                            </span>
                                        @endif
                                        since last month
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="fa-solid fa-scale-balanced text-lg opacity-10"></i>
                                    {{-- <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Bruto Bersih Bulan ini</p>
                                    <h5 class="font-weight-bolder">
                                        +3,462
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-danger text-sm font-weight-bolder">-2%</span>
                                        since last quarter
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Sales</p>
                                    <h5 class="font-weight-bolder">
                                        $103,430
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">+5%</span> than last month
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="row mt-4">
            {{-- <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Penjualan Bulan Ini</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-arrow-up text-success"></i>
                            <span class="font-weight-bold">4% more</span> in 2021
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!--
                                    <div class="col-lg-5">
                                        <div class="card card-carousel overflow-hidden h-100 p-0">
                                            <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                                                <div class="carousel-inner border-radius-lg h-100">
                                                    <div class="carousel-item h-100 active" style="background-image: url('./img/carousel-1.jpg');
            background-size: cover;">
                                                        <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                                            <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                                                <i class="ni ni-camera-compact text-dark opacity-10"></i>
                                                            </div>
                                                            <h5 class="text-white mb-1">Get started with Argon</h5>
                                                            <p>There’s nothing I really wanted to do in life that I wasn’t able to get good at.</p>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item h-100" style="background-image: url('./img/carousel-2.jpg');
            background-size: cover;">
                                                        <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                                            <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                                                <i class="ni ni-bulb-61 text-dark opacity-10"></i>
                                                            </div>
                                                            <h5 class="text-white mb-1">Faster way to create web pages</h5>
                                                            <p>That’s my skill. I’m not really specifically talented at anything except for the
                                                                ability to learn.</p>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item h-100" style="background-image: url('./img/carousel-3.jpg');
            background-size: cover;">
                                                        <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                                            <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                                                <i class="ni ni-trophy text-dark opacity-10"></i>
                                                            </div>
                                                            <h5 class="text-white mb-1">Share with us your design tips!</h5>
                                                            <p>Don’t be afraid to be wrong because you can’t learn anything from a compliment.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="carousel-control-prev w-5 me-3" type="button"
                                                    data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next w-5 me-3" type="button"
                                                    data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    -->
        </div>
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Top Sales</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center ">
                            <tbody>
                                @foreach ($topSales as $sales)
                                    <tr>
                                        <td class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">
                                                <div>
                                                    <i class="fa-solid fa-user fa-lg"></i>
                                                </div>
                                                <div class="ms-4">
                                                    <!-- <p class="text-xs font-weight-bold mb-0">Country:</p> -->
                                                    <h6 class="text-sm mb-0">{{ $sales->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Jalan:</p>
                                                <h6 class="text-sm mb-0">{{ $sales->count }}x</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Penjualan:</p>
                                                <h6 class="text-sm mb-0">Rp.
                                                    {{ number_format($sales->amount, 0, '.', '.') }}
                                                </h6>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Kategori Produk</h6>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group">
                            @foreach ($topProduks as $product)
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                            <i class="ni ni-mobile-button text-white opacity-10"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">{{ $product->name }}</h6>
                                            <span class="text-xs">{{ $product->stock }} in stock</span>
                                            <span class="text-xs">{{ $product->total_sold_quantity }} sold</span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button
                                            class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto">
                                            <a href="{{ route('produks.detail', ['id' => $product->id]) }}">
                                                <i class="ni ni-bold-right" aria-hidden="true"></i>
                                            </a>
                                        </button>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#fb6340",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
@endpush
