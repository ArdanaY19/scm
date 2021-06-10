@extends('supplier.layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/supplier/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/supplier/katalog/verifikasi') }}">Verifikasi Pembayaran</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Verifikasi Pembayaran</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <div class="card mt-2">
                <div class="card-body">
                    <h3><i class="fas fa-info-circle"></i> Detail Pembayaran </h3>
                    @if(!empty($k_transaction))
                    <p align="right">Tanggal Pesan : {{ $k_transaction->tanggal }}</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Katalog</th>
                                <th>Bukti Transfer</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($k_detailtransactions as $k_detailtransaction)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td class="text-capitalize">{{ $k_detailtransaction->katalog->nama_barang }}</td>
                                <td>
                                    <button type="button" data-toggle="modal" data-target="#exampleModalCenter"><img src="{{ url('bukti_transfer') }}/{{ $k_detailtransaction->k_transaction->bukti_transfer }}" width="100" height="100" alt="..."></button>
                                </td>
                                <td>{{ $k_detailtransaction->jumlah }} kg</td>
                                <td " align="right">Rp. {{ number_format($k_detailtransaction->katalog->harga) }}</td>
                                <td " align="right">Rp. {{ number_format($k_detailtransaction->jumlah_harga) }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" align="right"><strong>Total Harga :</strong></td>
                                <td " align="right"><strong>Rp. {{ number_format($k_transaction->jumlah_harga) }}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="5" align="right"><strong>Kode Unik :</strong></td>
                                <td " align="right"><strong>Rp. {{ number_format($k_transaction->kode) }}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="5" align="right"><strong>Ongkos Kirim :</strong></td>
                                <td " align="right"><strong>Rp. {{ number_format(($k_transaction->ongkir * $k_detailtransaction->jumlah)) }}</strong></td>
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
                                <td align="left"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-upload"></i> Upload Resi</button></td>
                                @elseif($k_transaction->status == 1)
                                <td colspan="5" ><strong></strong></td>
                                <td align="left"><button type="button" class="btn btn-danger" readonly title="Bukti Resi Telah Diupload" hidden=""><i class="fas fa-upload"></i> Upload Resi</button></td>
                                @else
                                <td colspan="5" ><strong></strong></td>
                                <td align="left"><button type="button" class="btn btn-danger" readonly title="Bukti Resi Telah Diupload" hidden=""><i class="fas fa-upload"></i> Upload Resi</button></td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Upload Resi Pengiriman</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <p>Upload Resi Pengiriman Untuk <strong></strong></p>
        </div>
        <form action="{{ url('/supplier/katalog/resi') }}/{{ $k_transaction->id }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input id="bukti_resi" type="file" name="bukti_resi" required>
            </div>
            <div class="form-group text-right">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Upload Bukti</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
@endsection
