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
            <h1 class="m-0">Resend Task</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Medical Examination</li>
                <li class="breadcrumb-item"><a href="#">Resend Task</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container">
          <div class="row" align="center">
              <div class="col-lg-12">
                  <div class="card card-primary">
                    <div class="card-header">
                        <h5 class="card-title m-0" style="font-family: times new romane">The fields below are required, please resubmit with the accepted information</h5>
                      </div>
                      <form action="{{route('resubmitreturned')}}" method="POST" enctype="multipart/form-data" align="left">
                      <div class="card-body">

                            @csrf
                            <div class="form-group">
                                <label>Beneficiary</label>
                                    <select class="form-control select2 form" name="benef" style="width: 100%;">
                                       @foreach ($benef as $key)
                                           <option value="{{ $key->id }}" @if($key->id==$task->pat) selected @endif>{{ $key->NAME }}</option>
                                       @endforeach
                                    </select>
                                @error('benef')
                                    <span class="text-danger" align="left">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Prescribed Medical Tests</label>
                                <select class="form-control select2 form" name="test[]" multiple style="width: 100%;">
                                    @foreach ($tests as $key)
                                    <option value="{{ $key->name }}"  {{ (collect(json_decode($task->type))->contains($key->name)) ? 'selected':'' }}>{{ $key->name }}</option>
                                    @endforeach
                                </select>
                                @error('test')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Medical Center</label>
                                <select class="form-control select2 form" name="labmed" style="width: 100%;">
                                    @foreach ($labmed as $key)
                                    <option value="{{ $key->id }}" @if($key->id==$task->labmed) selected @endif>{{ $key->namee }}</option>
                                    @endforeach
                                </select>
                                @error('labmed')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Date</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input form" value="{{ $task->date }}" placeholder="Date" name="date" data-target="#reservationdate"/>
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                  @error('date')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                              </div>
                              <label>Upload a new image of the medical examinations if you want to replace the old one &nbsp;</label>
                                   <button title="View Old Image" type="button" class="btn btn-outline-primary"   data-toggle="modal" data-target="#zoom{{ $task->image }}">
                                        <i class="fas fa-image"></i></button>
                                        <div class="form-group">
                                            <div class="row form-group">
                                                <div class="col-lg-3">
                                            <input type="file" accept=".jpg,.png,.jpeg" class="form-control-file form" name="image">
                                            </div></div>
                                            @error('image')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                              {{-- <div class="row">
                                <div class="col-lg-5">
                                    <label>Upload a new image if you want to replace the old one</label>
                                    <div class="form-group">
                                        <input type="file" accept=".jpg,.png,.jpeg" class="form-control-file" name="image">
                                    </div>
                                </div>
                                <div class="col-lg-6" align="left">
                                    <div class="form-group">
                                        <div>
                                            <a href="#" class="pop">
                                                <img title="Click to Zoom "  src="{{ "data:image/" .$task->imageType. ";base64," .base64_encode( $task->image ) }}" width="30%" alt="Try Again"/>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}


                      </div>
                      <div class="card-footer" align="right">
                        <button type="submit" value="{{ $task->id }}" name="id" class="btn btn-primary">Resubmit</button>
                    </div>
                </form>
                  </div>
                </div>

          </div>
          <!-- /.row -->

        </div><!-- /.container-fluid -->
      </div>
      {{-- <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" data-dismiss="modal">
          <div class="modal-content"  >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body" align="center">
              <img src="" class="imagepreview" >
            </div>
          </div>
        </div>
      </div> --}}
      {{-- Zoom Image --}}
      <div class="modal fade" id="zoom{{ $task->image }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Old image of the medical examinations</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            {{ csrf_field() }}
                <div class="form-group" align="center">
                    <img  src="{{ "data:image/" .$task->imageType. ";base64," .base64_encode( $task->image ) }}" class="img-fluid" alt="Try Again"/>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>

      <Script>
        setTimeout(function(){
          $('.alert').alert('close');
        },3000)

        window.onload=function(){
          $(".select2").select2();
        };

        $(function() {
            $('.pop').on('click', function() {
                $('.imagepreview').attr('src', $(this).find('img').attr('src'));
                $('#imagemodal').modal('show');
            });
    });
      </script>
@endsection
