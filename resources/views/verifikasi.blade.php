@extends('layouts.topverifikasi')
@section('content')
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Layanan Verifikasi Pengajuan Mahasiswa</title>

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
            <h1 class="m-0 text-dark">Verifikasi Data Pengajuan</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
        <div class="col-md-8">
        <div class="card card-primary">

              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="/uploadbst">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Pembuatan Pengajuan</label>
                    <textarea style="font-family:courier" class="form-control" name="pembuatan_pengajuan" id="pembuatan_pengajuan" rows="7" readonly>
                      ID Pengajuan : 
                      NIM :
                      Nama :
                      Jenis Pengajuan :
                      Status Pengajuan :
                      Tanggal/Jam :
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Disetujui oleh Dosen Wali</label>
                    <textarea style="font-family:courier" class="form-control" name="disetujui_dosen_wali" id="disetujui_dosen_wali" rows="7" readonly>
                      
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Disetujui oleh Kaprodi</label>
                    <textarea style="font-family:courier" class="form-control" name="disetujui_kaprodi" id="disetujui_kaprodi" rows="7" readonly>

                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Disetujui oleh Bag. AAK</label>
                    <textarea style="font-family:courier"class="form-control" name="disetujui_aak" id="disetujui_aak" rows="7" readonly>

                    </textarea>
                  </div>
                  </div>
                
                </div>
                <!-- /.card-body -->

                
                  
                
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
        
        
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