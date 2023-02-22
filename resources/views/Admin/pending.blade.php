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
            <h1 class="m-0">Pending Medical Examination</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Medical Examination</li>
                <li class="breadcrumb-item"><a href="#">Pending</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card card-warning card-outline">
                      <div class="card-body filterable">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                            <th>#</th>
                            <th>Medical Center</th>
                            {{-- <th style="width: 90px">Affiliate &#x2116;</th> --}}
                            <th style="width: 90px">Beneficiary</th>
                            <th>Prescribed Medical Tests</th>
                            <th style="width: 70px">Date</th>
                            <th>Prescription</th>
                            <th>Submission Date</th>
                          </tr>
                          </thead>
                          <tfoot style="display: table-header-group">
                            <tr class="filters">
                              <th></th>
                              <th><input type="text" class="form-control" placeholder="Medical center"></th>
                              {{-- <th><input type="text" class="form-control" placeholder="Affiliate &#x2116;"></th> --}}
                              <th><input type="text" class="form-control" placeholder="Beneficiary"></th>
                              <th><input type="text" class="form-control" placeholder="Prescribed Medical Tests"></th>
                              <th><input type="text" class="form-control" placeholder="Date"></th>
                              <th></th>
                              <th></th>
                            </tr>
                            </tfoot>
                          <tbody>

                            <?php $i = 0 ?>
                            @foreach ($pend as $key=>$task)
                            <?php $i++ ?>
                            <tr>
                              <td>{{ $i }}</td>
                              <td>{{ $task->getpendinglab->namee }}</td>
                              {{-- <td>{{ $task->serial }}</td> --}}
                              <td>{{ $task->getpendingbenef->NAME }}</td>
                              <td>
                                <div class="form-group">
                                    <select class="form-control select2 form" name="labmed" multiple disabled style="width: 100%;">
                                        @foreach (json_decode($task->type) as $key1)
                                        <option selected>{{ $key1 }}</option>
                                        @endforeach
                                    </select>
                                </div>
                              </td>
                              <td>{{ date( 'd/m/Y',  strtotime($task->date)) }}</td>
                              <td>
                                <button title="View" type="button" class="btn btn-outline-primary"   data-toggle="modal" data-target="#view{{ $task->id }}">
                                    <i class="fas fa-image"></i></button>
                            </td>
                              <td>{{$task->created_at->format('d/m/Y H:i:s')}}</td>
                            </tr>

                            {{-- View Image --}}
                            <div class="modal fade" id="view{{ $task->id }}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">View Prescription</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    {{ csrf_field() }}
                                    <label>Prescribed Medical Tests:</label>
                                        <div class="form-group">
                                            <select class="form-control select2 form" name="labmed" multiple disabled style="width: 100%;">
                                                @foreach (json_decode($task->type) as $key1)
                                                <option selected>{{ $key1 }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label>Uploaded image of the medical examinations:</label>
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
                            @endforeach
                          </tbody>

                        </table>
                        <!-- Button trigger modal -->
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
