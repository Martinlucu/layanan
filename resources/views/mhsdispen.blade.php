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
</head>
<body class="hold-transition layout-top-nav">


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dispensasi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/mhs')}}">Home / Pengajuan Layanan-Dispensasi</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        @IF ($dpmaha->count()>0 || $dpmahas->count()>0 || $dpmahass->count()>0)
        <div class="table-responsive" style="padding:20px;width: 98%;">
      <table id="example" class="table table-striped table-bordered">
      <thead>
        <tr>
                      <th>NIM</th>
                      <th>Nama</th>
                      <th>Jurusan</th>
                      <th>File</th>
                      <th>Tanggal Pengajuan</th>
                      <th>Status</th>
                    
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    @foreach($dpmaha as $d)
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $d->id }}">
                    <td>{{ $d->nim }}</td>
		              	<td>{{ $d->nama_mhs }}</td>
		              	<td>{{ $d->jurusan }}</td>
		              	<td>{{ $d->berkas }}</td>
		              	<td>{{ $d->created_at }}</td>
		              	<td>{{ $d->status }}
                  </td>
                    </tr>
                    @endforeach
    </table>
    </div>
        @ELSE
        <div class="row">
        <div class="col-md-6">
        <div class="card card-primary">

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
                          <input type="date" name="absen" class="form-control" required>
                        </div>
                        <div class="col">
                          <label for="exampleInputPassword1">Tanggal Akhir</label>
                          <input type="date" name="masuk" class="form-control" required>
                        </div>
                      </div>
                      </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Upload berkas ketidakhadiran</label>
                        <div class="custom-file" style="margin-bottom:10px;">
                          <input type="file" name="berkas_ketidakhadiran" class="form-control-file" id="exampleformcontrolfile1" required>
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
</body>
</html>
@endsection