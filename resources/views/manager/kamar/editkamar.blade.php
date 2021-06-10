@extends('layouts.master')

@section('content')
<section class="d-flex flex-column justify-content-center align-items-center" data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-3">
                <div class="col-md-12 mt-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/manager/kamar/kamar') }}">Kamar</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Kamar</li>
                        </ol>
                    </nav>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Edit Kamar') }}</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/manager/kamar/kamar') }}/{{ $kamars->id }}" enctype="multipart/form-data" name="form" onsubmit="return validateForm()">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="">Nama Kamar</label>
                                <input type="text" name="nama_barang" id="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" value="{{ $kamars->nama_barang }}" autocomplete="nama_barang" autofocus>
                                @error('nama_barang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Harga Kamar</label>
                                <input type="number" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ $kamars->harga }}" autocomplete="harga" autofocus>
                                @error('harga')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Booking</label>
                                <input type="text" name="booking" id="booking" class="form-control @error('booking') is-invalid @enderror" value="{{ $kamars->booking }}" autocomplete="booking" autofocus>
                                @error('booking')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Deskripsi Kamar</label>
                                <textarea type="text" name="deskripsi" id="deskripsi" cols="83" rows="5" class="form-control @error('deskripsi') is-invalid @enderror" autocomplete="deskripsi" autofocus>{{ $kamars->deskripsi }}</textarea>
                                @error('deskripsi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Foto Kamar</label>
                                <input id="gbrkamar" type="file" class="form-control @error('gbrkamar') is-invalid @enderror" name="gbrkamar" value="{{ url('gbrkamar') }}/{{ $kamars->gbrkamar }}" autocomplete="gbrkamar" autofocus>
                                @error('gbrkamar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <img src="{{ url('gbrkamar') }}/{{ $kamars->gbrkamar }}" width="50%" alt="">
                            </div>

                            <div class="form-group mt-3">
                                <a href="/manager/kamar/kamar" class="btn btn-danger">Batal</a>
                                <button type="submit" class="btn btn-primary">Ubah Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Hero -->
@endsection