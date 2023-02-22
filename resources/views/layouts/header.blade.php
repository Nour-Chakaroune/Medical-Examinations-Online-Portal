<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="" class="navbar-brand">
        <img src="{{ asset('img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8;">
        <span class="brand-text font-weight-light">{{Auth()->User()->username}}</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="/home" class="nav-link @if(Route::currentRouteName()=='home' || Route::currentRouteName()=='updateprofile' || Route::currentRouteName()=='editpass') active @endif "><i class="fas fa-user-circle" style="color: #467fd0"></i>&nbsp; My Profile</a>
          </li>
          <li class="nav-item">
            <a href="/new/task" class="nav-link @if(Route::currentRouteName()=='newtask') active @endif"><i class="fas fa-plus-circle" style="color: #467fd0"></i>&nbsp; New Task</a>
          </li>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle @if(Route::currentRouteName()=='waiting' || Route::currentRouteName()=='pending' || Route::currentRouteName()=='returned' || Route::currentRouteName()=='accepted' || Route::currentRouteName()=='rejected') active @endif">
                <i class="fas fa-clinic-medical" style="color: #467fd0"></i>&nbsp; Medical Examinations</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li @if(Route::currentRouteName()=='waiting') style="background-color: #fafafa;" @endif>
                <a href="/waiting" class="dropdown-item"><i class="fas fa-hourglass-half" style="color:rgb(204, 229, 255)"></i>&nbsp; Waiting</a>
              </li>
              <li @if(Route::currentRouteName()=='pending') style="background-color: #fafafa;" @endif>
                <a href="/pending" class="dropdown-item"><i class="far fa-pause-circle" style="color:rgb(255, 196, 0)"></i>&nbsp; Pending</a>
              </li>
              <li @if(Route::currentRouteName()=='returned'|| Route::currentRouteName()=='resendreturned' || Route::currentRouteName()=='resubmitreturned') style="background-color: #fafafa;" @endif>
                <a href="/returned" class="dropdown-item"><i class="fas fa-undo" style="color: #467fd0"></i>&nbsp; Returned</a>
              </li>
              <li @if(Route::currentRouteName()=='accepted') style="background-color: #fafafa;" @endif>
                <a href="/accepted" class="dropdown-item"><i class="far fa-check-circle" style="color: green"></i>&nbsp; Accepted</a>
              </li>
              <li @if(Route::currentRouteName()=='rejected') style="background-color: #fafafa;" @endif>
                <a href="/rejected" class="dropdown-item"><i class="far fa-times-circle" style="color: red"></i>&nbsp; Rejected</a>
              </li>


              {{-- <li class="dropdown-divider"></li> --}}

              <!-- Level two dropdown-->
              {{-- <li class="dropdown-submenu dropdown-hover">
                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">
                    <i class="far fa-times-circle" style="color: red"></i>&nbsp;Rejected</a>
                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                  <li>
                    <a href="#" class="dropdown-item">
                        Rejected Online</a>
                  </li>
                  <li>
                    <a href="#" class="dropdown-item">
                        Rejected</a>
                  </li>
                </ul>
              </li> --}}
              <!-- End Level two -->
            </ul>
          </li>
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item">
            <a class="nav-link" title="Full screen" data-widget="fullscreen" href="#" role="button">
              <box-icon name='expand'></box-icon>
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link" title="Logout"  data-toggle="modal" data-target="#logout">
            <box-icon name='log-out'></box-icon>
          </a>
          </li>
      </ul>
    </div>
  </nav>

  <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Alert!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        Are you sure you want logout?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <a href="/signout" type="button" class="btn btn-danger">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->



  <!-- Main Footer -->
  <footer class="main-footer" style="text-align: center; font-family:adobe arabic;">
    <strong> صندوق التعاضد - </strong> أفراد الهيئة التعليمية في الجامعة اللبنانية
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>


