@extends('layouts.topmhs')
@section('content')
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Layanan Dispensasi</title>

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
            <h1 class="m-0 text-dark">Dispensasi Sakit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/mhs')}}">Home </a>/ Pengajuan Layanan - Dispensasi Sakit</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        @IF ($dpmaha->count()>0 || $dpmahas->count()>0 || $dpmahass->count()>0 || $dpmahasss->count()>0 || $dpmahassss->count()>0 || $dpmahasssss->count()>0)
        <div class="table-responsive" style="padding:20px;width: 98%;">
      <table id="example" class="table table-striped table-bordered">
      <thead>
        <tr>
                      <th>NIM - Nama</th>
                      <th>Jurusan</th>
                      <th>File</th>
                      <th>Alasan Pengajuan</th>
                      <th>Tanggal Pengajuan</th>
                      <th>Status</th>
                      @IF ($dpmahasss->count()>0 || $dpmahassss->count()>0 || $dpmahasssss->count()>0)
                      <th>Aksi</th>
                      @ENDIF
                    
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Proses -->
                    @IF ($dpmaha->count()>0)
                    <tr>
                    @foreach($dpmaha as $d)
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $d->id }}">
                    <td>{{ $d->nim }} - {{ $d->nama_mhs }}</td>
		              	<td>{{ $d->jurusan }}</td>
		              	<td><a href="storage/berkas_mhs/{{ $d->nim }}_{{ $d->jenis }}/{{ $d->berkas_dispensasi }}">{{ $d->berkas_dispensasi }}</a></td>
		              	<td>{{ $d->alasan_pengajuan }}</td>
		              	<td>{{ $d->created_at }}</td>
		              	@IF($d->status == 'proses' || $d->status == 'update ke dosen')
                    <td>Proses ke Dosen Wali</td>
		              	@ELSEIF($d->status == 'update ke kaprodi')
                    <td>Proses ke Kaprodi</td>
                    @ENDIF
		              	</tr>
                    @endforeach
                    <!-- Setuju by dosen -->
                    @ELSEIF ($dpmahas->count()>0)
                    <tr>
                    @foreach($dpmahas as $d)
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $d->id }}">
                    <td>{{ $d->nim }} - {{ $d->nama_mhs }}</td>
		              	<td>{{ $d->jurusan }}</td>
		              	<td><a href="storage/berkas_mhs/{{ $d->nim }}_{{ $d->jenis }}/{{ $d->berkas_dispensasi }}">{{ $d->berkas_dispensasi }}</a></td>
                    <td>{{ $d->alasan_pengajuan }}</td>
		              	<td>{{ $d->created_at }}</td>
		              	<td>Telah disetujui oleh Dosen Wali</td>
                    </tr>
                    @endforeach
                    <!-- Setuju by kaprodi -->
                    @ELSEIF ($dpmahass->count()>0)
                    <tr>
                    @foreach($dpmahass as $d)
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $d->id }}">
                    <td>{{ $d->nim }} - {{ $d->nama_mhs }}</td>
		              	<td>{{ $d->jurusan }}</td>
		              	<td><a href="storage/berkas_mhs/{{ $d->nim }}_{{ $d->jenis }}/{{ $d->berkas_dispensasi }}">{{ $d->berkas_dispensasi }}</a></td>
                    <td>{{ $d->alasan_pengajuan }}</td>
		              	<td>{{ $d->created_at }}</td>
		              	<td>Telah disetujui oleh Kaprodi</td>
                    </tr>
                    @endforeach
                    <!-- ditolak by dosen -->
                    @ELSEIF ($dpmahasss->count()>0)
                    <tr>
                    @foreach($dpmahasss as $d)
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $d->id }}">
                    <td>{{ $d->nim }} - {{ $d->nama_mhs }}</td>
		              	<td>{{ $d->jurusan }}</td>
		              	<td><a href="storage/berkas_mhs/{{ $d->nim }}_{{ $d->jenis }}/{{ $d->berkas_dispensasi }}">{{ $d->berkas_dispensasi }}</a></td>
                    <td>{{ $d->alasan_pengajuan }}</td>
		              	<td>{{ $d->created_at }}</td>
		              	<td>Ditolak oleh dosen karena {{ $d->alasan_penolakan }}</td>
		              	<td>
                      <button class="btn btn-danger" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">
                          Edit Data
                        </button>

                        <div id="id01" class="modal">
                            <form role="form" class="modal-content animate" action="/editdispen/{{$d->id}}" method="POST" enctype="multipart/form-data">
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
                              <label for="exampleInputPassword1">Jurusan</label>
                              <input type="nama" class="form-control" name="jurusan" value=" {{ Auth::user()->jurusan }} " disabled>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Fakultas</label>
                              <input type="nama" class="form-control" name="fakultas" value=" {{ Auth::user()->fakultas }} " disabled>
                            </div>
                            <div class="form-group">
                            <div class="row">
                                <div class="col">
                                  <label for="exampleInputPassword1">Tanggal Awal</label>  
                                  <input type="date" name="absen" value="<?php echo date('Y-m-d',strtotime($d->tanggal_absen)) ?>" class="form-control" required>
                                </div>
                                <div class="col">
                                  <label for="exampleInputPassword1">Tanggal Akhir</label>
                                  <input type="date" name="masuk" value="<?php echo date('Y-m-d',strtotime($d->tanggal_masuk)) ?>" class="form-control" required>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="exampleFormControlTextarea1">Alasan Pengajuan</label>
                              <textarea class="form-control" name="alasan" rows="3" required>{{ $d->alasan_pengajuan }}</textarea>
                            </div>
                            <!-- <div class="form-group">
                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" style="margin-left:1px">
                              <label class="form-check-label" for="flexRadioDefault1" style="margin-left:17px">
                                Upload file
                              </label>

                              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" style="margin-left:8px">
                                <label class="form-check-label" for="flexRadioDefault1" style="margin-left:25px">
                                  Tidak upload file
                                </label>
                            </div> -->
                            <div class="form-group">
                            <label for="exampleInputPassword1">Upload berkas dispensasi</label>
                                <div class="custom-file" style="margin-bottom:10px;">
                                  <input type="file" value="{{ $d->berkas_dispensasi }}" name="berkas_dispensasi" onchange="return validasiberkas()" class="form-control-file" id="berkas_dispensasi">
                                  <span><i> Max. 2 MB dengan format .PDF , lewati jika tidak perlu mengupload file. </i></span>
                                </div>
                            </div>
                                
                                <button class ="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                    <!-- Ditolak by kaprodi -->
                    @ELSEIF ($dpmahassss->count()>0)
                    <tr>
                    @foreach($dpmahassss as $d)
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $d->id }}">
                    <td>{{ $d->nim }} - {{ $d->nama_mhs }}</td>
		              	<td>{{ $d->jurusan }}</td>
		              	<td>{{ $d->berkas_dispensasi }}</td>
                    <td>{{ $d->alasan_pengajuan }}</td>
		              	<td>{{ $d->created_at }}</td>
		              	<td>Ditolak oleh kaprodi karena {{ $d->alasan_penolakan }}</td>
                    <td>
                      <button class="btn btn-danger" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">
                          Edit Data
                        </button>

                        <div id="id01" class="modal">
                            <form role="form" class="modal-content animate" action="/editdispen/{{$d->id}}" method="POST" enctype="multipart/form-data">
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
                              <label for="exampleInputPassword1">Jurusan</label>
                              <input type="nama" class="form-control" name="jurusan" value=" {{ Auth::user()->jurusan }} " disabled>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Fakultas</label>
                              <input type="nama" class="form-control" name="fakultas" value=" {{ Auth::user()->fakultas }} " disabled>
                            </div>
                            <div class="form-group">
                            <div class="row">
                                <div class="col">
                                  <label for="exampleInputPassword1">Tanggal Awal</label>  
                                  <input type="date" name="absen" value="{{ $d->tanggal_absen }}" class="form-control" required>
                                </div>
                                <div class="col">
                                  <label for="exampleInputPassword1">Tanggal Akhir</label>
                                  <input type="date" name="masuk" value="{{ $d->tanggal_masuk }}" class="form-control" required>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="exampleFormControlTextarea1">Alasan Pengajuan</label>
                              <textarea class="form-control" name="alasan" rows="3" required>{{ $d->alasan_pengajuan }}</textarea>
                            </div>
                            <div class="form-group">
                            <label for="exampleInputPassword1" class="required">Upload berkas dispensasi</label>
                                <div class="custom-file" style="margin-bottom:10px;">
                                  <input type="file" name="berkas_dispensasi" value="{{ $d->berkas_dispensasi }}" onchange="return validasiberkas()" class="form-control-file" id="berkas_dispensasi">
                                  <span><i> Max. 2 MB dengan format .PDF </i></span>
                                </div>
                            </div>
                                
                                <button class ="btn btn-danger" type="submit">Submit</button>
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
        <div class="card card-primary" style="height:86%">

              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="/uploaddispensasi" method="POST" enctype="multipart/form-data">
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
                          <label for="exampleInputPassword1">Jurusan</label>
                          <input type="nama" class="form-control" name="jurusan" value=" {{ Auth::user()->jurusan }} " disabled>
                        </div>
                        <div class="col">
                          <label for="exampleInputPassword1">Fakultas</label>
                          <input type="nama" class="form-control" name="fakultas" value=" {{ Auth::user()->fakultas }} " disabled>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col">
                          <label for="exampleInputPassword1">Tanggal Awal</label>  
                          <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" required>
                        </div>
                        <div class="col">
                          <label for="exampleInputPassword1">Tanggal Akhir</label>
                          <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Alasan Pengajuan</label>
                      <textarea class="form-control" name="alasan" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1" class="required">Upload berkas dispensasi</label>
                        <div class="custom-file">
                          <input type="file" name="berkas_dispensasi" onchange="return validasiberkas()" class="form-control-file" id="berkas_dispensasi" required>
                          <span><i> Max. 2 MB dengan format .PDF </i></span>
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

<script>
      function validasiberkas() {
            var dispensasi = document.getElementById('berkas_dispensasi');
            var filedispen = dispensasi.value;
           
            // Allowing file type
            var allowedExtensions = /(\.pdf)$/i;
            var allowedFilesize = dispensasi.files[0].size;
            
              
            if (!allowedExtensions.exec(filedispen)) {
                alert('Mohon maaf, jenis file anda tidak benar. Hanya menerima format .PDF!');
                berkas_dispensasi.value = '';
                return false;
            }else if(allowedFilesize > 2097152){
                alert('Mohon maaf, ukuran file anda lebih dari 2 MB!');
                berkas_dispensasi.value = '';
                return false;
            }
        }
</script>

<!-- <script>
    awal = new Date(dateform['tanggal_awal'].value);
    akhir = new Date(dateform['tanggal_akhir'].value);
    
    
    var tgl_awal = awal;
    var tgl_akhir = akhir;
    
    if(tgl_awal < tgl_akhir){
        
        alert('Mohon maaf, jenis file anda tidak benar. Hanya menerima format .doc & .pdf!');
        
        tanggal-masuk.value='';
        tanggal-keluar.value='';
        
        return false;
    }
</script> -->
</body>
</html>
@endsection