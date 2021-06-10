@extends('customer.layouts.master')

@section('content')
<section class="d-flex flex-column justify-content-center align-items-center" data-aos="fade-up">
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-8 mt-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/customer/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-header">
                  <h1 class="row d-flex align-items-center">
                  <span class="col-md-10 fa fa-user"><span></span> My<span></span> Profile</span> 
                  <a class="col-md-2" href="/customer/profile/edit/{{auth()->user()->customer->id}}" style="font-size: 20px;"><i class="fa fa-cog mr4"></i> Edit Profile</a>
                  </h1>
                  <h3 class="ml-15" style="text-decoration: underline;">{{auth()->user()->role}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="text-uppercase">{{auth()->user()->customer->nama}}</h2>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td><i class="fa fa-birthday-cake"></i> Tanggal Lahir</td>
                                        <td>:</td>
                                        <td>{{auth()->user()->customer->tanggal_lahir}}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-envelope"></i> Email</td>
                                        <td>:</td>
                                        <td>{{auth()->user()->email}}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-phone"></i> No.Hp</td>
                                        <td>:</td>
                                        <td>{{auth()->user()->customer->no_hp}}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-map-marker"></i> Alamat</td>
                                        <td>:</td>
                                        <td class="text-capitalize">{{auth()->user()->customer->alamat}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <img src="{{ url('foto') }}/{{ auth()->user()->customer->foto }}" class="rounded mx-auto d-block" width="350" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <p style="color: #696969">Bergabung pada {{auth()->user()->created_at}}</p>
        </div>
    </div>
</div>
</section><!-- End Hero -->
@endsection
