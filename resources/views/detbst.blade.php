@extends('layouts.top')
@section('content')
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Layanan BST</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
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
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Layanan BST</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="{{url('/aak')}}">Home</a></li>
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
      <table id="example" class="table table-striped table-bordered" data-order="[]">
      <thead>
        <tr>
                      <th>NIM - Nama</th>
                      <th>Jurusan</th>
                      <th>Alasan Pengajuan</th>
                      <th>Tanggal Pengajuan</th>
                      <th>Aksi</th>
                    
                    </tr>
                  </thead>
                  <tbody>
                    @IF ($bsmaha->count()>0)
                    <tr>
                    @foreach($bsmaha as $b)
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $b->id }}">
                    <td>{{ $b->nim }} - {{ $b->nama_mhs }}</td>
		              	<td>{{ $b->jurusan }}</td>
		              	<td>{{ $b->alasan_pengajuan }}</td>
		              	<td>{{ $b->created_at }}</td>
		              	<td><a class="btn btn-success" href="{{url('/detbst/stjbst/'.$b->id)}}">Proses</a>
                  </td>
                    </tr>
                    @endforeach
                    @ENDIF
    </table>
    </div>
    </div></div>
    <!-- /.content -->
  </div>
    
<!-- ./wrapper -->

<!-- jQuery -->

<!-- jQuery UI 1.11.4 -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
<!-- Data table -->

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<!-- tooltip -->
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
<!-- Penghitung huruf -->
<script>
  counter = function() {
    var value = $('#alasan').val();

    if (value.length == 0) {

        // $('#wordCount').html(0);
        $('#totalChars').html(200);
        // $('#charCount').html(0);
        // $('#charCountNoSpace').html(0);
        return;
    }

    var regex = /\s+/gi;
    // var wordCount = value.trim().replace(regex, ' ').split(' ').length;
    var totalChars = 200 - value.length;
    // var charCount = value.trim().length;
    // var charCountNoSpace = value.replace(regex, '').length;

    
    // $('#wordCount').html(wordCount);
    $('#totalChars').html(totalChars);
    // $('#charCount').html(charCount);
    // $('#charCountNoSpace').html(charCountNoSpace);
};

$(document).ready(function() {
    $('#alasan').click(counter);
    $('#alasan').change(counter);
    $('#alasan').keydown(counter);
    $('#alasan').keypress(counter);
    $('#alasan').keyup(counter);
    $('#alasan').blur(counter);
    $('#alasan').focus(counter);
});
</script>
</body>
</html>
@endsection