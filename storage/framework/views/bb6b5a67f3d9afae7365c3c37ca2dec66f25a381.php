
<?php $__env->startSection('content'); ?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Layanan BST</title>

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
      /* btn{
        color:white;
      } */

        /* Full-width input fields */
        input[type=text], input[type=password] {
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
          z-index: 1; /* Sit on top */
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
          
        @keyframes  animatezoom {
          from {transform: scale(0)} 
          to {transform: scale(1)}
        }

        /* Change styles for span and cancel button on extra small screens */
        @media  screen and (max-width: 300px) {
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
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Layanan BST</h1>
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
                      <th>Jurusan</th>
                      <th>Alasan Pengajuan</th>
                      <th>Tanggal Masuk</th>
                      <th>Aksi</th>
                    
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php $__currentLoopData = $bsmaha; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="id" value="<?php echo e($b->id); ?>">
                    <td><?php echo e($b->nim); ?></td>
		              	<td><?php echo e($b->nama_mhs); ?></td>
		              	<td><?php echo e($b->jurusan); ?></td>
		              	<td><?php echo e($b->alasan_pengajuan); ?></td>
		              	<td><?php echo e($b->created_at); ?></td>
		              	<td>
                      <a class="btn btn-success" href="<?php echo e(url('/dosdetbst/stjbst/'.$b->id)); ?>">Setuju</a>
                      <!-- <a class="btn btn-danger" href="<?php echo e(url('/dosdetbst/dostlkbst/'.$b->id)); ?>">Tolak -->
                      <button class="btn btn-danger" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">
                        Tolak
                      </button>

                      <div id="id01" class="modal">
                          <form class="modal-content animate" action="/dosdetbst/tlkbst/'.$b->id" method="post">
                            <?php echo csrf_field(); ?>
                          <div class="container" style="padding:16px;">
                              <label for="uname"><b>Alasan Penolakan :</b></label>
                              <input type="text" placeholder="Tuliskan alasan anda menolak pengajuan ini" name="alasan" id="alasan" required>
                              
                              <button class ="btn btn-danger" type="submit">Submit</button>
                            </div>
                          </form>
                      </div>

                  </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
    </div>

    <div class="table-responsive" style="padding:20px;width: 98%;">
      <table id="example" class="table table-striped table-bordered">
      <thead>
        <tr>
                      <th>NIM</th>
                      <th>Nama</th>
                      <th>Jurusan</th>
                      <th>Alasan Pengajuan</th>
                      <th>Tanggal Masuk</th>
                      <th>Status</th>
                    
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php $__currentLoopData = $bsmahas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="id" value="<?php echo e($bs->id); ?>">
                    <td><?php echo e($bs->nim); ?></td>
		              	<td><?php echo e($bs->nama_mhs); ?></td>
		              	<td><?php echo e($bs->jurusan); ?></td>
		              	<td><?php echo e($bs->alasan_pengajuan); ?></td>
		              	<td><?php echo e($bs->created_at); ?></td>
		              	<?php if($bs->status == 'selesai'): ?>
                      <td>Disetujui</td>
                    <?php else: ?>
                      <td>Disetujui</td>
                    <?php endif; ?>
                    
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
</body>
</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.topdos', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\layanan\resources\views/dosdetbst.blade.php ENDPATH**/ ?>