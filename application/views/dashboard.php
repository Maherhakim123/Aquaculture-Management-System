<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aquaculture | Dashboard</title>
    <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/template/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('assets/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/template/dist/css/adminlte.min.css') ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- chart -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
       


<!-- Main content -->
<section class="content">
      <div class="container-fluid">

        <!-- Small boxes (Stat box) -->
        <div class="row">
        <!-- Box 1 -->
        <div class="col-md-4">
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= $project_count; ?></h3>
              <p>Projects</p>
            </div>
            <div class="icon">
              <i class="ion ion-clipboard"></i>
            </div>
          </div>
        </div>

        <!-- Box 2 -->
        <div class="col-md-4">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= $in_progress_projects; ?></h3>
              <p>Projects In-Progress</p>
            </div>
            <div class="icon">
              <i class="ion ion-eye"></i>
            </div>
          </div>
        </div>

        <!-- Box 3 -->
        <div class="col-md-4">
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= $completed_projects; ?></h3>
              <p>Projects Completed</p>
            </div>
            <div class="icon">
              <i class="ion ion-checkmark"></i>
            </div>
          </div>
        </div>
      </div>
</div>

<!-- Graphs Row -->
<div class="row mt-4">
  <!-- Line Chart -->
  <div class="col-md-6">
    <div class="card">
      <div class="card-header bg-primary text-white">
        <h3 class="card-title">Project Progress Over Time (Line Chart)</h3>
      </div>
      <div class="card-body">
        <canvas id="lineChart"></canvas>
      </div>
    </div>
  </div>

  <!-- Bar Chart -->
  <div class="col-md-6">
    <div class="card">
      <div class="card-header bg-success text-white">
        <h3 class="card-title">Projects by Status (Bar Chart)</h3>
      </div>
      <div class="card-body">
        <canvas id="barChart"></canvas>
      </div>
    </div>
  </div>
</div>


</section>
</div>
</div>

</div>

</body>

<script>
  // Dummy data — replace with PHP variables if needed
  const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
  const progressData = [5, 10, 8, 12, 15, 20];

  const ctxLine = document.getElementById('lineChart').getContext('2d');
  const lineChart = new Chart(ctxLine, {
    type: 'line',
    data: {
      labels: months,
      datasets: [{
        label: 'Projects Started',
        data: progressData,
        backgroundColor: 'rgba(0, 123, 255, 0.2)',
        borderColor: 'rgba(0, 123, 255, 1)',
        borderWidth: 2,
        fill: true,
        tension: 0.4
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  // Bar chart data — using PHP values from dashboard
  const ctxBar = document.getElementById('barChart').getContext('2d');
  const barChart = new Chart(ctxBar, {
    type: 'bar',
    data: {
      labels: ['Total Projects', 'In Progress', 'Completed'],
      datasets: [{
        label: 'Number of Projects',
        data: [<?= $project_count ?>, <?= $in_progress_projects ?>, <?= $completed_projects ?>],
        backgroundColor: [
          'rgba(0, 123, 255, 0.7)',
          'rgba(255, 193, 7, 0.7)',
          'rgba(40, 167, 69, 0.7)'
        ],
        borderColor: [
          'rgba(0, 123, 255, 1)',
          'rgba(255, 193, 7, 1)',
          'rgba(40, 167, 69, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

</html>
