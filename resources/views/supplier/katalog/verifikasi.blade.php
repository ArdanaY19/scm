@extends('supplier.layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/supplier/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Verifikasi Pembayaran</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <h3><i class="fas fa-user-check"></i> Verifikasi Pembayaran </h3>
                    <table class="table table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Email Manager</th>
                                <th>Alamat</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Status</th>
                                <th>Total Harga</th>
                                <th>Bukti Resi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($k_transactions as $k_transaction)
                            <tr class="text-center">
                                <td>{{ $no++ }}</td>
                                <td>{{ $k_transaction->user->email }}</td>
                                <td class="text-capitalize">{{ $k_transaction->user->manager->alamat }}</td>
                                <td>{{ date("d F Y", strtotime($k_transaction->tanggal)) }}</td>
                                <td>
                                    @if($k_transaction->status == 1)
                                    Belum Diverifikasi
                                    @elseif($k_transaction->status == 2)
                                    Terverifikasi
                                    @else
                                    Ditolak
                                    @endif
                                </td>
                                <td>Rp. {{ number_format($k_transaction->jumlah_harga + $k_transaction->kode) }}</td>
                                @if($k_transaction->bukti_resi != "")
                                <td><img src="{{ url('bukti_resi') }}/{{ $k_transaction->bukti_resi }}" width="100" height="100" alt="..."></td>
                                @elseif($k_transaction->status == 1)
                                <td>Lakukan Verifikasi</td>
                                @elseif($k_transaction->status == 3)
                                <td>Maaf Pembayaran Ditolak</td>
                                @else
                                <td>Resi Belum Diupload</td>
                                @endif
                                <td>
                                    <a href="{{ url('/supplier/katalog/verifikasi') }}/{{ $k_transaction->id }}" class="btn btn-primary"><i class="fa fa-info"></i> Detail</a>                             
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
