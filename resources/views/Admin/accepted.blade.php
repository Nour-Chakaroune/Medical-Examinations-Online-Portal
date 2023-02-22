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
            <h1 class="m-0">Accepted Medical Examination</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Medical Examination</li>
                <li class="breadcrumb-item"><a href="#">Accepted</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card card-success card-outline">
                      <div class="card-body filterable">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                              <th>#</th>
                              <th>Medical Center</th>
                              {{-- <th style="width: 100px">Affiliate &#x2116;</th> --}}
                              <th style="width: 90px">Beneficiary</th>
                              <th>Prescribed Medical Tests</th>
                              <th>Date</th>
                              <th>Accepted Date</th>
                              {{-- <th>Action</th> --}}
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
                                <th><input type="text" class="form-control" placeholder="Accepted Date"></th>
                                {{-- <th></th> --}}
                              </tr>
                              </tfoot>
                            <tbody>
                              <?php $i = 0 ?>
                              @foreach ($acc as $key=>$task)
                              <?php $i++ ?>
                              <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $task->getlabmed->namee }}</td>
                                {{-- <td>{{ $task->getCustomer->serial }}</td> --}}
                                <td>{{ $task->getBeneficiaryname->NAME }}</td>
                                <td>{{ $task->type }}</td>
                                <td>{{date( 'd/m/Y',  strtotime($task->date))}}</td>
                                <td>{{ date( 'd/m/Y',  strtotime($task->created_at)) }}</td>
                                {{-- <td><a href="/task/accepted/print/{{ $task->id }}" class="btn btn-outline-primary"><i class="fas fa-print"></i></a></td> --}}
                              </tr>
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
