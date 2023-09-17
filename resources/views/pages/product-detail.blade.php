@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Produk Detail'])
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <div class="container-fluid py-4">


        @include('layouts.footers.auth.footer')
    </div>
@endsection
