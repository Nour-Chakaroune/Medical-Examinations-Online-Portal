<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body>
    <div align="center" style="margin-top: 2%;">
        <div  class="card card-primary card-outline" data-select2-id="33" style="width: 40%;">
            <div style="align-content: center">
                <img src="{{ asset('img/lo_go.png') }}" class = "img-responsive center-block d-block "
                    style="width:40%;" alt="description of myimage">
                    <hr style="width: 80%">

            </div>
            <div class="card-body" data-select2-id="32">
                <h5 style="align-content: center;font-family:serif"><small>In order to access the self service section, you are kindly requested to login</small></h5>
                <br>
                <div style="width: 70%;">
                @if ($errors->any())
                <div class="alert fade show"
                            style="background-color: #FFCCCB;color:#8B0000;font-family:serif;" role="alert" align="center">
                            {{ $errors->first() }}
                        </div>
            @endif

            <form action="{{ route('login.custom') }}" method="post" autocomplete="off">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="name" placeholder="{{__('username')}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                          <box-icon type='solid' name='user'></box-icon>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="{{__('password')}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                          <box-icon name='lock-alt' type='solid' ></box-icon>
                        </div>
                    </div>
                </div>

                <div class="row" >
                    <div class="col justify-content-center">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
            </form>
        </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
</body>

</html>
