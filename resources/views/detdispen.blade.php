@extends('layouts.top')
@section('content')
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Layanan Dispensasi Sakit</title>

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

<style>
      /* btn{
        color:white;
      } */

        /* Full-width input fields */
        textarea{
          width: 100%;
          padding: 12px 20px;
          margin: 8px 0;
          display: inline-block;
          border: 1px solid #ccc;
          box-sizing: border-box;
        }

        /* Set a style for all buttons */
        button {
          background-color: #04AA6D;
          color: white;
          padding: 14px 20px;
          margin: 8px 0;
          border: none;
          cursor: pointer;
          width: 100%;
        }

        button:hover {
          opacity: 0.8;
        }

        /* Extra styles for the cancel button */
        .cancelbtn {
          width: auto;
          padding: 10px 18px;
          background-color: #f44336;
        }

        

        /* The Modal (background) */
        .modal {
          display: none; /* Hidden by default */
          position: fixed; /* Stay in place */
          z-index: 4; /* Sit on top */
          left: 0;
          top: 0;
          width: 100%; /* Full width */
          height: 100%; /* Full height */
          overflow: auto; /* Enable scroll if needed */
          background-color: rgb(0,0,0); /* Fallback color */
          background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
          padding-top: 60px;
        }

        /* Modal Content/Box */
        .modal-content {
          background-color: #fefefe;
          margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
          border: 1px solid #888;
          width: 50%; /* Could be more or less, depending on screen size */
        }

        /* The Close Button (x) */
        .close {
          position: absolute;
          right: 25px;
          top: 0;
          color: #000;
          font-size: 35px;
          font-weight: bold;
        }

        .close:hover,
        .close:focus {
          color: red;
          cursor: pointer;
        }

        /* Add Zoom Animation */
        .animate {
          -webkit-animation: animatezoom 0.6s;
          animation: animatezoom 0.6s
        }

        @-webkit-keyframes animatezoom {
          from {-webkit-transform: scale(0)} 
          to {-webkit-transform: scale(1)}
        }
          
        @keyframes animatezoom {
          from {transform: scale(0)} 
          to {transform: scale(1)}
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
          span.psw {
            display: block;
            float: none;
          }
          .cancelbtn {
            width: 100%;
          }
        }
    </style>
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
            <h1 class="m-0">Layanan Dispensasi Sakit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="{{url('/aak')}}">Home &nbsp</a>/ Layanan Dispensasi Sakit</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container">
    <div class="table-responsive" style="padding:20px;width: 100%;">
      <table id="example" class="table table-striped table-bordered" data-order="[]">
      <thead>
                    <tr>
                      <th>NIM - Nama</th>
                      <th>Jurusan</th>
                      <th>Alasan Pengajuan</th>
                      <th>Berkas</th>
                      <th>Tanggal Pengajuan</th>
                      <th>Aksi</th>
                    
                    </tr>
                  </thead>
                  <tbody>
                  @IF ($dpmaha->count()>0 || $dpmahaa->count()>0)
                    <tr>
                    @IF ($dpmaha->count()>0)
                    @foreach($dpmaha as $d)
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $d->id }}">
                    <td>
                      {{ $d->nim }} - {{ $d->nama_mhs }}
                    </td>
		              	<td>{{ $d->jurusan }}</td>
		              	<td>{{ $d->alasan_pengajuan }}</td>
		              	<td>
                      <a href="storage/berkas_mhs/{{ $d->nim }}_{{ $d->jenis }}/{{ $d->berkas_dispensasi }}"><img src="{{ asset('storage/icon/pdf.png') }}" width="40" height="50"></a>
                    </td>
		              	<td>{{ $d->created_at }}</td>
		              	<td> <a class="btn btn-success" href="{{url('/detdispen/stjdis/'.$d->id)}}">Setuju</a>
                    <button class="btn btn-danger" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">
                          Tolak
                        </button>

                        <div id="id01" class="modal">
                            <form role="form" class="modal-content animate" action="/detdispen/tlkdis/{{$d->id}}" method="POST">
                              @csrf
                            <div class="container" style="padding:16px;">
                                <label for="uname"><b>Alasan Penolakan :</b></label>
                                <b><span style ="float:right;"><span id="totalChars">200</span> Karakter tersisa</span></b>
                                <textarea name="alasan" id="alasan" maxlength="200" placeholder="Tuliskan alasan anda menolak pengajuan ini, Max. 200 karakter" cols="5" rows="5"></textarea>
                                
                                <button class ="btn btn-primary" type="submit">Submit</button>
                        </div>
                  </td>
                    </tr>
                    @endforeach
                    @ELSE
                    <tr>
                    @foreach($dpmahaa as $d)
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $d->id }}">
                    <td>{{ $d->nim }} - {{ $d->nama_mhs }}</td>
		              	<td>{{ $d->jurusan }}</td>
                    <td>{{ $d->alasan_pengajuan }}</td>
		              	<td>{{ $d->berkas_dispensasi }}</td>
		              	<td>{{ $d->created_at }}</td>
		              	<td> <a class="btn btn-success" href="{{url('/detdispen/stjdis/'.$d->id)}}">Setuju</a>
                    <button class="btn btn-danger" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">
                          Tolak
                        </button>

                        <div id="id01" class="modal">
                            <form role="form" class="modal-content animate" action="/detdispen/tlkdis/{{$d->id}}" method="POST">
                              @csrf
                            <div class="container" style="padding:16px;">
                                <label for="uname"><b>Alasan Penolakan :</b></label>
                                <b><span style ="float:right;"><span id="totalChars">200</span> Karakter tersisa</span></b>
                                <textarea name="alasan" id="alasan" maxlength="200" placeholder="Tuliskan alasan anda menolak pengajuan ini, Max. 200 karakter" cols="5" rows="5"></textarea>
                                
                                <button class ="btn btn-danger" type="submit">Submit</button>
                        </div>
                  </td>
                    </tr>
                    @endforeach
                    @ENDIF
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