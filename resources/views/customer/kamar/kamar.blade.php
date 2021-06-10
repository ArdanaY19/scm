@extends('customer.layouts.master')

@section('content')
<section class="d-flex flex-column justify-content-center align-items-center" data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/customer/index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kamar</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 mb-2 mt-2">
                <h1 class="text-center font-weight-bold">KAMAR</h1>
            </div>
            @foreach($kamars as $kamar)
            <div class="col-md-4 mb-4 mt-2">
                <div class="card" style="width: 22rem;">
                    <img class="card-img-top" src="{{ url('gbrkamar') }}/{{ $kamar->gbrkamar }}" width="100" height="250" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-capitalize">{{ $kamar->nama_barang }}</h5>
                        <p class="card-text text-justify">
                            <strong>Harga :</strong> Rp. {{ number_format($kamar->harga) }} <br>
                            <strong>booking :</strong> {{ $kamar->booking }} <br>
                        </p>
                        <a href="{{ url('/customer/kamar/detailkamar') }}/{{ $kamar->id }}" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section><!-- End Hero -->
@endsection