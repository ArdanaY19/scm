@extends('layouts.master')

@section('content')
<section class="d-flex flex-column justify-content-center align-items-center" data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/manager/index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Katalog</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 mb-2 mt-2">
                <h1 class="text-center font-weight-bold">KATALOG</h1>
            </div>
            @foreach($katalogs as $katalog)
            <div class="col-md-4 mb-4 mt-2">
                <div class="card" style="width: 22rem;">
                    <img class="card-img-top" src="{{ url('gambar') }}/{{ $katalog->gambar }}" width="100" height="250" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-capitalize">{{ $katalog->nama_barang }}</h5>
                        <p class="card-text text-justify">
                            <strong>Harga :</strong> Rp. {{ number_format($katalog->harga) }} <br>
                            <strong>Stok :</strong> {{ number_format($katalog->stok) }} pcs <br>
                        </p>
                        <a href="{{ url('/manager/katalog/detailkatalog') }}/{{ $katalog->id }}" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section><!-- End Hero -->
@endsection