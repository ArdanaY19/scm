@extends('layouts.app')

@section('content')

<body class="bg-gradient-primary">

    @if (session('status'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-4 d-none d-lg-block"><img src="{{ url('../assets/img/dafam1.jpg') }}" width="400" height="400" alt=""></div>
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4 font-weight-bold">LOGIN</h1>
                  </div>
                  <form class="pt-3" method="POST" action="postlogin" name="form" onsubmit="return validateForm()">
                    @csrf
                    <div class="form-group">
                      <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <div class="text-center"><button type="submit" type="submit" id="submit" value="submit" onclick="sendMessage(); clearInput();" class="btn btn-outline-primary">
                        {{ __('Login') }}
                    </button></div>
                    <br>
                </form>
                <div class="text-center small">
                    <p>Belum Mempunyai Akun?</p>
                  </div>
                  <div class="text-center">
                    <a class="small btn btn-outline-success btn-sm" href="registersupplier">Daftar Supplier!</a>
                    <a href=""> | </a>
                    <a class="small btn btn-outline-info btn-sm" href="registermanager">Daftar Manager!</a>
                    <a href=""> | </a>
                    <a class="small btn btn-outline-info btn-sm" href="registercustomer">Daftar Customer!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <script type="text/javascript">
        function validateForm() {
            var a = document.forms["form"]["email"].value;
            var b = document.forms["form"]["password"].value;
            if (a == null || a == "", b == null || b == "") {
                alert("email dan password tidak boleh kosong");
                return false;
            }
        }
    </script>

</body>

@endsection
