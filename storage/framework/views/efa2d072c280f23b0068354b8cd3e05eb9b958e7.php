
<?php $__env->startSection('content'); ?>
<html lang="en">
<head>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Dahboard Cuti</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome-free/css/all.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('dist/css/adminlte.min.css')); ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition layout-top-nav">
<div class="modal fade" id="cuti">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Detail Cuti</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
		
        <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>NIM</th>
                      <th>Nama</th>
                      
                      <th>Jurusan</th>
                      <th>Tanggal Masuk</th>
                      <th>Tanggal Keluar</th>
                    
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php $__currentLoopData = $cutimaha; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td><?php echo e($ct->nim); ?></td>
		              	<td><?php echo e($ct->nama_mhs); ?></td>
			             
		              	<td><?php echo e($ct->jurusan); ?></td>
                    <td><?php echo e($ct->created_at); ?></td>
                    <td><?php echo e($ct->updated_at); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
              </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="Proses">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Layanan Cuti Proses</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
        <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>NIM</th>
                      <th>Nama</th>
                     
                      <th>Jurusan</th>
                      <th>Tanggal Masuk</th>
                    
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php $__currentLoopData = $cut; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ci): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td><?php echo e($ci->nim); ?></td>
		              	<td><?php echo e($ci->nama_mhs); ?></td>
			             
		              	<td><?php echo e($ci->jurusan); ?></td>
		              	<td><?php echo e($ci->created_at); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
              </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
			</div>
		</div>
	</div>
</div>
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard Cuti</h1>
           
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <!-- AREA CHART -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Jumlah Layanan Cuti</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                
              </div>
              <div class="card-body">
               <div>
               <canvas id="speedChart" width="600" height="400"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- DONUT CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Jurusan</h3>
                <div class="card-tools">
                
                <a  id="cuti" name="cuti" data-toggle="modal" data-target="#cuti"  class="btn btn-danger" style="text-decoration: underline">Detail</a>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
              <div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand">
              </div><div class="chartjs-size-monitor-shrink"><div class="">
              </div>
              </div></div><canvas id="oilChart" width="600" height="400"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            
          </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-6">
            <!-- LINE CHART -->
          
            <!-- /.card -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Indikator</h3>
                <div class="card-tools">
                <a  id="proses" name="proses" data-toggle="modal" data-target="#proses"  class="btn btn-warning" style="text-decoration: underline">Detail</a>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
              <?php $__currentLoopData = $set; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
              $datenow = date("Y-m-d",strtotime("-$s->cuti weekday"));
              ?>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             <?php $__currentLoopData = $datecut; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
              $cis= $c->created_at;
              ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php if($cut->count()>0): ?>
              <h5>Jumlah layanan yang belum diproses, batas proses <?php echo e($s->cuti); ?> hari</h5>
              <div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand">
              </div><div class="chartjs-size-monitor-shrink"><div class="">
              </div>
           
              </div></div> <center><div id="some_element"></div></center>
              <?php if($datenow>$cis): ?>
              <center><h3 style="color:#CD113B">Kurang</h3></center>
              <?php endif; ?>
              <?php if($datenow==$cis): ?>
              <center><h3 style="color:#FF7600">Cukup</h3></center>
              <?php endif; ?>
              <?php if($datenow<$cis): ?>
              <center><h3 style="color:#6384FF">Baik</h3></center>
              <?php endif; ?>
              <?php else: ?>
              <h5>Jumlah Permohonan Cuti Kosong</h5>
              <div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand">
              </div><div class="chartjs-size-monitor-shrink"><div class="">
              </div>
              </div></div> <center><div id="some_element"></div></center>
              <center><h3 style="color:#6384FF">Baik</h3></center>
              <?php endif; ?>
              </div>
              </div>
          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
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
<script src="<?php echo e(asset('js/pureknob.js')); ?>" type="text/javascript"></script>
<script type="text/javascript">
		
    function demoKnob() {
      // Create knob element, 300 x 300 px in size.
      const knob = pureknob.createKnob(300, 300);

      // Set properties.
      knob.setProperty('angleStart', -0.75 * Math.PI);
      knob.setProperty('angleEnd', 0.75 * Math.PI);
      <?php if($cut->count()>0): ?>
      <?php if($datenow>$cis): ?>
      knob.setProperty('colorFG', '#CD113B');
      <?php endif; ?>
      <?php if($datenow==$cis): ?>
      knob.setProperty('colorFG', '#FF7600');
      <?php endif; ?>
      <?php if($datenow<$cis ): ?>
      knob.setProperty('colorFG', '#6384FF');
      <?php endif; ?>
      <?php else: ?>
      knob.setProperty('colorFG', '#6384FF');
      <?php endif; ?>
      knob.setProperty('trackWidth', 0.4);
      knob.setProperty('valMin', 0);
      knob.setProperty('valMax', 100);
      knob.setProperty('readonly', true);

      // Set initial value.
      

      knob.setValue(<?php echo e($hit); ?>);
     
      const listener = function(knob, value) {
        console.log(value);
      };

      knob.addListener(listener);

      // Create element node.
      const node = knob.node();

      // Add it to the DOM.
      const elem = document.getElementById('some_element');
      elem.appendChild(node);
    }
    function ready() {
      demoKnob();
    
    }

    document.addEventListener('DOMContentLoaded', ready, false);
  
  </script>

<script>
var speedCanvas = document.getElementById("speedChart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;

var bln = <?php echo json_encode($month) ?>;

var dataSecond = {
    label: "Jumlah Semester Genap",
    data: <?php echo e($hslgenap); ?>,
    fill: false,
  borderColor: '#007bff'
  };

var dataFirst = {
    label: "Jumlah Semester Ganjil",
    data: <?php echo e($hslganjil); ?>,
    fill: false,
  borderColor: '#ced4da'
  };

  var speedData = {
  labels:  bln,
  datasets: [dataSecond,dataFirst]
};

var chartOptions = {
  legend: {
    display: true,
    position: 'top',
    labels: {
      boxWidth: 80,
      fontColor: 'black'
    }
  }
};

var lineChart = new Chart(speedCanvas, {
  type: 'line',
  data: speedData,
  options: chartOptions
});
</script>
<script>


var oilCanvas = document.getElementById("oilChart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;

var  diagram= <?php echo json_encode($dia) ?>;
var  isid= <?php echo json_encode($isid) ?>;
var oilData = {
    labels:  diagram,
    datasets: [
        {
            data: isid,
            backgroundColor: [
                "#FF6384",
                "#63FF84",
                "#84FF63",
                "#8463FF",
                "#6384FF",
                "#ffc107",
                "#ff851b"
            ],
            borderColor: "black",
            borderWidth: 2
        }]
};

var chartOptions = {
  rotation: -Math.PI,
  cutoutPercentage: 30,
  circumference: Math.PI,
  legend: {
    position: 'bottom'
  },
  animation: {
    animateRotate: false,
    animateScale: true
  }
};

var pieChart = new Chart(oilCanvas, {
  type: 'doughnut',
  data: oilData,
  options: chartOptions
});

new Chart(document.getElementById("bar-chart-grouped"), {
    type: 'bar',
    data: {
      labels: ["1900", "1950", "1999", "2050"],
      datasets: [
        {
          label: "Africa",
          backgroundColor: "#3e95cd",
          data: [133,221,783,2478]
        }, {
          label: "Europe",
          backgroundColor: "#8e5ea2",
          data: [408,547,675,734]
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'Population growth (millions)'
      }
    }
});
</script>
</body>
</html>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.top', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\layanan\resources\views/dashcuti.blade.php ENDPATH**/ ?>