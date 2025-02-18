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

  <style>
      /* btn{
        color:white;
      } */

        /* Full-width input fields */
        textarea {
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
          width: 80%; /* Could be more or less, depending on screen size */
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
      @if (session('alert'))
            <div class="alert alert-success">
                {{ session('alert') }}
            </div>
        @endif
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Berhenti Studi Tetap (BST)</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/mhs')}}">Home </a>/ Pengajuan Layanan - Berhenti Studi Tetap(BST)</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        @IF ($bsmaha->count()>0 || $bsmahas->count()>0 || $bsmahass->count()>0 || $bsmahasss->count()>0 || $bsmahassss->count()>0 || $bsmahasssss->count()>0 || $bsmahassssss->count()>0 || $bsmahasssssss->count()>0 || $bsmahassssssss->count()>0)
        <div class="table-responsive" style="padding:20px;width: 98%;">
           <table id="example" class="table table-striped table-bordered">
      <thead>
        <tr>
                      <th>NIM - Nama</th>
                      <th>Jurusan</th>
                      <th>Alasan Pengajuan</th>
                      <th>Tanggal Masuk</th>
                      <th>Status</th>
                      @IF ($bsmahasss->count()>0 || $bsmahassss->count()>0 || $bsmahasssss->count()>0 || $bsmahasssssss->count()>0 || $bsmahassssssss->count()>0)
                      <th>Aksi</th>
                      @ENDIF
                    
                    </tr>
                  </thead>
                  <tbody>
                     <!-- Proses -->
                     @IF ($bsmaha->count()>0)
                    <tr>
                    @foreach($bsmaha as $d)
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $d->id }}">
                    <td>{{ $d->nim }} - {{ $d->nama_mhs }}</td>
		              	<td>{{ $d->jurusan }}</td>
		              	<td>{{ $d->alasan_pengajuan }}</td>
		              	<td>{{ $d->created_at }}</td>
                    @IF($d->status == 'proses' || $d->status == 'update ke dosen')
                    <td>Proses ke Dosen Wali</td>
		              	@ELSEIF($d->status == 'update ke kaprodi')
                    <td>Proses ke Kaprodi</td>
                    @ENDIF
                  </td>
                    </tr>
                    @endforeach
                    <!-- Setuju by dosen -->
                    @ELSEIF ($bsmahas->count()>0)
                    <tr>
                    @foreach($bsmahas as $d)
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $d->id }}">
                    <td>{{ $d->nim }} - {{ $d->nama_mhs }}</td>
		              	<td>{{ $d->jurusan }}</td>
		              	<td>{{ $d->alasan_pengajuan }}</td>
		              	<td>{{ $d->created_at }}</td>
		              	<td>Telah disetujui oleh Dosen Wali</td>
                    </tr>
                    @endforeach
                    <!-- Setuju by kaprodi -->
                    @ELSEIF ($bsmahass->count()>0)
                    <tr>
                    @foreach($bsmahass as $d)
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $d->id }}">
                    <td>{{ $d->nim }} - {{ $d->nama_mhs }}</td>
		              	<td>{{ $d->jurusan }}</td>
		              	<td>{{ $d->alasan_pengajuan }}</td>
		              	<td>{{ $d->created_at }}</td>
		              	<td>Telah disetujui oleh Kaprodi</td>
                    </tr>
                    @endforeach
                    <!-- ditolak by dosen -->
                    @ELSEIF ($bsmahasss->count()>0)
                    <tr>
                    @foreach($bsmahasss as $d)
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $d->id }}">
                    <td>{{ $d->nim }} - {{ $d->nama_mhs }}</td>
		              	<td>{{ $d->jurusan }}</td>
		              	<td>{{ $d->alasan_pengajuan }}</td>
		              	<td>{{ $d->created_at }}</td>
		              	<td>Ditolak oleh dosen karena {{ $d->alasan_penolakan }}</td>
		              	<td>
                      <button class="btn btn-danger" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">
                          Edit Data
                        </button>

                        <div id="id01" class="modal">
                            <form role="form" class="modal-content animate" action="/editbst/{{$d->id}}" method="POST" enctype="multipart/form-data">
                              @csrf
                            <div class="container" style="padding:16px;">
                            <div class="form-group">
                    <div class="row">
                      <div class="col">
                          <label for="exampleInputEmail1">NIM </label>
                          <input type="nim" class="form-control" name="nim" value=" {{ Auth::user()->nim }} " disabled>
                      </div>
                      <div class="col">
                        <label for="exampleInputPassword1">Nama</label>
                        <input type="nama" class="form-control" name="nama" value=" {{ Auth::user()->nama }} " disabled>
                      </div>
                  </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">No. Telp</label>
                    <input type="nama" class="form-control" name="no_telp" value=" {{ Auth::user()->no_telp }} " disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Alasan Pengajuan</label>
                    <textarea class="form-control" name="alasan" name="alasan" rows="3" required>{{ $d->alasan_pengajuan }}</textarea>
                  </div>
                                
                                <button class ="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                    <!-- Ditolak by kaprodi -->
                    @ELSEIF ($bsmahassss->count()>0)
                    <tr>
                    @foreach($bsmahassss as $d)
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $d->id }}">
                    <td>{{ $d->nim }} - {{ $d->nama_mhs }}</td>
		              	<td>{{ $d->jurusan }}</td>
                    <td>{{ $d->alasan_pengajuan }}</td>
		              	<td>{{ $d->created_at }}</td>
		              	<td>Ditolak oleh kaprodi karena {{ $d->alasan_penolakan }}</td>
		              	<td>
                      <button class="btn btn-danger" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">
                          Edit Data
                        </button>

                        <div id="id01" class="modal">
                            <form role="form" class="modal-content animate" action="/editbst/{{$d->id}}" method="POST" enctype="multipart/form-data">
                              @csrf
                            <div class="container" style="padding:16px;">
                            <div class="form-group">
                    <div class="row">
                      <div class="col">
                          <label for="exampleInputEmail1">NIM </label>
                          <input type="nim" class="form-control" name="nim" value=" {{ Auth::user()->nim }} " disabled>
                      </div>
                      <div class="col">
                        <label for="exampleInputPassword1">Nama</label>
                        <input type="nama" class="form-control" name="nama" value=" {{ Auth::user()->nama }} " disabled>
                      </div>
                  </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">No. Telp</label>
                    <input type="nama" class="form-control" name="no_telp" value=" {{ Auth::user()->no_telp }} " disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Alasan Pengajuan</label>
                    <textarea class="form-control" name="alasan" name="alasan" rows="3" required></textarea>
                  </div>
                                
                                <button class ="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                    @ENDIF
    </table>
        </div>
        @ELSE
        <div class="row">
        <div class="col-md-12">
        <div class="card card-primary">

              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="/uploadbst">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <div class="row">
                      <div class="col">
                          <label for="exampleInputEmail1">NIM</label>
                          <input type="nim" class="form-control" name="nim" value=" {{ Auth::user()->nim }} " disabled>
                      </div>
                      <div class="col">
                        <label for="exampleInputPassword1">Nama</label>
                        <input type="nama" class="form-control" name="nama" value=" {{ Auth::user()->nama }} " disabled>
                      </div>
                  </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">No. Telp</label>
                    <input type="nama" class="form-control" name="nama" value=" {{ Auth::user()->no_telp }} " disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Alasan Pengajuan</label>
                    <textarea class="form-control" name="alasan" rows="3" required></textarea>
                  </div>
                  </div>
                
                </div>
                <!-- /.card-body -->

                
                  <button type="submit" class="btn btn-primary btn-block">Submit</button>
                
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
        @ENDIF
        
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>

<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('dist/js/demo.js')}}"></script>
<script src="{{asset('dist/js/pages/dashboard3.js')}}"></script>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function validasibop() {
            var bop = document.getElementById('struk_bop');
            var filebop = bop.value;
           
          
            // Allowing file type
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
              
            if (!allowedExtensions.exec(filetoefl)) {
                alert('Mohon maaf, jenis file anda tidak benar. Hanya menerima format jpg/jpeg/png!');
                berkas_toefl.value = '';
                return false;
            }
        }
</script>
</body>
</html>
@endsection