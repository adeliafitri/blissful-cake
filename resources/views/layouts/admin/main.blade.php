<!DOCTYPE html>
<html lang="en">
<head>
  @include('layouts.admin.header')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('layouts.admin.navbar')

    @include('layouts.admin.sidebar')
    <div class="content-wrapper" style="overflow: auto">
        @yield('content')
    {{-- @yield('content') --}}
    </div>

    @include('layouts.admin.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('layouts.admin.script')
@yield('script')
</body>
</html>
