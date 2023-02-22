@extends('layouts.master')
@section('content')
@if(Session::get('err'))
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
	<script>
      var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
	Toast.fire({
        icon: 'success',
        title: '{{ Session::get('err') }}',
        background: '#20c997',
      })
	</script>
    @endif
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Update Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
              <li class="breadcrumb-item active">My Profile</li>
              <li class="breadcrumb-item"><a href="#">Update</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container">
          <div class="row" align="center">
              <div class="col-lg-12">
                  <div class="card card-primary card-outline">
                      <div class="card-header">
                        <h5 class="card-title m-0" style="font-family: times new romane">The fields below are required in order to be able to use your account</h5>
                      </div>
                      <div class="card-body">
                        <form action="{{route('saveupdateprofile')}}" method="POST" align="left">
                            @csrf
                            <label>Full Name</label>
                            <div class="form-group">
                                <input type="text"  class="form-control shadow-sm p-3 mb-1 bg-white rounded" name="fullname" value="{{ Auth::User()->fullname }}">
                                @error('fullname')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <label>User Name</label>
                            <div class="form-group">
                                <input type="text"  class="form-control shadow-sm p-3 mb-1 bg-white rounded" name="username" value="{{ Auth::User()->username }}">
                                @error('username')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>

                            <label>Email</label>
                            <div class="form-group">
                                <input type="text" class="form-control shadow-sm p-3 mb-1 bg-white rounded" name="email" value="{{ Auth::User()->email}}">
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                            <label>Phone</label>
                            <div class="form-group">
                                <input type="text" class="form-control shadow-sm p-3 mb-1 bg-white rounded" name="phone" value="{{ Auth::User()->phone }}">
                                @error('phone')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            </div>
                            <br>
                            <div align="center">
                                <button type="submit" value="{{Auth::User()->id}}" class="btn btn-primary">Update Profile</button>
                            </div>
                        </form>
                      </div>
                  </div>
                </div>

          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
@endsection
