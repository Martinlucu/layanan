
<?php $__env->startSection('content'); ?>
<?php if(session('alert')): ?>
    <div class="alert alert-success">
        <?php echo e(session('alert')); ?>

    </div>
<?php endif; ?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Dahboard Mahasiswa</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome-free/css/all.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('dist/css/adminlte.min.css')); ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition layout-top-nav">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Home</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo e(url('/mhs')); ?>">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          
           
          </div>
         
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
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
<?php echo $__env->make('layouts.topmhs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\layanan\resources\views//mhs.blade.php ENDPATH**/ ?>