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
            <h1 class="m-0"><small>Welcome</small> {{Auth()->User()->fullname}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">My Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                      <h5 class="card-title m-0 text-primary">Account Info</h5>
                    </div>
                    <div class="card-body">
                      <table class="table table-borderless">
                          <tr>
                              <td><label>Username:</label></td>
                              <td>{{Auth()->User()->username}}</td>
                          </tr>
                          <tr>
                              <td> <label>Full Name:</label></td>
                              <td>{{Auth()->User()->fullname}}</td>
                          </tr>
                          <tr>
                              <td><label>Email:</label></td>
                              <td>{{Auth()->User()->email}}</td>
                          </tr>
                          <tr>
                              <td> <label>Phone:</label></td>
                              <td>{{Auth()->User()->phone}}</td>
                          </tr>
                      </table>
                      <div align="right">
                        <a href="/update/profile" class="btn btn-primary">Update Profile</a>
                      </div>
                    </div>
                </div>

                <div class="card card-primary card-outline">
                    <div class="card-header">
                      <h5 class="card-title m-0 text-primary">Personal</h5>
                    </div>
                    <div class="card-body">
                      <table class="table table-borderless">
                      <tr>
                          <td><label>Account Created:</label></td>
                          <td>{{ date( 'd/m/Y',  strtotime(Auth()->User()->created_at)) }}</td>
                      </tr>
                      <tr>
                          <td><label>Affiliation Number: </label></td>
                          <td>{{Auth()->User()->number}}</td>
                      </tr>
                      </table>
                      <hr>
                      <div align="right">
                          <a href="/edit/password" class="btn btn-primary">Edit Password</a>
                        </div>
                    </div>

                  </div>
              </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">


            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title m-0 text-primary">Beneficiaries</h5>
                  </div>
              <div class="card-body">
                @php
                    $benef= DB::table('benef')->where('Teacher_ID',Auth()->User()->number)->orderBy('NAME')->get();
                @endphp
                <h4>
                @foreach ($benef as $b )
                <span class="badge badge-info">{{$b->NAME}}</span> &nbsp;
                @endforeach
                </h4>
                {{-- <a href="#" class="card-link">Card link</a> --}}

              </div>
            </div><!-- /.card -->

            <div class="card card-primary card-outline">
                <div class="card-header">
                  <h5 class="card-title m-0 text-primary">Medical Examinations</h5>
                </div>
                <div class="card-body">
                  <table class="table table-borderless">
                      <tr>
                          <td>
                            <i class="fas fa-hourglass-half" style="color:rgb(204, 229, 255)"></i> &nbsp;
                            <a href="/waiting" style="color: black;"> <label role="button">Waiting</label> </a>
                          </td>
                          <td>
                            <span class="right badge bg-gradient-secondary badge-warning text-white">{{ DB::table('request')->where('serial',Auth()->User()->number)->where('Status','waiting')->count() }}</span>
                          </td>
                      </tr>
                      <tr>
                          <td><i class="far fa-pause-circle" style="color:rgb(255, 196, 0)"></i>&nbsp;
                            <a href="/pending" style="color: black;"><label role="button">Pending</label></a></td>
                          <td>
                            <span class="right badge bg-gradient-warning badge-warning text-white">{{ DB::table('request')->where('serial',Auth()->User()->number)->where('Status','requested')->count() }}</span>
                          </td>
                      </tr>
                      <tr>
                        <td> <i class="fas fa-undo" style="color: #467fd0"></i>&nbsp;
                            <a href="/returned" style="color: black;"><label role="button">Returned</label></a></td>
                        <td>
                          <span class="right badge bg-gradient-info badge-info">{{ DB::table('request')->where('serial',Auth()->User()->number)->where('Status','Returned')->count() }}</span>
                        </td>
                    </tr>
                      <tr>
                          <td><i class="far fa-check-circle" style="color: green"></i>&nbsp;
                            <a href="/accepted" style="color: black;"><label role="button">Accepted</label></a></td>
                          <td>
                            <span class="right badge bg-gradient-success badge-success">{{ DB::table('task')->where('cust',Auth()->User()->number)->where('Status','Accepted')->count() }}</span>
                          </td>
                      </tr>
                      <tr>
                        <td> <i class="far fa-times-circle" style="color: red"></i>&nbsp;
                            <a href="/rejected" style="color: black;"><label role="button">Rejected </label></a></td>
                        <td>
                          <span class="right badge bg-gradient-danger badge-danger">{{ DB::table('task')->where('cust',Auth()->User()->number)->where('Status','Rejected')->count() }}</span>
                        </td>
                    </tr>
                  </table>
                </div>
            </div>
          </div>
          <!-- /.col-md-6 -->

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

@endsection
