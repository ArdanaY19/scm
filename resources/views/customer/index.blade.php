@extends('customer.layouts.master')

@section('content')

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex flex-column justify-content-center align-items-center">
  <div class="container text-center text-md-left" data-aos="fade-up">
    <h1>Welcome to Dafam Hotel</h1>
    <h1><span class="text-capitalize">{{auth()->user()->customer->nama}}</span></h1>
    <a href="#about" class="btn-get-started scrollto">Get Started</a>
  </div>
</section>

@endsection