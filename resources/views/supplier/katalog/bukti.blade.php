@extends('supplier.layouts.master')

@section('content')
<section class="d-flex flex-column justify-content-center align-items-center" data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Bukti Resi') }}</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/supplier/katalog/verifikasi') }}/{{ $k_transaction->id }}" enctype="multipart/form-data" name="form" onsubmit="return validateForm()">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="">Bukti Resi</label>
                                <input id="bukti_resi" type="file" class="form-control @error('bukti_resi') is-invalid @enderror" name="bukti_resi" value="{{ old('bukti_resi') }}" autocomplete="bukti_resi" autofocus>
                                @error('bukti_resi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <a href="{{ url('/supplier/katalog/verifikasi') }}/{{ $k_transaction->id }}" class="btn btn-danger">Batal</a>
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