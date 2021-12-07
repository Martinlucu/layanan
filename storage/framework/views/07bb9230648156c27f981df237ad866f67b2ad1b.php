
<?php $__env->startSection('content'); ?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Layanan Yudisium</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome-free/css/all.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('dist/css/adminlte.min.css')); ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
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
              <li class="breadcrumb-item"><a href="<?php echo e(url('/mhs')); ?>">Home / Pengajuan Layanan-Yudisium</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
        <div class="col-md-6">
        <div class="card card-primary">

              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="/uploadyudisium" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <?php echo csrf_field(); ?>
                    <div class="form-group">
                      <div class="row">
                        <div class="col">
                          <label for="exampleInputEmail1">NIM</label>
                          <input type="nim" class="form-control" name="nim" value=" <?php echo e(Auth::user()->nim); ?> " disabled>
                        </div>
                        <div class="col">
                          <label for="exampleInputPassword1">Nama</label>
                          <input type="nama" class="form-control" name="nama" value=" <?php echo e(Auth::user()->nama); ?> " disabled>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col">
                          <label for="exampleInputEmail1">Tempat Lahir</label>
                          <input type="tempat_lahir" class="form-control" name="tempat_lahir" value=" <?php echo e(Auth::user()->tempat_lahir); ?> " disabled>
                        </div>
                        <div class="col">
                          <label for="exampleInputPassword1">Tanggal Lahir</label>
                          <input type="text" class="form-control" name="tanggal_lahir" value=" <?php echo e(Auth::user()->tanggal_lahir); ?> " disabled>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">No. KTP</label>
                      <input type="number" class="form-control" name="no_ktp" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Alamat</label>
                      <input type="nama" class="form-control" name="alamat" value=" <?php echo e(Auth::user()->alamat); ?> " disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">No. Telfon</label>
                      <input type="nama" class="form-control" name="no_telp" value=" <?php echo e(Auth::user()->no_telp); ?> " disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">E-mail Dinamika</label>
                      <input type="nama" class="form-control" name="email" value=" <?php echo e(Auth::user()->email); ?> " disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Upload Foto 3x4 Berwarna</label>
                          <div class="custom-file" style="margin-bottom:10px;">
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
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo e(asset('plugins/jquery/jquery.min.js')); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('dist/js/adminlte.min.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/chart.js/Chart.min.js')); ?>"></script>
<script src="<?php echo e(asset('dist/js/demo.js')); ?>"></script>
<script src="<?php echo e(asset('dist/js/pages/dashboard3.js')); ?>"></script>
</body>
</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.topmhs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\layanan\resources\views/mhsyudi.blade.php ENDPATH**/ ?>