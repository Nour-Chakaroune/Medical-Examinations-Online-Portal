@extends('layouts.master')
@section('content')
@if(Session::get('succ'))
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
        title: '{{ Session::get('succ') }}',
        background: '#20c997',
      })
	</script>
    @endif
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">New Task</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Home</li>
                <li class="breadcrumb-item"><a href="#">New Task</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container">
          <div class="row" align="center">
              <div class="col-lg-12">
                  <div class="card card-info">
                    <div class="card-header">
                        <h5 class="card-title m-0" style="font-family: times new romane">The fields below are required to be able to submit for medical examinations</h5>
                      </div>
                      <div class="card-body">
                        <form action="{{route('setnewtask')}}" method="POST" enctype="multipart/form-data" align="left">
                            @csrf
                            <div class="form-group">
                                <label>Beneficiary</label>
                                <select class="form-control shadow-sm p-3 mb-1 bg-white rounded select2 form " name="benef" data-placeholder="Select Beneficiary" style="width: 100%;">
                                    <option value="" @if(old('benef')==null) selected @endif disabled>Select Beneficiary</option>
                                    @foreach ($benef as $req1)
                                        <option value="{{ $req1->id }}" {{ (collect(old('benef'))->contains($req1->id)) ? 'selected':'' }}>{{ $req1->NAME }}</option>
                                    @endforeach
                                </select>
                                @error('benef')
                                    <span class="text-danger" align="left">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Prescribed Medical Tests</label>
                                <select class="form-control select2 form " name="test[]" multiple data-placeholder="Select Tests" style="width: 100%;">
                                  @foreach ($tests as $key)
                                      <option value="{{ $key->name }}" {{ (collect(old('test'))->contains($key->name)) ? 'selected':'' }} >{{ $key->name }}</option>
                                  @endforeach
                                </select>
                                @error('test')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Medical Center</label>
                                <select class="form-control select2 form" name="labmed" data-placeholder="Select Medical Center" style="width: 100%;">
                                    <option value="" @if (old('labmed')==null) selected @endif  disabled>Select Medical Center</option>
                                    @foreach ($labmed as $key)
                                      <option value="{{ $key->id }}" {{ (collect(old('labmed'))->contains($key->id)) ? 'selected':'' }}>{{ $key->namee }}</option>
                                  @endforeach
                                </select>
                                @error('labmed')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Date</label>
                                  <div class="input-group date reservationdate" data-target-input="nearest">
                                      <input type="text" class="form-control datetimepicker-input form" value="{{ old('date') }}" placeholder="Date" name="date" data-target=".reservationdate"/>
                                      <div class="input-group-append" data-target=".reservationdate" data-toggle="datetimepicker">
                                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                      </div>
                                  </div>
                                  @error('date')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                              </div>
                              <div class="form-group">
                                <label>Image upload of the medical examinations</label>
                                <div class="col-lg-3">
                                <input type="file" accept=".jpg,.png,.jpeg" class="form-control-file" name="image">
                                </div>
                                @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                                <div align="center">
                              <button type="submit" class="btn btn-info">Submit</button>
                            </div>
                        </form>
                      </div>
                  </div>
                </div>

          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

      <Script>
        setTimeout(function(){
          $('.alert').alert('close');
        },3000)

        window.onload=function(){
          $(".select2").select2();
        };
      </script>
@endsection
