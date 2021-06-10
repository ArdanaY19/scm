@extends('.layouts.master')

@section('content')
<section class="d-flex flex-column justify-content-center align-items-center" data-aos="fade-up">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/manager/index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <h3><i class="fa fa-shopping-cart"></i> Check Out </h3>
                        @if(!empty($k_transaction))
                        <p align="right">Tanggal Pesan : {{ $k_transaction->tanggal }}</p>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Katalog</th>
                                    <th>Foto Katalog</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($k_detailtransactions as $k_detailtransaction)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $k_detailtransaction->katalog->nama_barang }}</td>
                                    <td>
                                        <img src="{{ url('gambar') }}/{{ $k_detailtransaction->katalog->gambar }}" width="100" height="50" alt="...">
                                    </td>
                                    <td>{{ $k_detailtransaction->jumlah }} pcs</td>
                                    <td class="text-center">Rp. {{ number_format($k_detailtransaction->katalog->harga) }}</td>
                                    <td class="text-center">Rp. {{ number_format($k_detailtransaction->jumlah_harga) }}</td>
                                    <td>
                                        <form action="{{ url('/manager/katalog/check_out') }}/{{ $k_detailtransaction->id }}" method="post">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5" class="text-center"><strong>Total Harga :</strong></td>
                                    <td class="text-center"><strong>Rp. {{ number_format($k_transaction->jumlah_harga) }}</strong></td>
                                    <td>
                                        <a href="{{ url('/manager/katalog/konfirmasi') }}" class="btn btn-success"><i class="fa fa-shopping-cart"></i> Check Out</a>
                                    </td>
                                </tr>
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