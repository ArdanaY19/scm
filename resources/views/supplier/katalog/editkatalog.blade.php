@extends('supplier.layouts.master')

@section('content')
<section class="d-flex flex-column justify-content-center align-items-center" data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-3">
                <div class="col-md-12 mt-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/supplier/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/supplier/katalog/katalog') }}">Katalog</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Katalog</li>
                        </ol>
                    </nav>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Edit Katalog') }}</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/supplier/katalog/katalog') }}/{{ $katalogs->id }}" enctype="multipart/form-data" name="form" onsubmit="return validateForm()">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="">Nama Katalog</label>
                                <input type="text" name="nama_barang" id="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" value="{{ $katalogs->nama_barang }}" autocomplete="nama_barang" autofocus>
                                @error('nama_barang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Harga Katalog</label>
                                <input type="number" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ $katalogs->harga }}" autocomplete="harga" autofocus>
                                @error('harga')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Stok Katalog</label>
                                <input type="number" name="stok" id="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ $katalogs->stok }}" autocomplete="stok" autofocus>
                                @error('stok')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Deskripsi Katalog</label>
                                <textarea type="text" name="deskripsi" id="deskripsi" cols="83" rows="5" class="form-control @error('deskripsi') is-invalid @enderror" autocomplete="deskripsi" autofocus>{{ $katalogs->deskripsi }}</textarea>
                                @error('deskripsi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Foto Katalog</label>
                                <input id="gambar" type="file" class="form-control @error('gambar') is-invalid @enderror" name="gambar" value="{{ url('gambar') }}/{{ $katalogs->gambar }}" autocomplete="gambar" autofocus>
                                @error('gambar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <img src="{{ url('gambar') }}/{{ $katalogs->gambar }}" width="50%" alt="">
                            </div>

                            <div class="form-group mt-3">
                                <a href="/supplier/katalog/katalog" class="btn btn-danger">Batal</a>
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