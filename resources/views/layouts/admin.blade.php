<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  @include('admin.includes.styles')
</head>
<body class="hold-transition sidebar-collapse layout-top-nav">
    <div class="wrapper">

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
        <div class="container-fluid">
          <a href="{{ route('admin.dashboard') }}" class="navbar-brand">
            <img src="{{ asset('assets/admin/img/logo.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          </a>

          <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">

              <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a>
              </li>
              <li class="nav-item dropdown dropdown-hover">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Admissions & Classes</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">

                  <!-- Level two dropdown-->
                  <li class="dropdown-submenu dropdown-hover">
                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Admissions</a>
                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                      <li>
                        <a tabindex="-1" href="{{ route('admin.students.create') }}" class="dropdown-item">New Admission</a>
                      </li>
                      <li><a href="{{ route('admin.students.index') }}" class="dropdown-item">View Admissions</a></li>
                    </ul>
                  </li>
                  <li class="dropdown-submenu dropdown-hover">
                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Classes</a>
                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                      <li>
                        <a tabindex="-1" href="{{ route('admin.classes.create') }}" class="dropdown-item">Add Class</a>
                      </li>
                      <li><a href="{{ route('admin.classes.index') }}" class="dropdown-item">View Classes</a></li>
                    </ul>
                  </li>

                </ul>
              </li>


              <li class="nav-item">
                <a href="{{ route('admin.objectives.grades.create') }}" class="nav-link">Enter Grade</a>
              </li>

              <li class="nav-item dropdown dropdown-hover">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Services</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">

                  <!-- Level two dropdown-->
                  <li class="dropdown-submenu dropdown-hover">
                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Physical, Social and Emotional Development</a>
                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                      <li>
                        <a tabindex="-1" href="#" class="dropdown-item">Self-Regulation</a>
                      </li>
                      <li><a href="#" class="dropdown-item">Managing Self</a></li>
                      <li><a href="#" class="dropdown-item">Building Relationships</a></li>
                    </ul>
                  </li>
                  <li class="dropdown-submenu dropdown-hover">
                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Communication & Language</a>
                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                      <li>
                        <a tabindex="-1" href="#" class="dropdown-item">Listening, Attention & Understanding</a>
                      </li>
                      <li><a href="#" class="dropdown-item">Speaking</a></li>
                    </ul>

                  </li>
                  <li class="dropdown-submenu dropdown-hover">
                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Literacy</a>
                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                      <li>
                        <a tabindex="-1" href="#" class="dropdown-item">Comprehension</a>
                      </li>
                      <li><a href="#" class="dropdown-item">Word Reading</a></li>
                      <li><a href="#" class="dropdown-item">Writing</a></li>
                    </ul>
                  </li>

                  <li class="dropdown-submenu dropdown-hover">
                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Understanding the World</a>
                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                      <li>
                        <a tabindex="-1" href="#" class="dropdown-item">Past & Present</a>
                      </li>
                      <li><a href="#" class="dropdown-item">People, Culture & Communities</a></li>
                      <li><a href="#" class="dropdown-item">The Natural World</a></li>
                    </ul>
                  </li>

                  <li class="dropdown-submenu dropdown-hover">
                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Communication & Language</a>
                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                      <li>
                        <a tabindex="-1" href="#" class="dropdown-item">Listening, Attention & Understanding</a>
                      </li>
                      <li><a href="#" class="dropdown-item">Speaking</a></li>
                    </ul>
                  </li>

              <!-- End Level two -->

              </ul>
            <!-- Main menu items Analysis-->
            <li class="nav-item dropdown dropdown-hover">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Analysis</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">

                  <!-- Level two dropdown-->
                  <li class="dropdown-item dropdown-hover">
                  <li><a href="{{ route('admin.analysis.summaries.index') }}" class="dropdown-item">Student Summery</a></li>
                  <li><a href="#" class="dropdown-item">Live Progress</a></li>
                  <li><a href="#" class="dropdown-item">Checkpoint 3-4</a></li>
                  <li><a href="#" class="dropdown-item">Checkpoint Reception</a></li>
              </ul>
                </li>
                <!-- End Main menu items Analysis-->

                <li class="nav-item">
                <a href="{{ route('admin.objectives.index') }}" class="nav-link">Interventions</a>
              </li>

                <li class="nav-item">
                    <a href="{{ route('admin.reports.admissions') }}" class="nav-link">Reports</a>
                </li>

              <li class="nav-item">
                <a data-toggle="modal" data-target=".ajaxModal" href="#" class="nav-link">Settings</a>
              </li>


         </li>

            </ul>

          </div>

          <!-- Right navbar links -->
          <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <!-- Messages Dropdown Menu -->

            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                <span class="">{{ auth()->user() ? auth()->user()->name: '' }}</span>
                <i class="fas fa-caret-down"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <form id="logout-form" method="post" action="{{ route('logout') }}">
                    @csrf
                    <a id="logout-button" href="#" class="dropdown-item dropdown-footer">Logout</a>
                </form>
              </div>
            </li>
          </ul>
        </div>
      </nav>
      <!-- /.navbar -->


  <!-- Content Wrapper. Contains page content -->
    @yield('content')
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>Copyright &copy; 2022 <a target="_blank" href="https://biztechsols.com">BizTechSols Ltd</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


@include('admin.includes.scripts')


<script src="{{ asset('assets/admin/js/toastr.min.js') }}"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>

<script>

    @if(Session::has('alert-success'))
        toastr["success"]("{{ Session::get('alert-success') }}");
    @endif

    @if(Session::has('alert-info'))
        toastr["info"]("{{ Session::get('alert-info') }}");
    @endif

    @if(Session::has('alert-danger'))
        toastr["error"]("{{ Session::get('alert-danger') }}");
    @endif

</script>

<script>
  $(document).ready(function() {
    $('#logout-button').click(function() {
      $('#logout-form').submit();
    })
  });
</script>




</body>
</html>
