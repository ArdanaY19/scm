@extends('layouts.master')

@section('content')
<section class="d-flex flex-column justify-content-center align-items-center" data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/manager/index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/manager/katalog/katalog') }}">Katalog</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $katalog->nama_barang }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 mt-1">
                <div class="card">
                    <div class="card-header text-center text-uppercase">
                        <h1>{{ $katalog->nama_barang }}</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ url('gambar') }}/{{ $katalog->gambar }}" class="rounded mx-auto d-block" width="100%" alt="">
                            </div>
                            <div class="col-md-6 mt-3">
                                <table class="table text-justify">
                                    <tbody>
                                        <tr>
                                            <td>Harga</td>
                                            <td>:</td>
                                            <td>Rp. {{ number_format($katalog->harga) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Stok</td>
                                            <td>:</td>
                                            <td>{{ number_format($katalog->stok) }} pcs </td>
                                        </tr>
                                        <tr>
                                            <td>Deskripsi</td>
                                            <td>:</td>
                                            <td>{{ $katalog->deskripsi }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Pesan (dalam pcs)</td>
                                            <td>:</td>
                                            <td>
                                                <form action="{{ url('/manager/katalog/detailkatalog') }}/{{ $katalog->id }}" method="post">
                                                    @csrf
                                                    <input type="number" name="jumlah_pesan" class="form-control" required>
                                                    <button type="submit" class="btn btn-primary mt-2"><i class="fa fa-shopping-cart"></i> Masukkan Keranjang</button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Hero -->
@endsection