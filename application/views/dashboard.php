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

  <!-- iCheck for checkboxes -->
<link rel="stylesheet" href="<?= base_url('assets/template/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="<?= base_url('assets/template/plugins/fontawesome-free/css/all.min.css') ?>">


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
  <!-- Calendar Column -->
  <div class="col-md-6">
    <div class="card">
      <div class="card-header bg-primary text-white">
        <h3 class="card-title">Project Calendar</h3>
      </div>
      <div class="card-body">
        <div id="calendar" style="min-height: 600px;"></div>
      </div>
    </div>
  </div>

  <!-- Bar Chart Column with another card below it -->
  <div class="col-md-6">
    <!-- Bar Chart -->
    <div class="card">
      <div class="card-header bg-success text-white">
        <h3 class="card-title">Projects by Status (Bar Chart)</h3>
      </div>
      <div class="card-body">
        <canvas id="barChart"></canvas>
      </div>
    </div>

    <div class="card mt-3">
  <div class="card-header bg-info text-white">
    <h3 class="card-title"><i class="ion ion-clipboard mr-1"></i> To Do List</h3>
  </div>
  <div class="card-body">
    <form id="todo-form" class="mb-3">
      <div class="input-group">
        <input type="text" id="todo-input" class="form-control" placeholder="Add new task..." required>
        <div class="input-group-append">
          <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Add</button>
        </div>
      </div>
    </form>

    <ul id="todo-list" class="todo-list" data-widget="todo-list">
      <!-- Tasks will appear here -->
    </ul>
  </div>
</div>


      </div>
    </div>





</section>
</div>
</div>

</div>

<!-- jQuery -->
<script src="<?= base_url('assets/template/plugins/jquery/jquery.min.js') ?>"></script>
<!-- AdminLTE -->
<script src="<?= base_url('assets/template/dist/js/adminlte.min.js') ?>"></script>


</body>

<script>

  // Calendar
  document.addEventListener('DOMContentLoaded', function () {
  const calendarEl = document.getElementById('calendar');

  const calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,listWeek'
    },
    events: <?= $calendar_events ?> // JSON from PHP
  });

  calendar.render();
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

<script>
document.addEventListener('DOMContentLoaded', function () {
  const calendarEl = document.getElementById('calendar');

  const calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,listWeek'
    },
    events: <?= $calendar_events ?>
  });

  calendar.render();
});
</script>




<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />

<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>




</html>
