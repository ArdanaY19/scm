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
                {{-- <div class="card">
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
                </div> --}}
                <div class="card mt-2">
                    <div class="card-body">
                        <h3><i class="fas fa-info-circle"></i> Keranjang</h3>
                        @if(!empty($kamar_transactions))
                        {{-- <p align="right">Tanggal Pesan : {{ $kamar_transactions->created_at }}</p> --}}
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kamar</th>
                                    <th>Nama user</th>
                                    <th>Check in</th>
                                    <th>Check Out</th>
                                    <th>Total Harga</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($kamar_transactions as $kamar_transactions)
                                <?php
                                $kamar = \App\kamar::findorfail($kamar_transactions->kamar_id);
                                ?>
                                
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{$kamar->nama_barang}}</td>
                                    {{-- <td class="text-capitalize">{{ $kamar->nama_barang}}</td> --}}
                                    <td>{{Auth::user()->username}}</td>
                                    <td>{{ $kamar_transactions->check_in }}</td>
                                    <td>{{ $kamar_transactions->check_out }}</td>
                                    <td>Rp.{{ number_format($kamar_transactions->harga) }}</td>
                                    <td class="d-flex">
                                        <a href="{{ url('/customer/kamar/detailpesanan') }}/{{ $kamar_transactions->id }}" class="btn btn-primary mx-2">Selesaikan Pembayaran</a>
                                        <form action="{{ url('/customer/kamar/hapuspesanan') }}/{{ $kamar_transactions->id }}" method="post">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger mx-2"><i class="fa fa-trash"> Delete</i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                {{-- <tr>
                                    <td colspan="5" align="right"><strong>Total Harga :</strong></td>
                                    <td " align="right"><strong>Rp. {{ number_format($kamar_transaction->jumlah_harga) }}</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="5" align="right"><strong>Kode Unik :</strong></td>
                                    <td " align="right"><strong>Rp. {{ number_format($kamar_transaction->kode) }}</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="5" align="right"><strong>Ongkos Kirim :</strong></td>
                                    <td " align="right"><strong>Rp. {{ number_format(($kamar_transaction->ongkir * $kamar_transaction->jumlah)) }}</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="5" align="right"><strong>Total Pembayaran :</strong></td>
                                    <td " align="right"><strong>Rp. {{ number_format($k_transaction->jumlah_harga + $k_transaction->kode + ($k_transaction->ongkir * $k_detailtransaction->jumlah)) }}</strong></td>
                                </tr>
                                <tr>
                                    @if($k_transaction->status != 1)
                                    <td colspan="4" align="right"><strong></strong></td>
                                    <td " align="right"><button type="button" class="btn btn-secondary" readonly title="Telah Diverifikasi">Ditolak</button></td>
    
                                    <td " align="left"><button type="button" class="btn btn-secondary" readonly title="Telah Diverifikasi">Disetujui</button></td>
                                    @else
                                    <td colspan="4" align="right"><strong></strong></td>
                                    <td " align="right"><a href="{{ url('/supplier/katalog/ditolakverifikasi') }}/{{ $k_transaction->id }}" class="btn btn-danger">Ditolak</a></td>
    
                                    <td " align="left"><a href="{{ url('/supplier/katalog/disetujuiverifikasi') }}/{{ $k_transaction->id }}" class="btn btn-success">Disetujui</a></td>
                                    @endif
                                </tr>
                                <tr>
                                    @if($k_transaction->bukti_resi == '' && $k_transaction->status != 1)
                                    <td colspan="5" ><strong></strong></td>
                                    <td align="right"><a href="{{ url('/supplier/katalog/bukti') }}/{{ $k_transaction->id }}" class="btn btn-primary"><i class="fa fa-info"></i> Upload Bukti Resi</a></td>
                                    @elseif($k_transaction->status == 1)
                                    <td colspan="5" ><strong></strong></td>
                                    <td align="left"><button type="button" class="btn btn-danger" readonly title="Bukti Resi Telah Diupload" hidden=""><i class="fas fa-upload"></i> Upload Resi</button></td>
                                    @else
                                    <td colspan="5" ><strong></strong></td>
                                    <td align="left"><button type="button" class="btn btn-danger" readonly title="Bukti Resi Telah Diupload" hidden=""><i class="fas fa-upload"></i> Upload Resi</button></td>
                                    @endif
                                </tr> --}}
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Hero -->
@endsection