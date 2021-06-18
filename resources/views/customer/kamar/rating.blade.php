@extends('customer.layouts.master')

@section('content')
<section class="d-flex flex-column justify-content-start align-items-center" style="min-height: 90vh;" data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/customer/index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/customer/kamar/kamar') }}">Kamar</a></li>
                        {{-- <li class="breadcrumb-item active" aria-current="page">{{ $kamar->nama_barang }}</li> --}}
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 mt-1">
 
                <div class="card mt-2">
                    <div class="card-body">
                        <h3><i class="fas fa-info-circle"></i> Ulasan</h3>
                        @php
                            $id=$id_transaksi;
                        @endphp
                        {{-- <p align="right">Tanggal Pesan : {{ $kamar_transactions->created_at }}</p> --}}
                        <form method="POST" action="/customer/kamar/rating/{{$id}}" name="form" onsubmit="return validateForm()">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="">Rating</label>
                                <input type="number" name="rating" id="rating" class="form-control @error('rating') is-invalid @enderror" value="{{ old('rating') }}" autocomplete="rating" autofocus>
                                @error('rating')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Ulasan</label>
                                <input type="text" name="Ulasan" id="Ulasan" class="form-control @error('Ulasan') is-invalid @enderror" value="{{ old('Ulasan') }}" autocomplete="Ulasan" autofocus>
                                @error('Ulasan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <a href="/customer/kamar/rating" class="btn btn-danger">Batal</a>
                                <button type="submit" class="btn btn-primary">Tambah Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Hero -->
@endsection