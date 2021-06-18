@extends('customer.layouts.master')

@section('content')
<section class="d-flex flex-column justify-content-start align-items-center" style="min-height: 90vh;" data-aos="fade-up">
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
            <div class="row d-flex justify-content-evenly ">
                @foreach($kamars as $kamar)
                <div class="col mb-4 mt-2 d-flex justify-content-center  ">
                    <div class="card" style="width: 22rem;">
                        <img class="card-img-top" src="{{ url('gbrkamar') }}/{{ $kamar->gbrkamar }}" width="100" height="250" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-capitalize">{{ $kamar->nama_barang }}</h5>
                            <p class="card-title text-capitalize">Deskripsi : {{ $kamar->deskripsi }}</p>
                            @php
                                $id = $kamar->id;
                                $kamar_transactions = \App\kamar_transaction::where('kamar_id',$id)->where('status',4)->get();
                                $counter = 0.0;
                                $rating = 0.0;
                                foreach ($kamar_transactions as $key => $kamar_transactions) {
                                    # code...
                                    $counter+=1;
                                    $rating+=$kamar_transactions->rating;
                                }
                                $ratarata = $rating/$counter;
                                // dd($ratarata);
                            @endphp
                            <p class="card-title text-capitalize">Rating : {{ $ratarata }}</p>
                            <p class="card-text text-justify">
                                <strong>Harga :</strong> Rp. {{ number_format($kamar->harga) }} <br>
                                {{-- <strong>booking :</strong> {{ $kamar->booking }} <br> --}}
                            </p>
                            <a href="{{ url('/customer/kamar/detailkamar') }}/{{ $kamar->id }}" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section><!-- End Hero -->
@endsection