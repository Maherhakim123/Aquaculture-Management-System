<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/template/plugins/fontawesome-free/css/all.min.css'); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url('assets/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/template/dist/css/adminlte.min.css'); ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body>


     <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h2>Edit Phase</h2>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('phase/update'); ?>" method="POST">
                        <input type="hidden" name="phaseID" value="<?php echo $phase->phaseID; ?>">
                        <input type="hidden" name="projectID" value="<?php echo $phase->projectID; ?>">

                        <div class="mb-3">
                            <label for="phaseName" class="form-label">Phase Name</label>
                            <input type="text" id="phaseName" name="phaseName" class="form-control"
                                value="<?php echo isset($phase->phaseName) ? $phase->phaseName : ''; ?>"
                                placeholder="Enter Phase Name">
                        </div>

                        <div class="mb-3">
                            <label for="startDate" class="form-label">Start Date</label>
                            <input type="date" id="startDate" name="startDate" class="form-control"
                                value="<?php echo isset($phase->startDate) ? $phase->startDate : ''; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline</label>
                            <input type="date" id="deadline" name="deadline" class="form-control"
                                value="<?php echo isset($phase->deadline) ? $phase->deadline : ''; ?>">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                        </div>
                    </form> <br>
                    <form action="<?php echo site_url('phase/index'); ?>" method="post" style="display:inline;">
                        <button type="submit" class="btn btn-secondary">Back to Phase</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Ym2G28oVuKMbcbUP46OEuEUmPO0IkUfyRfMkgL37dkwSfVP1GMv4VJkxjNhypGn4"
        crossorigin="anonymous"></script>
</body>

</html>