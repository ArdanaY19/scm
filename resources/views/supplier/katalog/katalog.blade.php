@extends('supplier.layouts.master')

@section('content')
<section class="d-flex flex-column justify-content-center align-items-center" data-aos="fade-up">
    <div class="container">
        <div class="row ">
            <div class="col-md-12 mt-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/supplier/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Katalog</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 mb-2 mt-2 mx-2">
                <h1 class="text-center font-weight-bold">KATALOG</h1>
                
            </div>
            <div class="row d-flex justify-content-evenly ">
                @foreach($katalogs as $katalog)
                    <div class="card mb-4 mt-2" style="width: 22rem;">
                        <img class="card-img-top" src="{{ url('gambar') }}/{{ $katalog->gambar }}" width="100" height="250" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-capitalize">{{ $katalog->nama_barang }}</h5>
                            <p class="card-text text-justify">
                                <strong>Harga :</strong> Rp. {{ number_format($katalog->harga) }} <br>
                                <strong>Stok :</strong> {{ number_format($katalog->stok) }} pcs <br>
                                <br>
                                
                                <strong>Supplier :</strong> {{ $katalog->username }}<br>
                                <strong>Deskripsi :</strong> <?php
                                                                echo substr_replace($katalog->deskripsi, "...", 300);
                                                                ?>
                            </p>
                            <a href="{{ url('/supplier/katalog/editkatalog') }}/{{ $katalog->id }}" class="btn btn-success btn-sm"><i class="fas fa-edit"> Ubah Data</i></a>
                            <form action="{{ url('/supplier/katalog/katalog') }}/{{ $katalog->id }}" method="post">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger btn-sm mt-2"><i class="fa fa-trash"> Delete</i></button>
                            </form>
                        </div>
                    </div>
                @endforeach
                <div class=" card col-md-4 mb-4 mt-2 mx-2" style="width: 22rem;">
                    <a class="d-flex card-body mb-4 mt-2 p-0 align-items-center justify-content-center" href="/supplier/katalog/buatkatalog" style="     height:100%;"><i class="fas fa-plus"></i> Tambah Data Katalog</a>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Hero -->
@endsection