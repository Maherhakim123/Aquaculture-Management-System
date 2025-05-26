<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Phase</title>

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
<body class="hold-transition sidebar-mini">

<div class="wrapper">
    <div class="content-wrapper p-3">
        <div class="container">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create New Phase</h3>
                </div>

                <form action="<?= site_url('phase/add') ?>" method="post">
                    <div class="card-body">
                        <input type="hidden" name="projectID" value="<?= $projectID ?>">

                        <div class="form-group">
                            <label for="phaseName">Phase Name</label>
                            <input type="text" class="form-control" id="phaseName" name="phaseName" required oninput="this.value = this.value.toUpperCase();">
                        </div>

                        <div class="form-group">
                            <label for="phaseName">Start Date</label>
                        <!-- Start Date -->
                        <input type="date" 
                            class="form-control" id="startDate"  name="startDate"   required  min="<?= $minDate ?>" max="<?= $maxDate ?>"  onchange="validateDates()">
                        </div>
                       <div class="form-group">
                            <label for="phaseName">Deadline</label>
                            <!-- Deadline -->
                        <input type="date" 
                             class="form-control"  id="deadline"  name="deadline" required min="<?= $minDate ?>" max="<?= $maxDate ?>" onchange="validateDates()">
                        </div>
                        
                        <div class="form-group">
                            <label>Status</label>
                            <input type="text" class="form-control" value="Not Started" readonly>
                        </div>

                        <div class="form-group">
                            <label>Progress</label>
                            <input type="text" class="form-control" value="0%" readonly>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Create Phase</button>
                        <a href="<?= site_url('project/view/'.$projectID) ?>" class="btn btn-secondary">Back to Project</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- AdminLTE & Bootstrap Scripts (Optional if already included globally) -->
<script src="<?= base_url('assets/template/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/template/dist/js/adminlte.min.js') ?>"></script>

<script>
function validateDates() {
    const projectStart = new Date("<?= $minDate ?>");
    const projectEnd = new Date("<?= $maxDate ?>");

    const startDateInput = document.getElementById('startDate');
    const deadlineInput = document.getElementById('deadline');

    const startDate = new Date(startDateInput.value);
    const deadline = new Date(deadlineInput.value);

    // Clear any previous error messages
    startDateInput.setCustomValidity('');
    deadlineInput.setCustomValidity('');

    // Check if startDate is within project duration
    if (startDate < projectStart || startDate > projectEnd) {
        startDateInput.setCustomValidity('Start date must be within project duration.');
    }

    // Check if deadline is within project duration
    if (deadline < projectStart || deadline > projectEnd) {
        deadlineInput.setCustomValidity('Deadline must be within project duration.');
    }

    // Check if deadline is after or equal to startDate
    if (deadline < startDate) {
        deadlineInput.setCustomValidity('Deadline cannot be earlier than start date.');
    }

    // Report validity to show error messages
    startDateInput.reportValidity();
    deadlineInput.reportValidity();
}
</script>



</body>
</html>
