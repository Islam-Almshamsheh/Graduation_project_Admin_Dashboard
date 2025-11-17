<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{asset('backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
  </div>

  
  @include('backend.layouts.navbar')
  @include('backend.layouts.sidebar')
  <!-- Content Wrapper. Contains page content -->
  @include('backend.layouts.content-wrapper')
  
  @yield('content')
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>UniGuide </strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>location</b> Amman
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App (load only once, not both .js and .min.js) -->
<script src="{{asset('backend/dist/js/adminlte.min.js')}}"></script>

<!-- Optional plugins (only if your dashboard uses them) -->
<script src="{{asset('backend/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('backend/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<script src="{{asset('backend/plugins/flot/jquery.flot.js')}}"></script>
<script src="{{asset('backend/plugins/flot/plugins/jquery.flot.resize.js')}}"></script>
<script src="{{asset('backend/plugins/flot/plugins/jquery.flot.pie.js')}}"></script>
<script src="{{asset('backend/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('backend/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('backend/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>

<!-- DataTables & Plugins -->
<script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('backend/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('backend/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@yield('script')

<script>
  $(function () {
    // Initialize DataTables if present
    if ($("#example1").length) {
      $("#example1").DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    }

    if ($("#example2").length) {
      $('#example2').DataTable({
        paging: true,
        lengthChange: false,
        searching: false,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
      });
    }
  });

  // SweetAlert Success message
  @if(session('success'))
  Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: '{{ session('success') }}',
    timer: 5000,
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  @endif
</script>

</body>
</html>
