@extends('layouts.topmhs')
@section('content')
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Layanan Yudisium</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
  </style>

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
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Yudisium</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/mhs')}}">Home / Pengajuan Layanan-Yudisium</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
      @IF ($ydmaha->count()>0 || $ydmahas->count()>0 || $ydmahass->count()>0 || $ydmahasss->count()>0 || $ydmahassss->count()>0 || $ydmahasssss->count()>0)
        <div class="table-responsive" style="padding:20px;width: 98%;">
        <table id="example" class="table table-striped table-bordered">
      <thead>
        <tr>
        <th>NIM</th>
                      <th>Nama</th>
                      <th>Tempat lahir</th>
                      <th>Tanggal lahir</th>
                      <th>No. KTP</th>
                      <th>Alamat</th>
                      <th>No. Telp</th>
                      <th>Berkas</th>
                      <th>Tanggal Pengajuan</th>
                      <th>Status</th>
                      @IF ($ydmahasss->count()>0 || $ydmahassss->count()>0 || $ydmahasssss->count()>0)
                      <th>Aksi</th>
                      @ENDIF
                    
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Proses -->
                    @IF ($ydmaha->count()>0)
                    <tr>
                    @foreach($ydmaha as $yd)
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $yd->id }}">
                    <td>{{ $yd->nim }}</td>
		              	<td>{{ $yd->nama_mhs }}</td>
                    <td>{{ $yd->tempat_lahir }}</td>
                    <td>{{ $yd->tanggal_lahir }}</td>
                    <td>{{ $yd->no_ktp }}</td>
                    <td>{{ $yd->alamat }}</td>
                    <td>{{ $yd->no_telp }}</td>
                    <td>{{ $yd->email_mhs }}</td>
		              	<td>{{ $yd->berkas }} </td>
		              	<td>{{ $yd->created_at }}</td>
		              	<td>{{ $yd->status }}
                  </td>
                    </tr>
                    @endforeach
                    <!-- Setuju by dosen -->
                    @ELSEIF ($ydmahas->count()>0)
                    <tr>
                    @foreach($ydmahas as $yd)
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $yd->id }}">
                    <td>{{ $yd->nim }}</td>
		              	<td>{{ $yd->nama_mhs }}</td>
                    <td>{{ $yd->tempat_lahir }}</td>
                    <td>{{ $yd->tanggal_lahir }}</td>
                    <td>{{ $yd->no_ktp }}</td>
                    <td>{{ $yd->alamat }}</td>
                    <td>{{ $yd->no_telp }}</td>
                    <td>{{ $yd->email_mhs }}</td>
		              	<td>{{ $yd->berkas }} </td>
		              	<td>{{ $yd->created_at }}</td>
		              	<td>{{ $yd->status }}
                  </td>
                    </tr>
                    @endforeach
                    <!-- Setuju by kaprodi -->
                    @ELSEIF ($ydmahass->count()>0)
                    <tr>
                    @foreach($ydmahass as $yd)
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $yd->id }}">
                    <td>{{ $yd->nim }}</td>
		              	<td>{{ $yd->nama_mhs }}</td>
                    <td>{{ $yd->tempat_lahir }}</td>
                    <td>{{ $yd->tanggal_lahir }}</td>
                    <td>{{ $yd->no_ktp }}</td>
                    <td>{{ $yd->alamat }}</td>
                    <td>{{ $yd->no_telp }}</td>
                    <td>{{ $yd->email_mhs }}</td>
		              	<td>{{ $yd->berkas }} </td>
		              	<td>{{ $yd->created_at }}</td>
		              	<td>{{ $yd->status }}
                  </td>
                    </tr>
                    @endforeach
                    <!-- ditolak by dosen -->
                    @ELSEIF ($ydmahasss->count()>0)
                    <tr>
                    @foreach($ydmahasss as $yd)
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $yd->id }}">
                    <td>{{ $yd->nim }}</td>
		              	<td>{{ $yd->nama_mhs }}</td>
                    <td>{{ $yd->tempat_lahir }}</td>
                    <td>{{ $yd->tanggal_lahir }}</td>
                    <td>{{ $yd->no_ktp }}</td>
                    <td>{{ $yd->alamat }}</td>
                    <td>{{ $yd->no_telp }}</td>
                    
		              	<td>{{ $yd->berkas }} </td>
		              	<td>{{ $yd->created_at }}</td>
		              	<td>Ditolak oleh dosen karena {{ $yd->alasan_penolakan }}</td>
		              	<td>
                      <button class="btn btn-danger" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">
                          Edit Data
                        </button>

                        <div id="id01" class="modal">
                            <form role="form" class="modal-content animate" action="/edityudisium/{{$yd->id}}" method="POST" enctype="multipart/form-data">
                              @csrf
                            <div class="container" style="padding:16px;">
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
                      <div class="row">
                        <div class="col">
                          <label for="exampleInputEmail1">Tempat Lahir</label>
                          <input type="tempat_lahir" class="form-control" name="tempat_lahir" value=" {{ Auth::user()->tempat_lahir }} " disabled>
                        </div>
                        <div class="col">
                          <label for="exampleInputPassword1">Tanggal Lahir</label>
                          <input type="text" class="form-control" name="tanggal_lahir" value=" {{ Auth::user()->tanggal_lahir }} " disabled>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">No. KTP</label>
                      <input type="number" class="form-control" value="{{ Auth::user()->no_ktp }}" name="no_ktp" disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Alamat</label>
                      <input type="nama" class="form-control" name="alamat" value=" {{ Auth::user()->alamat }} " disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">No. Telfon</label>
                      <input type="nama" class="form-control" name="no_telp" value=" {{ Auth::user()->no_telp }} " disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">E-mail Dinamika</label>
                      <input type="nama" class="form-control" name="email" value=" {{ Auth::user()->email }} " disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Upload Foto 3x4 Berwarna</label>
                          <div class="custom-file" style="margin-bottom:10px;">
<<<<<<< HEAD
                            <input type="file" name="foto" class="form-control-file" onchange="return validasifoto()" id="berkas_foto" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Toefl/Toeic</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="toefl" class="form-control-file" onchange="return validasitoefl()" id="berkas_toefl" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Ijazah SMA</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ijazah_sma" class="form-control-file" onchange="return validasiijazaj()" id="berkas_ijazah" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Akta Kelahiran</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="akta" class="form-control-file" onchange="return validasiakta()" id="berkas_akta" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Kartu Keluarga</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="kk" class="form-control-file" onchange="return validasikk()" id="berkas_kk" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Kartu Tanda Mahasiswa</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ktm" class="form-control-file" onchange="return validasiktm()" id="berkas_ktm" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Kartu Tanda Penduduk</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ktp" class="form-control-file" onchange="return validasiktp()" id="berkas_ktp" required>
=======
                            <input type="file" name="foto" class="form-control-file" id="exampleformcontrolfile1" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Toefl/Toeic</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="toefl" class="form-control-file" id="exampleformcontrolfile1" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Ijazah SMA</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ijazah_sma" class="form-control-file" id="exampleformcontrolfile1" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Akta Kelahiran</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="akta" class="form-control-file" id="exampleformcontrolfile1" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Kartu Keluarga</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="kk" class="form-control-file" id="exampleformcontrolfile1" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Kartu Tanda Mahasiswa</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ktm" class="form-control-file" id="exampleformcontrolfile1" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Kartu Tanda Penduduk</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ktp" class="form-control-file" id="exampleformcontrolfile1" required>
>>>>>>> parent of 2e6eec1 (Merge branch 'main' of https://github.com/Martinlucu/layanan)
                          </div>
                    </div>
                    <button class ="btn btn-danger" type="submit">Submit</button>
                  </div>
                </div>
                    </td>
                    </tr>
                    @endforeach
                    <!-- Ditolak by kaprodi -->
                    @ELSEIF ($ydmahassss->count()>0)
                    <tr>
                    @foreach($ydmahassss as $yd)
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $yd->id }}">
                    <td>{{ $yd->nim }}</td>
		              	<td>{{ $yd->nama_mhs }}</td>
                    <td>{{ $yd->tempat_lahir }}</td>
                    <td>{{ $yd->tanggal_lahir }}</td>
                    <td>{{ $yd->no_ktp }}</td>
                    <td>{{ $yd->alamat }}</td>
                    <td>{{ $yd->no_telp }}</td>
                    <td>{{ $yd->email_mhs }}</td>
		              	<td>{{ $yd->berkas }} </td>
		              	<td>{{ $yd->created_at }}</td>
		              	<td>Ditolak oleh kaprodi karena {{ $yd->alasan_penolakan }}</td>
		              	<td>
                      <button class="btn btn-danger" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">
                          Edit Data
                        </button>

                        <div id="id01" class="modal">
                            <form role="form" class="modal-content animate" action="/edityudisium/{{$yd->id}}" method="POST" enctype="multipart/form-data">
                              @csrf
                            <div class="container" style="padding:16px;">
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
                      <div class="row">
                        <div class="col">
                          <label for="exampleInputEmail1">Tempat Lahir</label>
                          <input type="tempat_lahir" class="form-control" name="tempat_lahir" value=" {{ Auth::user()->tempat_lahir }} " disabled>
                        </div>
                        <div class="col">
                          <label for="exampleInputPassword1">Tanggal Lahir</label>
                          <input type="text" class="form-control" name="tanggal_lahir" value=" {{ Auth::user()->tanggal_lahir }} " disabled>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">No. KTP</label>
                      <input type="number" class="form-control" value="{{ Auth::user()->no_ktp }}" name="no_ktp" disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Alamat</label>
                      <input type="nama" class="form-control" name="alamat" value=" {{ Auth::user()->alamat }} " disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">No. Telfon</label>
                      <input type="nama" class="form-control" name="no_telp" value=" {{ Auth::user()->no_telp }} " disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">E-mail Dinamika</label>
                      <input type="nama" class="form-control" name="email" value=" {{ Auth::user()->email }} " disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Upload Foto 3x4 Berwarna</label>
                          <div class="custom-file" style="margin-bottom:10px;">
<<<<<<< HEAD
                            <input type="file" name="foto" class="form-control-file" onchange="return validasifoto()" id="berkas_foto" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Toefl/Toeic</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="toefl" class="form-control-file" onchange="return validasitoefl()" id="berkas_toefl" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Ijazah SMA</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ijazah_sma" class="form-control-file" onchange="return validasiijazah()" id="berkas_ijazah" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Akta Kelahiran</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="akta" class="form-control-file" onchange="return validasiakta()" id="berkas_akta" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Kartu Keluarga</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="kk" class="form-control-file" onchange="return validasikk()" id="berkas_kk" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Kartu Tanda Mahasiswa</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ktm" class="form-control-file" onchange="return validasiktm()" id="berkas_ktm" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Kartu Tanda Penduduk</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ktp" class="form-control-file" onchange="return validasiktp()" id="berkas_ktp" required>
=======
                            <input type="file" name="foto" class="form-control-file" id="exampleformcontrolfile1" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Toefl/Toeic</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="toefl" class="form-control-file" id="exampleformcontrolfile1" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Ijazah SMA</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ijazah_sma" class="form-control-file" id="exampleformcontrolfile1" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Akta Kelahiran</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="akta" class="form-control-file" id="exampleformcontrolfile1" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Kartu Keluarga</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="kk" class="form-control-file" id="exampleformcontrolfile1" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Kartu Tanda Mahasiswa</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ktm" class="form-control-file" id="exampleformcontrolfile1" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Kartu Tanda Penduduk</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ktp" class="form-control-file" id="exampleformcontrolfile1" required>
>>>>>>> parent of 2e6eec1 (Merge branch 'main' of https://github.com/Martinlucu/layanan)
                          </div>
                    </div>
                    <button class ="btn btn-danger" type="submit">Submit</button>
                  </div>
                </div>
                    </td>
                    </tr>
                    @endforeach
                    <!-- Ditolak by aak -->
                    @ELSE
                    <tr>
                    @foreach($ydmahasssss as $yd)
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $yd->id }}">
                    <td>{{ $yd->nim }}</td>
		              	<td>{{ $yd->nama_mhs }}</td>
                    <td>{{ $yd->tempat_lahir }}</td>
                    <td>{{ $yd->tanggal_lahir }}</td>
                    <td>{{ $yd->no_ktp }}</td>
                    <td>{{ $yd->alamat }}</td>
                    <td>{{ $yd->no_telp }}</td>
                    <td>{{ $yd->email_mhs }}</td>
		              	<td>{{ $yd->berkas }} </td>
		              	<td>{{ $yd->created_at }}</td>
		              	<td>Ditolak oleh AAK karena {{ $yd->alasan_penolakan }}</td>
		              	<td>
                      <button class="btn btn-danger" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">
                          Edit Data
                        </button>

                        <div id="id01" class="modal">
                            <form role="form" class="modal-content animate" action="/edityudisium/{{$yd->id}}" method="POST" enctype="multipart/form-data">
                              @csrf
                            <div class="container" style="padding:16px;">
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
                      <div class="row">
                        <div class="col">
                          <label for="exampleInputEmail1">Tempat Lahir</label>
                          <input type="tempat_lahir" class="form-control" name="tempat_lahir" value=" {{ Auth::user()->tempat_lahir }} " disabled>
                        </div>
                        <div class="col">
                          <label for="exampleInputPassword1">Tanggal Lahir</label>
                          <input type="text" class="form-control" name="tanggal_lahir" value=" {{ Auth::user()->tanggal_lahir }} " disabled>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">No. KTP</label>
                      <input type="number" class="form-control" value="{{ Auth::user()->no_ktp }}" name="no_ktp" disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Alamat</label>
                      <input type="nama" class="form-control" name="alamat" value=" {{ Auth::user()->alamat }} " disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">No. Telfon</label>
                      <input type="nama" class="form-control" name="no_telp" value=" {{ Auth::user()->no_telp }} " disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">E-mail Dinamika</label>
                      <input type="nama" class="form-control" name="email" value=" {{ Auth::user()->email }} " disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Upload Foto 3x4 Berwarna</label>
                          <div class="custom-file" style="margin-bottom:10px;">
<<<<<<< HEAD
                            <input type="file" name="foto" class="form-control-file" onchange="return validasifoto()" id="berkas_foto" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Toefl/Toeic</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="toefl" class="form-control-file" onchange="return validasitoefl()" id="berkas_toefl" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Ijazah SMA</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ijazah_sma" class="form-control-file" onchange="return validasiijazah()" id="berkas_ijazah" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Akta Kelahiran</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="akta" class="form-control-file" onchange="return validasiakta()" id="berkas_akta" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Kartu Keluarga</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="kk" class="form-control-file" onchange="return validasikk()" id="berkas_kk" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Kartu Tanda Mahasiswa</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ktm" class="form-control-file" onchange="return validasiktm()" id="berkas_ktm" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Kartu Tanda Penduduk</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ktp" onchange="return validasiktp()" class="form-control-file" id="berkas_ktp" required>
=======
                            <input type="file" name="foto" class="form-control-file" id="exampleformcontrolfile1" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Toefl/Toeic</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="toefl" class="form-control-file" id="exampleformcontrolfile1" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Ijazah SMA</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ijazah_sma" class="form-control-file" id="exampleformcontrolfile1" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Akta Kelahiran</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="akta" class="form-control-file" id="exampleformcontrolfile1" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Kartu Keluarga</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="kk" class="form-control-file" id="exampleformcontrolfile1" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Kartu Tanda Mahasiswa</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ktm" class="form-control-file" id="exampleformcontrolfile1" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Kartu Tanda Penduduk</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ktp" class="form-control-file" id="exampleformcontrolfile1" required>
>>>>>>> parent of 2e6eec1 (Merge branch 'main' of https://github.com/Martinlucu/layanan)
                          </div>
                    </div>
                    <button class ="btn btn-danger" type="submit">Submit</button>
                  </div>
                </div>
                    </td>
                    </tr>
                    @endforeach
                    
                    @ENDIF
    </table>
      </div>
        @ELSE
        <div class="row">
        <div class="col-md-6">
        <div class="card card-primary">

              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="/uploadyudisium" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  @csrf
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
                      <div class="row">
                        <div class="col">
                          <label for="exampleInputEmail1">Tempat Lahir</label>
                          <input type="tempat_lahir" class="form-control" name="tempat_lahir" value=" {{ Auth::user()->tempat_lahir }} " disabled>
                        </div>
                        <div class="col">
                          <label for="exampleInputPassword1">Tanggal Lahir</label>
                          <input type="text" class="form-control" name="tanggal_lahir" value=" {{ Auth::user()->tanggal_lahir }} " disabled>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">No. KTP</label>
                      <input type="number" class="form-control" value="{{ Auth::user()->no_ktp }}" name="no_ktp" disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Alamat</label>
                      <input type="nama" class="form-control" name="alamat" value=" {{ Auth::user()->alamat }} " disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">No. Telfon</label>
                      <input type="nama" class="form-control" name="no_telp" value=" {{ Auth::user()->no_telp }} " disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">E-mail Dinamika</label>
                      <input type="nama" class="form-control" name="email" value=" {{ Auth::user()->email }} " disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Upload Foto 3x4 Berwarna</label>
                          <div class="custom-file" style="margin-bottom:10px;">
<<<<<<< HEAD
                            <input type="file" name="foto" onchange="return validasifoto()" class="form-control-file" id="berkas_foto" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Toefl/Toeic</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="toefl" onchange="return validasitoefl()" class="form-control-file" id="berkas_toefl" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Ijazah SMA</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ijazah_sma" onchange="return validasiijazah()" class="form-control-file" id="berkas_ijazah" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Akta Kelahiran</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="akta" onchange="return validasiakta()" class="form-control-file" id="berkas_akta" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Kartu Keluarga</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="kk" onchange="return validasikk()" class="form-control-file" id="berkas_kk" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Kartu Tanda Mahasiswa</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ktm" onchange="return validasiktm()" class="form-control-file" id="berkas_ktm" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Kartu Tanda Penduduk</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ktp" onchange="return validasiktp()" class="form-control-file" id="berkas_ktp" required>
=======
                            <input type="file" name="foto" class="form-control-file" id="exampleformcontrolfile1" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Toefl/Toeic</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="toefl" class="form-control-file" id="exampleformcontrolfile1" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Ijazah SMA</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ijazah_sma" class="form-control-file" id="exampleformcontrolfile1" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Akta Kelahiran</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="akta" class="form-control-file" id="exampleformcontrolfile1" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Kartu Keluarga</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="kk" class="form-control-file" id="exampleformcontrolfile1" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Kartu Tanda Mahasiswa</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ktm" class="form-control-file" id="exampleformcontrolfile1" required>
                          </div>
                      <label for="exampleInputPassword1">Upload Scan Berwarna Kartu Tanda Penduduk</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ktp" class="form-control-file" id="exampleformcontrolfile1" required>
>>>>>>> parent of 2e6eec1 (Merge branch 'main' of https://github.com/Martinlucu/layanan)
                          </div>
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
</script>
<<<<<<< HEAD

<!-- Checking format file sebelum upload -->
<script>
        function validasifoto() {
            var foto = document.getElementById('berkas_foto');
            var filefoto = foto.value;
           
          
            // Allowing file type
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
              
            if (!allowedExtensions.exec(filefoto)) {
                alert('Mohon maaf, jenis file anda tidak benar. Hanya menerima format jpg/jpeg/png!');
                berkas_foto.value = '';
                return false;
            }
        }

        function validasitoefl() {
            var toefl = document.getElementById('berkas_toefl');
            var filetoefl = toefl.value;
           
          
            // Allowing file type
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
              
            if (!allowedExtensions.exec(filetoefl)) {
                alert('Mohon maaf, jenis file anda tidak benar. Hanya menerima format jpg/jpeg/png!');
                berkas_toefl.value = '';
                return false;
            }
        }
          
        function validasiijazah() {
            var ijazah = document.getElementById('berkas_ijazah');
            var fileijazah = ijazah.value;
           
          
            // Allowing file type
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
              
            if (!allowedExtensions.exec(fileijazah)) {
                alert('Mohon maaf, jenis file anda tidak benar. Hanya menerima format jpg/jpeg/png!');
                berkas_ijazah.value = '';
                return false;
            }
        }

        function validasiakta() {
            var akta = document.getElementById('berkas_akta');
            var fileakta = akta.value;
           
          
            // Allowing file type
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
              
            if (!allowedExtensions.exec(fileakta)) {
                alert('Mohon maaf, jenis file anda tidak benar. Hanya menerima format jpg/jpeg/png!');
                berkas_akta.value = '';
                return false;
            }
        }

        function validasikk() {
            var kk = document.getElementById('berkas_kk');
            var filekk = kk.value;
           
          
            // Allowing file type
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
              
            if (!allowedExtensions.exec(filekk)) {
                alert('Mohon maaf, jenis file anda tidak benar. Hanya menerima format jpg/jpeg/png!');
                berkas_kk.value = '';
                return false;
            }
        }

        function validasiktm() {
            var ktm = document.getElementById('berkas_ktm');
            var filektm = ktm.value;
           
          
            // Allowing file type
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
              
            if (!allowedExtensions.exec(filektm)) {
                alert('Mohon maaf, jenis file anda tidak benar. Hanya menerima format jpg/jpeg/png!');
                berkas_ktm.value = '';
                return false;
            }
        }

        function validasiktp() {
            var ktp = document.getElementById('berkas_ktp');
            var filektp = ktp.value;
           
          
            // Allowing file type
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
              
            if (!allowedExtensions.exec(filektp)) {
                alert('Mohon maaf, jenis file anda tidak benar. Hanya menerima format jpg/jpeg/png!');
                berkas_ktp.value = '';
                return false;
            }
        }
    </script>
=======
>>>>>>> parent of 2e6eec1 (Merge branch 'main' of https://github.com/Martinlucu/layanan)
</body>
</html>
@endsection