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
</head>
<body>

<!-- put in <head> after AdminLTE -->
<style>
  /* bigger footprint JUST for these stat boxes */
  .small-box.small-box-lg {
      min-height: 200px;           /* taller */
      padding: 1.75rem 1.5rem;     /* more breathing room */
  }
  .small-box.small-box-lg .inner h3{
      font-size: 3rem;             /* larger number */
      font-weight: 700;
      margin: 0 0 .25rem;
  }
  .small-box.small-box-lg .inner p{
      font-size: 1.25rem;          /* larger label */
      margin: 0;
  }
  .small-box.small-box-lg .icon{
      top: 10px;                   /* tweak icon position */
      right: 10px;
      font-size: 4rem;
      opacity: .3;
  }
</style>


<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
       


<!-- Main content -->
<section class="content">
      <div class="container-fluid">

        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box 1 -->
            <div class="small-box bg-info">
              <div class="inner">
              <h3><?php echo $project_count; ?></h3>

                <p>Projects</p>
              </div>
              <div class="icon">
                <i class="ion ion-clipboard"></i>
              </div>
              <a href="<?php echo base_url('project/list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->



          <div class="col-lg-3 col-6">
             <!-- small box 2-->
             <div class="small-box bg-danger">
              <div class="inner">
              <h3><?php echo $project_count; ?></h3>

                <p>Projects In-Progress</p>
              </div>
              <div class="icon">
                <i class="ion ion-eye"></i>
              </div>
              <a href="<?php echo base_url('project/list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>


          <div class="col-lg-3 col-6">
             <!-- small box 3-->
             <div class="small-box bg-success">
              <div class="inner">
              <h3><?php echo $project_count; ?></h3>

                <p>Projects Completed</p>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark"></i>
              </div>
              <a href="<?php echo base_url('project/list'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
    </div>
    </div>

    



</section>
</div>
</div>

</div>




</body>
</html>
