
<?php $__env->startSection('content'); ?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Setting Target</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome-free/css/all.min.css')); ?>">
  <!-- Ionicons -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('dist/css/adminlte.min.css')); ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">
  <!-- Daterange picker -->
  <!-- summernote -->
  <!-- Data table -->
  <link rel="stylesheet" href="<?php echo e(asset('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css')); ?>">
  <script src="<?php echo e(asset('https://code.jquery.com/jquery-3.5.1.js')); ?>"></script>
  <script src="<?php echo e(asset('https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js')); ?>"></script>

    <script>
        $(document).ready(function () {
  $('#example').DataTable();
});
    </script>

    <style>
      btn{
        color:white;
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
            <h1 class="m-0">Setting</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="<?php echo e(url('/aak')); ?>">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container">
      <div class="row">
          <!-- left column -->
          <div class="col-md-6">
      <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Setting Target</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo e(url('updateset')); ?>" method="post" class="form-horizontal">
              <?php echo e(csrf_field()); ?>

                <div class="card-body">
                <h6>Merubah target setiap layanan</h6>
                  <div class="form-group row">
                  <?php $__currentLoopData = $setting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <input type="hidden" name="id_set" value="<?php echo e($s->id_set); ?>">
                    <label class="col-sm-3 col-form-label">Dispensasi</label>
                    <div class="input-group col-sm-5">
                      <input type="number" class="form-control" name="dispen" value="<?php echo e($s->dispensasi); ?>">
                      <div class="input-group-append">
                    <span class="input-group-text">Hari</span>
                  </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Yudisium</label>
                    <div class="input-group col-sm-5">
                      <input type="number" class="form-control" name="yudi" value="<?php echo e($s->yudisium); ?>">
                      <div class="input-group-append">
                    <span class="input-group-text">%</span>
                  </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Cuti</label>
                    <div class="input-group col-sm-5">
                      <input type="number" class="form-control" name="cut" value="<?php echo e($s->cuti); ?>">
                      <div class="input-group-append">
                    <span class="input-group-text">Hari</span>
                  </div></div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">BST</label>
                    <div class="input-group col-sm-5">
                      <input type="number" class="form-control" name="bst" value="<?php echo e($s->bst); ?>">
                      <div class="input-group-append">
                    <span class="input-group-text">Hari</span>
                  </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" class="btn btn-info" value="Update">
                </div>
                <!-- /.card-footer -->
              
             
            </div>
    </div>
    
    </div>
  </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<script src="<?php echo e(asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('dist/js/adminlte.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(asset('dist/js/demo.js')); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo e(asset('dist/js/pages/dashboard.js')); ?>"></script>
<!-- Data table -->

</body>
</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.top', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\layanan\resources\views/setting.blade.php ENDPATH**/ ?>