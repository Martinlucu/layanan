@extends('layouts.topmhs')
@section('content')
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Layanan Berhenti Studi Tetap</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- Ionicons -->
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <!-- summernote -->
  <!-- Data table -->
  <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css')}}">
  <link rel="stylesheet" href="{{asset('https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css')}}">
  <script src="{{asset('https://code.jquery.com/jquery-3.5.1.js')}}"></script>
  <script src="{{asset('https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js')}}"></script>

  <script>
        $(document).ready(function () {
  $('#example').DataTable();
});
    </script>
</head>
<body class="hold-transition layout-top-nav">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">History Layanan Berhenti Studi Tetap (BST)</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/mhs')}}">Home &nbsp</a>/ History Layanan Berhenti Studi Tetap (BST)</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="table-responsive" style="padding:20px;width: 98%;">
          <table id="example" class="table table-striped table-bordered" id="hidden-table-info" data-order="[]">
          <thead>
            <tr>
                          <th>NIM - Nama</th>
                          <th>Jurusan</th>
                          <th>Alasan Pengajuan</th>
                          <th>Tanggal Pengajuan</th>
                          <th>Tanggal Diproses</th>
                          <th>Status</th>
                        
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        @foreach($bsmaha as $b)
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $b->id }}">
                        <td>{{ $b->nim }} - {{ $b->nama_mhs }}</td>
                        <td>{{ $b->jurusan }}</td>
                        <td>{{ $b->alasan_pengajuan }}</td>
                        <td>{{ $b->created_at }}</td>
                        <td>{{ $b->updated_at }}</td>
                        <td>{{ $b->status }}</td>
                        </tr>
                        @endforeach
        </table>
        </div>
        
        
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<!-- <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script> -->
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>

<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('dist/js/demo.js')}}"></script>
<script src="{{asset('dist/js/pages/dashboard3.js')}}"></script>
</body>
</html>
@endsection