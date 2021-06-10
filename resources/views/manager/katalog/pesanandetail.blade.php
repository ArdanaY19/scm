@extends('layouts.master')

@section('content')
<section class="d-flex flex-column justify-content-center align-items-center" data-aos="fade-up">
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/manager/katalog/pesanan') }}">Riwayat Pemesanan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Pemesanan</li>
                </ol>
            </nav>
        </div>
        @if($errors->any())
        <div class="btn btn-danger col-md-6">
            <ul>
                @foreach($errors->all() as $error)
                <li class="text-center">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3>Sukses Melakukan Check Out</h3>
                    <h5>Pesanan sudah berhasil, Selanjutnya untuk pembayaran silahkan melakukan tranfer di 
                    <strong>BANK BRI Nomer Rekening : 31248-23182-129318</strong> dengan nominal <strong>Rp. {{ number_format($k_transaction->jumlah_harga + $k_transaction->kode) }}</strong></h5>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <h3><i class="fa fa-shopping-cart"></i> Detail Pemesanan </h3>
                    @if(!empty($k_transaction))
                    <p align="right">Tanggal Pesan : {{ $k_transaction->tanggal }}</p>
                    <table class="table table-striped mt-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Katalog</th>
                                <th>Foto Katalog</th>
                                <th>Jumlah</th>
                                <th>Resi Pembayaran</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($k_detailtransactions as $k_transaction_detail)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td class="text-capitalize">{{ $k_transaction_detail->katalog->nama_barang }}</td>
                                <td>
                                    <img src="{{ url('gambar') }}/{{ $k_transaction_detail->katalog->gambar }}" width="100" height="100" alt="...">
                                </td>
                                <td>{{ $k_transaction_detail->jumlah }} kg</td>
                                
                                @if($k_transaction_detail->k_transaction->bukti_resi != "" )
                                <td><img src="{{ url('bukti_resi') }}/{{ $k_transaction_detail->k_transaction->bukti_resi }}" width="100" height="100" alt="..."></td>
                                @elseif($k_transaction_detail->k_transaction->bukti_transfer == "")
                                <td>Upload Bukti Transfer Terlebih Dahulu</td>
                                @elseif($k_transaction_detail->k_transaction->status == 1)
                                <td>Menunggu Diverifikasi</td>
                                @else
                                <td>Menunggu Resi Diupload</td>
                                @endif
                                <td >Rp. {{ number_format($k_transaction_detail->katalog->harga) }}</td>
                                <td >Rp. {{ number_format($k_transaction_detail->jumlah_harga) }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td></td><td></td><td></td><td></td><td></td>
                                <td ><strong>Total Harga :</strong></td>
                                <td ><strong>Rp. {{ number_format($k_transaction->jumlah_harga) }}</strong></td>
                            </tr>
                            <tr>
                                <td></td><td></td><td></td><td></td><td></td>
                                <td ><strong>Kode Unik :</strong></td>
                                <td ><strong>Rp. {{ number_format($k_transaction->kode) }}</strong></td>
                            </tr>
                            <tr>
                                <td></td><td></td><td></td><td></td><td></td>
                                <td ><strong>Total Bayar :</strong></td>
                                <td ><strong>Rp. {{ number_format($k_transaction->jumlah_harga + $k_transaction->kode) }}</strong></td>
                            </tr>
                            <tr>
                                @if($k_transaction->bukti_transfer == '')
                                <td colspan="6" ><strong></strong></td>
                                <!-- <td align="right"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-upload"></i> Upload Bukti Transfer</button></td> -->
                                <td align="right"><a href="{{ url('/manager/katalog/bukti') }}/{{ $k_transaction->id }}" class="btn btn-primary"><i class="fa fa-info"></i> Upload Bukti Transfer</a></td>
                                @else
                                <td colspan="6" ><strong></strong></td>
                                <td align="right"><button type="button" class="btn btn-danger" readonly title="Bukti Transfer Telah Diupload" ><i class="fas fa-upload"></i> Upload Bukti Transfer</button></td>
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

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Upload Bukti Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
                <p>Pembayaran ke rek BNI senilai <strong>Rp. {{ number_format($k_transaction->jumlah_harga + $k_transaction->kode) }}</strong></p>
				<p>Nomer Rekening : 31248-23182-129318 a.n. Ardana Yuli Ariyanto </p>
            </div>
        <form action="{{ url('/manager/katalog/pesanan') }}/{{ $k_transaction->id }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input id="bukti_transfer" type="file" name="bukti_transfer" required>
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
</section><!-- End Hero -->
@endsection
