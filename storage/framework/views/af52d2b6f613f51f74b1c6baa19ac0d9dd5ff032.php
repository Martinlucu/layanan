
<?php $__env->startSection('content'); ?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Layanan Cuti</title>

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
            <h1 class="m-0">Layanan Cuti</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="<?php echo e(url('/aak')); ?>">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container">
    <div class="table-responsive" style="padding:20px;width: 98%;">
      <table id="example" class="table table-striped table-bordered">
      <thead>
        <tr>
                      <th>NIM</th>
                      <th>Nama</th>
                      <th>E-mail</th>
                      <th>Jurusan</th>
                      <th>Alasan Pengajuan</th>
                      <th>Tanggal Masuk</th>
                      <th>Aksi</th>
                    
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php $__currentLoopData = $ctmaha; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="id" value="<?php echo e($c->id); ?>">
                    <td><?php echo e($c->nim); ?></td>
		              	<td><?php echo e($c->nama_mhs); ?></td>
			              <td><?php echo e($c->email_mhs); ?></td>
		              	<td><?php echo e($c->jurusan); ?></td>
		              	<td><?php echo e($c->alasan_pengajuan); ?></td>
		              	<td><?php echo e($c->created_at); ?></td>
		              	<td> <a class="btn btn-success" href="<?php echo e(url('/detcuti/stjcuti/'.$c->id)); ?>">Setuju
                    <a class="btn btn-danger" href="<?php echo e(url('/detcuti/tlkcuti/'.$c->id)); ?>">Tolak
                  </td>
                    </tr>
                   
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php echo $__env->make('layouts.top', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\layanan\resources\views/detcuti.blade.php ENDPATH**/ ?>