@extends('customer.layouts.master')

@section('content')
<section class="d-flex flex-column justify-content-center align-items-center" data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/customer/index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/customer/kamar/kamar') }}">Kamar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $kamar->nama_barang }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 mt-1">
                <div class="card">
                    <div class="card-header text-center text-uppercase">
                        <h1>{{ $kamar->nama_barang }}</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ url('gbrkamar') }}/{{ $kamar->gbrkamar }}" class="rounded mx-auto d-block" width="100%" alt="">
                            </div>
                            <div class="col-md-6 mt-3">
                                <table class="table text-justify">
                                    <form action="{{ url('/customer/kamar/detailkamar') }}/{{ $kamar->id }}" method="post">
                                        <tbody>
                                            <tr>
                                                <td>Harga</td>
                                                <td>:</td>
                                                <td>Rp. {{ number_format($kamar->harga) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Booking</td>
                                                <td>:</td>
                                                <td>{{ $kamar->booking }} </td>
                                            </tr>
                                            <tr>
                                                <td>Deskripsi</td>
                                                <td>:</td>
                                                <td>{{ $kamar->deskripsi }}</td>
                                            </tr>
                                            <tr>
                                                <td>Check in </td>
                                                <td>:</td>
                                                <td><input class="form-control" type="date" name="check_in" id="check_in"></td>
                                            </tr>
                                            <tr>
                                                <td>Check out :</td>
                                                <td>:</td>
                                                <td><input class="form-control" type="date" name="check_out" id="check_out"></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary mt-2"><i class="fa fa-shopping-cart"></i> Sewa Sekarang</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </form>
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