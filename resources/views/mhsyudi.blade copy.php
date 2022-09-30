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

    th{
      width: 250px;
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

        .required:after{
          content:"*";
          color: red;
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
      @IF ($ydmaha->count()>0 || $ydmahas->count()>0 || $ydmahass->count()>0)
        <div class="table-responsive" style="padding:20px;width: 98%;">
        <table id="example" class="table table-striped table-bordered"> <!--style="table-layout:fixed"-->
            <tbody>
                    <!-- Proses -->
                    @IF ($ydmaha->count()>0)
                    @foreach($ydmaha as $yd)
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $yd->id }}">
                    <tr>
                      <th>NIM - Nama</th>
                      <td>{{ $yd->nim }} - {{ $yd->nama_mhs }}</td>
                    </tr>
                    <tr>
                      <th>Tempat lahir</th>
                      <td>{{ $yd->tempat_lahir }}</td>
                    </tr>
                    <tr>
                      <th>Tanggal lahir</th>
                      <td>{{ $yd->tanggal_lahir }}</td>
                    </tr>
                    <tr>
                      <th>No. KTP</th>
                      <td>{{ $yd->no_ktp }}</td>  
                    </tr>
                    <tr>
                      <th>Alamat</th>
                      <td>{{ $yd->alamat }}</td>
                    </tr>
                    <tr>
                      <th>No. Telp</th>
                      <td>{{ $yd->no_telp }}</td>
                    </tr>
                    <tr>
                      <th>Email</th>
                      <td>{{ $yd->email_mhs }}</td>
                    </tr>
                    <tr>
                      <th>Berkas TOEFL</th>
                      <td>
                        <a href="storage/berkas_mhs/{{ $yd->nim }}_{{ $yd->jenis }}/{{ $yd->berkas_toefl }}">{{ $yd->berkas_toefl }}</a>
                      </td>
                    </tr>
                    <tr>
                      <th>Berkas Ijazah</th>
                      <td>
                        <a href="storage/berkas_mhs/{{ $yd->nim }}_{{ $yd->jenis }}/{{ $yd->berkas_ijazah }}">{{ $yd->berkas_ijazah }}</a>
                      </td>
                    </tr>  
                    <tr>
                      <th>Berkas KK</th>
                      <td>
                        <a href="storage/berkas_mhs/{{ $yd->nim }}_{{ $yd->jenis }}/{{ $yd->berkas_kk }}">{{ $yd->berkas_kk }}</a>
                      </td>
                    </tr>
                    <tr>
                      <th>Berkas KTP</th>
                      <td>
                        <a href="storage/berkas_mhs/{{ $yd->nim }}_{{ $yd->jenis }}/{{ $yd->berkas_ktp }}">{{ $yd->berkas_ktp }}</a>
                      </td>
                    </tr>
                    <tr>
                      <th>Berkas KTM</th>
                      <td>
                        <a href="storage/berkas_mhs/{{ $yd->nim }}_{{ $yd->jenis }}/{{ $yd->berkas_ktm }}">{{ $yd->berkas_ktm }}</a> 
                      </td>
                    </tr>
		                <tr>
                      <th>Tanggal Pengajuan</th>
                      <td>{{ $yd->created_at }}</td>
                    </tr>
		              	<tr>
                      <th>Status</th>
                      <td>{{ $yd->status }}</td>
                    </tr>
		              	@endforeach
                   <!-- Ditolak by aak -->
                   @ELSEIF ($ydmahas->count()>0)
                    @foreach($ydmahas as $yd)
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $yd->id }}">
                    <tr>
                      <th>NIM - Nama</th>
                      <td>{{ $yd->nim }} - {{ $yd->nama_mhs }}</td>
                    </tr>
                    <tr>
                      <th>Nama</th>
                      <td>{{ $yd->nama_mhs }}</td>
                    </tr>
		              	<tr>
                      <th>Tempat lahir</th>
                      <td>{{ $yd->tempat_lahir }}</td>
                    </tr>
                    <tr>
                      <th>Tanggal lahir</th>
                      <td>{{ $yd->tanggal_lahir }}</td>
                    </tr>
                    <tr>
                      <th>No. KTP</th>
                      <td>{{ $yd->no_ktp }}</td>
                    </tr>
                    <tr>
                      <th>Alamat</th>
                      <td>{{ $yd->alamat }}</td>
                    </tr>
                    <tr>
                      <th>No. Telp</th>
                      <td>{{ $yd->no_telp }}</td>
                    </tr>
                    <tr>
                      <th>Email</th>
                      <td>{{ $yd->email_mhs }}</td>
                    </tr>
                    <tr>
                      <th>Berkas akta</th>
                      <td>
                        <a href="storage/berkas_mhs/{{ $yd->nim }}_{{ $yd->jenis }}/{{ $yd->berkas_akta }}">{{ $yd->berkas_akta }}</a>
                      </td>
                    </tr>
                    <tr>
                      <th>Berkas SSKM</th>
                      <td>
                        <a href="storage/berkas_mhs/{{ $yd->nim }}_{{ $yd->jenis }}/{{ $yd->berkas_sskm }}">{{ $yd->berkas_sskm }}</a>
                      </td>
                    </tr>
                    <tr>
                      <th>Berkas TOEFL</th>
                      <td>
                        <a href="storage/berkas_mhs/{{ $yd->nim }}_{{ $yd->jenis }}/{{ $yd->berkas_toefl }}">{{ $yd->berkas_toefl }}</a>
                      </td>
                    </tr>
                    <tr>
                      <th>Berkas Ijazah</th>
                      <td>
                        <a href="storage/berkas_mhs/{{ $yd->nim }}_{{ $yd->jenis }}/{{ $yd->berkas_ijazah }}">{{ $yd->berkas_ijazah }}</a>
                      </td>
                    </tr>  
                    <tr>
                      <th>Berkas KK</th>
                      <td>
                        <a href="storage/berkas_mhs/{{ $yd->nim }}_{{ $yd->jenis }}/{{ $yd->berkas_kk }}">{{ $yd->berkas_kk }}</a>
                      </td>
                    </tr>
                    <tr>
                      <th>Berkas KTP</th>
                      <td>
                        <a href="storage/berkas_mhs/{{ $yd->nim }}_{{ $yd->jenis }}/{{ $yd->berkas_ktp }}">{{ $yd->berkas_ktp }}</a>
                      </td>
                    </tr>
                    <tr>
                      <th>Berkas KTM</th>
                      <td>
                        <a href="storage/berkas_mhs/{{ $yd->nim }}_{{ $yd->jenis }}/{{ $yd->berkas_ktm }}">{{ $yd->berkas_ktm }}</a> 
                      </td>
                    </tr>
                    <tr>
                      <th>Tanggal Pengajuan</th>
                      <td>{{ $yd->created_at }}</td>
                    </tr>
		              	<tr>
                      <th>Status</th>
                      <td>Ditolak oleh AAK karena {{ $yd->alasan_penolakan }}</td>
                    </tr>
		                @endforeach
                    <!-- Update by mhs -->
                    @ELSEIF ($ydmahass->count()>0)
                    @foreach($ydmahass as $yd)
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $yd->id }}">
                    <tr>
                      <th>NIM - Nama</th>
                      <td>{{ $yd->nim }} - {{ $yd->nama_mhs }}</td>
                    </tr>
                    <tr>
                      <th>Nama</th>
                      <td>{{ $yd->nama_mhs }}</td>
                    </tr>
		              	<tr>
                      <th>Tempat lahir</th>
                      <td>{{ $yd->tempat_lahir }}</td>
                    </tr>
                    <tr>
                      <th>Tanggal lahir</th>
                      <td>{{ $yd->tanggal_lahir }}</td>
                    </tr>
                    <tr>
                      <th>No. KTP</th>
                      <td>{{ $yd->no_ktp }}</td>  
                    </tr>
                    <tr>
                      <th>Alamat</th>
                      <td>{{ $yd->alamat }}</td>
                    </tr>
                    <tr>
                      <th>No. Telp</th>
                      <td>{{ $yd->no_telp }}</td>
                    </tr>
                    <tr>
                      <th>Email</th>
                      <td>{{ $yd->email_mhs }}</td>
                    </tr>
                    <tr>
                      <th>Berkas Akta</th>
                      <td>
                        <a href="storage/berkas_mhs/{{ $yd->nim }}_{{ $yd->jenis }}/{{ $yd->berkas_akta }}">{{ $yd->berkas_akta }}</a>
                      </td>
                    </tr>
                    <tr>
                      <th>Berkas SSKM</th>
                      <td>
                        <a href="storage/berkas_mhs/{{ $yd->nim }}_{{ $yd->jenis }}/{{ $yd->berkas_sskm }}">{{ $yd->berkas_sskm }}</a>
                      </td>
                    </tr>
                    <tr>
                      <th>Berkas TOEFL</th>
                      <td>
                        <a href="storage/berkas_mhs/{{ $yd->nim }}_{{ $yd->jenis }}/{{ $yd->berkas_toefl }}">{{ $yd->berkas_toefl }}</a>
                      </td>
                    </tr>
                    <tr>
                      <th>Berkas Ijazah</th>
                      <td>
                        <a href="storage/berkas_mhs/{{ $yd->nim }}_{{ $yd->jenis }}/{{ $yd->berkas_ijazah }}">{{ $yd->berkas_ijazah }}</a>
                      </td>
                    </tr>  
                    <tr>
                      <th>Berkas KK</th>
                      <td>
                        <a href="storage/berkas_mhs/{{ $yd->nim }}_{{ $yd->jenis }}/{{ $yd->berkas_kk }}">{{ $yd->berkas_kk }}</a>
                      </td>
                    </tr>
                    <tr>
                      <th>Berkas KTP</th>
                      <td>
                        <a href="storage/berkas_mhs/{{ $yd->nim }}_{{ $yd->jenis }}/{{ $yd->berkas_ktp }}">{{ $yd->berkas_ktp }}</a>
                      </td>
                    </tr>
                    <tr>
                      <th>Berkas KTM</th>
                      <td>
                        <a href="storage/berkas_mhs/{{ $yd->nim }}_{{ $yd->jenis }}/{{ $yd->berkas_ktm }}">{{ $yd->berkas_ktm }}</a> 
                      </td>
                    </tr>
		                <tr>
                      <th>Tanggal Pengajuan</th>
                      <td>{{ $yd->created_at }}</td>
                    </tr>
		              	<tr>
                      <th>Status</th>
                      <td>Sedang diproses oleh Bag. AAK</td>
                    </tr>
		              	@endforeach
                    @ENDIF
          </table>
    @IF ($ydmahas->count()>0)
    <button class="btn btn-danger" onclick="document.getElementById('id01').style.display='block'" style="width:100%;">
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
                          <input type="nim" value="{{ $yd->nim }}" class="form-control" maxlength="11" name="nim" required>
                        </div>
                        <div class="col">
                          <label for="exampleInputPassword1">Nama</label>
                          <input type="nama" value="{{ $yd->nama_mhs }}" class="form-control" name="nama" required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col">
                          <label for="exampleInputEmail1">Tempat Lahir</label>
                          <input type="text" value="{{ $yd->tempat_lahir }}" class="form-control" name="tempat_lahir" required>
                        </div>
                        <div class="col">
                          <label for="exampleInputPassword1">Tanggal Lahir</label>
                          <input type="date" value="{{ $yd->tanggal_lahir }}" class="form-control" name="tanggal_lahir" required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">No. KTP</label>
                      <input type="number" value="{{ $yd->no_ktp }}" maxlength="16" class="form-control" name="no_ktp" title="Format KTP adalah 16 karakter" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Alamat</label>
                      <input type="text" value="{{ $yd->alamat }}" class="form-control" name="alamat" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">No. Telfon</label>
                      <input type="tel" value="{{ $yd->no_telp }}" pattern="[0-9]{12}" maxlength="12" class="form-control" name="no_telp" title="Format no.telfon adalah kode telfon diikuti dengan nomor telfon max.12 karakter" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">E-mail Dinamika</label>
                      <input type="email" value="{{ $yd->email_mhs }}" class="form-control" name="email" title="format email harus menggunakan '@' dan '.com' " required>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Upload Bukti SSKM</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="foto" onchange="return validasisskm()" class="form-control-file" id="berkas_sskm" required>
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
                          </div>
                    </div>
                    <button class ="btn btn-danger" type="submit">Submit</button>
                  </div>
                </div>
                      @ENDIF
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
                          <label for="exampleInputEmail1" class="required">NIM</label>
                          <input type="number" max="11" class="form-control" name="nim" value="{{Auth::user()->nim}}" disabled>
                        </div>
                        <div class="col">
                          <label for="exampleInputPassword1" class="required">Nama</label>
                          <input type="text" class="form-control" name="nama" value="{{Auth::user()->nama}}" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col">
                          <label for="exampleInputEmail1">Tempat Lahir</label>
                          <input type="text" class="form-control" name="tempat_lahir" value="{{Auth::user()->tempat_lahir}}" disabled>
                        </div>
                        <div class="col">
                          <label for="exampleInputPassword1">Tanggal Lahir</label>
                          <input type="date" class="form-control" name="tanggal_lahir" value="{{Auth::user()->tanggal_lahir}}" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">No. KTP</label>
                      <input type="number" max="16" class="form-control" name="no_ktp" value="{{Auth::user()->no_ktp}}" disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Alamat</label>
                      <input type="text" class="form-control" name="alamat" value="{{Auth::user()->alamat}}" disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">No. Telfon</label>
                      <input type="tel" max="12" class="form-control" name="no_telp" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">E-mail Dinamika</label>
                      <input type="email" class="form-control" name="email" value="{{Auth::user()->email}}" disabled>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                  
            </div>
            <div class="col-md-6">
              <div class="card card-primary" style="height:97.5%;">
                <div class="card-body">
                  <div class="form-group">
                    <div class="row">
                      <div class="col">
                      <label for="exampleInputPassword1" class="required">Upload Bukti SSKM</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="sskm" onchange="return validasisskm()" class="form-control-file" id="berkas_sskm" required>
                          </div>
                      </div>
                      <div class="col">
                      <label for="exampleInputPassword1" class="required">Upload Sertifikat Toefl/Toeic</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="toefl" onchange="return validasitoefl()" class="form-control-file" id="berkas_toefl" required>
                          </div>
                      </div>
                    </div>
                    <div class="row" style="padding-top:30px;">
                      <div class="col">
                      <label for="exampleInputPassword1" class="required">Upload Ijazah SMA</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ijazah_sma" onchange="return validasiijazah()" class="form-control-file" id="berkas_ijazah" required>
                          </div>
                      </div>
                      <div class="col">
                      <label for="exampleInputPassword1" class="required">Upload Akta Kelahiran</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="akta" onchange="return validasiakta()" class="form-control-file" id="berkas_akta" required>
                          </div>
                      </div>
                    </div>
                    <div class="row" style="padding-top:30px;">
                      <div class="col">
                      <label for="exampleInputPassword1" class="required">Upload Kartu Keluarga</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="kk" onchange="return validasikk()" class="form-control-file" id="berkas_kk" required>
                          </div>
                      </div>
                      <div class="col">
                      <label for="exampleInputPassword1" class="required">Upload Kartu Tanda Mahasiswa</label>
                          <div class="custom-file" style="margin-bottom:10px;">
                            <input type="file" name="ktm" onchange="return validasiktm()" class="form-control-file" id="berkas_ktm" required>
                          </div>
                      </div>
                    </div>  
                    <label for="exampleInputPassword1" class="required" style="padding-top:30px;">Upload Kartu Tanda Penduduk</label>
                      <div class="custom-file" style="margin-bottom:10px;">
                      <input type="file" name="ktp" onchange="return validasiktp()" class="form-control-file" id="berkas_ktp" required>
                          </div>
                    </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Submit</button>
              </form>
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

<!-- Checking format file sebelum upload -->
<script>
        function validasisskm() {
            var sskm = document.getElementById('berkas_sskm');
            var filesskm = sskm.value;
           
          
            // Allowing file type
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
            var allowedFilesize = sskm.files[0];
              
            if (!allowedExtensions.exec(filefoto) && allowedFilesize < 2097152) {
                alert('Mohon maaf, jenis file anda tidak benar. Hanya menerima format jpg/jpeg/png/PDF!');
                berkas_foto.value = '';
                return false;
            }else{
                alert('Mohon maaf, ukuran file anda lebih dari 2 MB!');
                berkas_foto.value = '';
                return false;
            }
        }

        function validasitoefl() {
            var toefl = document.getElementById('berkas_toefl');
            var filetoefl = toefl.value;
           
          
            // Allowing file type
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
            var allowedFilesize = toefl.files[0];
              
            if (!allowedExtensions.exec(filetoefl && allowedFilesize < 2097152)) {
                alert('Mohon maaf, jenis file anda tidak benar. Hanya menerima format jpg/jpeg/png/PDF!');
                berkas_toefl.value = '';
                return false;
            }else{
                alert('Mohon maaf, ukuran file anda lebih dari 2 MB!');
                berkas_toefl.value = '';
                return false;
            }
        }
          
        function validasiijazah() {
            var ijazah = document.getElementById('berkas_ijazah');
            var fileijazah = ijazah.value;
           
          
            // Allowing file type
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
            var allowedFilesize = ijazah.files[0];
              
            if (!allowedExtensions.exec(fileijazah) && allowedFilesize < 2097152) {
                alert('Mohon maaf, jenis file anda tidak benar. Hanya menerima format jpg/jpeg/png/PDF!');
                berkas_ijazah.value = '';
                return false;
            }else{
                alert('Mohon maaf, ukuran file anda lebih dari 2 MB!');
                berkas_ijazah.value = '';
                return false;
            }
        }

        function validasiakta() {
            var akta = document.getElementById('berkas_akta');
            var fileakta = akta.value;
           
          
            // Allowing file type
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
            var allowedFilesize = akta.files[0];
              
            if (!allowedExtensions.exec(fileakta) && allowedFilesize < 2097152) {
                alert('Mohon maaf, jenis file anda tidak benar. Hanya menerima format jpg/jpeg/png/PDF!');
                berkas_akta.value = '';
                return false;
            }else{
                alert('Mohon maaf, ukuran file anda lebih dari 2 MB!');
                berkas_akta.value = '';
                return false;
            }
        }

        function validasikk() {
            var kk = document.getElementById('berkas_kk');
            var filekk = kk.value;
           
          
            // Allowing file type
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
            var allowedFilesize = kk.files[0];
              
            if (!allowedExtensions.exec(filekk) && allowedFilesize < 2097152) {
                alert('Mohon maaf, jenis file anda tidak benar. Hanya menerima format jpg/jpeg/png/PDF!');
                berkas_kk.value = '';
                return false;
            }else{
                alert('Mohon maaf, ukuran file anda lebih dari 2 MB!');
                berkas_kk.value = '';
                return false;
            }
        }

        function validasiktm() {
            var ktm = document.getElementById('berkas_ktm');
            var filektm = ktm.value;
           
          
            // Allowing file type
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
            var allowedFilesize = ktm.files[0];
              
            if (!allowedExtensions.exec(filektm && allowedFilesize < 2097152)) {
                alert('Mohon maaf, jenis file anda tidak benar. Hanya menerima format jpg/jpeg/png/PDF!');
                berkas_ktm.value = '';
                return false;
            }else{
                alert('Mohon maaf, ukuran file anda lebih dari 2 MB!');
                berkas_ktm.value = '';
                return false;
            }
        }

        function validasiktp() {
            var ktp = document.getElementById('berkas_ktp');
            var filektp = ktp.value;
           
          
            // Allowing file type
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
            var allowedFilesize = ktp.files[0];
              
            if (!allowedExtensions.exec(filektp) && allowedFilesize < 2097152) {
                alert('Mohon maaf, jenis file anda tidak benar. Hanya menerima format jpg/jpeg/png/PDF!');
                berkas_ktp.value = '';
                return false;
            }else{
                alert('Mohon maaf, ukuran file anda lebih dari 2 MB!');
                berkas_ktp.value = '';
                return false;
            }
        }
    </script>
</body>
</html>
@endsection