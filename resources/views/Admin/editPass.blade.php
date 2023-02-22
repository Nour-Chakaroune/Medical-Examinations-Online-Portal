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
            <h1 class="m-0">Change Your Password</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">My Profile</li>
                <li class="breadcrumb-item"><a href="#">Edit Password</a></li>
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
                      @if ($errors->any())
                        <div class="alert fade show"
                            style="background-color: #FFCCCB;color:#8B0000;font-family:times new roman;" role="alert" align="center">
                            {{ $errors->first() }}
                        </div>
                        @endif
                      <div class="card-body">
                        <form action="{{ route('changepass') }}" method="POST" align="left">
                            @csrf
                            <label>Enter old password</label>
                            <div class="form-group">
                                <input type="password" placeholder="Enter old password" class="form-control shadow-sm p-3 mb-1 bg-white rounded" name="oldpass" required>
                            </div>
                            <br>
                            <label>Enter new password</label>
                            <div class="form-group">
                                <input type="password" placeholder="Enter new password" class="form-control shadow-sm p-3 mb-1 bg-white rounded" name="newpass" required>
                            </div>
                            <br>
                            <label>Confirm new password</label>
                            <div class="form-group">
                                <input type="password" placeholder="Confirm new password" class="form-control shadow-sm p-3 mb-1 bg-white rounded" name="confirmpass" required>
                            </div>
                            <br>
                            <div align="center">
                                <button type="submit" value="{{Auth::User()->id}}" class="btn btn-primary">Change Password</button>
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
