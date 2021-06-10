@extends('layouts.master')

@section('content')
<section class="d-flex flex-column justify-content-center align-items-center" data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Bukti Pembayaran') }}</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/manager/katalog/pesanan') }}/{{ $k_transaction->id }}" enctype="multipart/form-data" name="form" onsubmit="return validateForm()">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="">Bukti Transfer</label>
                                <input id="bukti_transfer" type="file" class="form-control @error('bukti_transfer') is-invalid @enderror" name="bukti_transfer" value="{{ old('bukti_transfer') }}" autocomplete="bukti_transfer" autofocus>
                                @error('bukti_transfer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <a href="{{ url('/manager/katalog/pesanan') }}/{{ $k_transaction->id }}" class="btn btn-danger">Batal</a>
                                <button type="submit" class="btn btn-primary">Upload Bukti</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Hero -->
@endsection