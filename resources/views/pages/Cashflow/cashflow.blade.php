@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Cashflow'])
    <link rel="stylesheet" href="{{ asset('assets/css/jQuery_dataTables_1.13.6.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}" />

    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/jQuery_dataTables_1.13.6.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/core/select2.min.js') }}"></script> --}}


    <div class="container-fluid py-4">
        <div class="row align-items-center">
            {{-- <div class="col-3">
                <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div> --}}
            <div class="col-6">
                @if (session('success'))
                    <div id="rawMaterials-alert" class="alert alert-success alert-dismissible fade show text-bold text-white"
                        role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div id="rawMaterials-alert" class="alert alert-danger alert-dismissible fade show text-bold text-white"
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
                    $("#rawMaterials-alert").fadeTo(4000, 500).slideUp(500, function() {
                        $("#rawMaterials-alert").alert('close');
                    });
                </script>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h6>Saldo Kas</h6>
                        <h5 class="pt-1 pb-1"><b>Rp. {{ number_format($cash->balance, 0, '.', '.') }}</b></h5>
                        <span class="text-sm">Last Update : {{ $cash->updated_at }}</span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">Graph Cashflow</div>
                </div>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-6">
                <div class="row">
                    <div class="col">
                        <div class="col-3">
                        </div>
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <h6>Pemasukan</h6>
                                <button type="button" class="btn btn-sm bg-gradient-primary p-2" data-bs-toggle="modal"
                                    data-bs-target="#createModal" data-transaction-type="income">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table id="tablePemasukan" class="table table-sm align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7  text-center">
                                                    #</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Tanggal</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Kategori</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Jumlah</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Catatan</th>
                                                {{-- <th class="text-secondary opacity-7"></th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($incomes as $income)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ Carbon\Carbon::parse($income->created_at)->format('Y-m-d H:i') }}
                                                    </td>
                                                    <td>{{ $income->category->name }}</td>
                                                    <td>Rp. {{ number_format($income->amount, 0, '.', '.') }}</td>
                                                    <td>{{ $income->description }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h6>Kategori Pemasukan</h6>
                                <button type="button" class="btn btn-sm bg-gradient-primary p-2" data-bs-toggle="modal"
                                    data-bs-target="#createModalCategoryPemasukan">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="container">
                                    <div class="table-responsive-sm">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($incomeCategory as $category)
                                                    <tr>
                                                        <td>{{ $category->name }}</td>
                                                        <td class="text-end"> {{-- <a href="#" class="text-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal"> --}}
                                                            <i class="fas fa-trash"></i>
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
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col">
                        <div class="col-3">

                        </div>
                        <div class="card mb-4">
                            <div class="card-header pb-0 justify-content-between">
                                <h6>Pengeluaran</h6>
                                <button type="button" class="btn btn-sm bg-gradient-primary p-2" data-bs-toggle="modal"
                                    data-bs-target="#createModal" data-transaction-type="expense">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table id="tablePengeluaran" class="table table-sm align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7  text-center">
                                                    #</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Tanggal</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Kategori</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Jumlah</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Catatan</th>
                                                {{-- <th class="text-secondary opacity-7"></th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($expenses as $expense)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ Carbon\Carbon::parse($expense->created_at)->format('Y-m-d H:i') }}
                                                    </td>
                                                    <td>{{ $expense->category->name }}</td>
                                                    <td>Rp. {{ number_format($expense->amount, 0, '.', '.') }}</td>
                                                    <td>{{ $expense->description }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h6>Kategori Pengeluaran</h6>
                                <button type="button" class="btn btn-sm bg-gradient-primary p-2" data-bs-toggle="modal"
                                    data-bs-target="#createModalCategory">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="container">
                                    <div class="table-responsive-sm">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($expenseCategory as $category)
                                                    <tr>
                                                        <td>{{ $category->name }}</td>
                                                        <td class="text-end">
                                                            {{-- <a href="#" class="text-danger" data-bs-toggle="modal"
                                                                data-bs-target="#deleteModal"> --}}
                                                            <i class="fas fa-trash"></i>
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
            </div>

        </div>



        <!-- Modal Body-->
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalTitle">Cashflow</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-dark">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="createCashflow" method="POST" action="{{ route('cashflow.create') }}">
                            @csrf
                            @method('POST')

                            <!-- Hidden input field for transaction_type -->
                            <input type="hidden" name="type" id="transaction_type">

                            <div class="mb-3">
                                <label class="form-label" for="category_id">Kategori</label>
                                <select class="form-control" id="category_id" name="category_id">
                                    <option value="" selected disabled>Pilih Kategori</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="amount">Jumlah (Rp.)</label>
                                <input class="form-control" id="amount" name="amount" type="number" value=""
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Catatan</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <div class="d-grid pt-4">
                                <button class="btn btn-primary btn-lg" id="editSubmitButton"
                                    type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#tablePemasukan').DataTable();
            });
            $(document).ready(function() {
                $('#tablePengeluaran').DataTable();
            });

            $('#createModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var transactionType = button.data('transaction-type');
                var modal = $(this);
                var categorySelect = modal.find('select#category_id');

                // Set the transaction_type input value in the modal
                modal.find('input[name="type"]').val(transactionType);

                // Make an AJAX request to load categories based on transactionType
                $.ajax({
                    url: '/cashflow-category/' + transactionType,
                    method: 'GET',
                    success: function(data) {
                        // Clear existing options, excluding the placeholder option
                        categorySelect.find('option:not(:first-child)').remove();

                        // Populate select options with new categories
                        $.each(data, function(key, category) {
                            categorySelect.append('<option value="' + category.id + '">' + category
                                .name + '</option>');
                        });
                    },
                    error: function(error) {
                        console.log('Error loading categories: ' + error);
                    }
                });
            });
            // $('.select2').select2({
            //     width: '100%', // Set the width to 100% of its container
            //     dropdownCssClass: 'select2-dropdown-big', // Apply custom CSS class to the dropdown

            // });
        </script>

        @include('layouts.footers.auth.footer')
    </div>
@endsection
