<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project</title>
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

<div class="content-wrapper">
<div class="container p-3">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h2>ADD NEW PROJECT</h2>
                </div>
                <div class="card-body">
                    <form id="projectForm" action="<?php echo base_url('project/add')?>" method="POST" onsubmit="return showSuccessMessage()">
                        <div class="mb-1">
                            <label for="name" class="form-label">Project Name: </label>
                            <input type="text" id="name" name="projectName" class="form-control" value="<?php echo set_value('name'); ?>" placeholder="Enter Project name">
                        </div>
                        <div class="mb-1">
                            <label for="location" class="form-label">Project Location:</label>
                            <input type="text" id="location" name="projectLocation" class="form-control" value="<?php echo set_value('location'); ?>" placeholder="Where is the location?">
                        </div>
                        <div class="mb-1">
                            <label for="start" class="form-label">Start Date:</label>
                            <input type="date" id="start" name="startDate" class="form-control" value="<?php echo set_value('start'); ?>" placeholder="Start">
                        </div>
                        <div class="mb-1">
                            <label for="end" class="form-label">End Date:</label>
                            <input type="date" id="end" name="endDate" class="form-control" value="<?php echo set_value('end'); ?>" placeholder="Finish">
                        </div>
                        <div class="mb-1">
                            <label for="budget" class="form-label">Budget:RM</label>
                            <input type="number" id="budget" name="budget" class="form-control" placeholder="Budget">
                        </div>
                        <div class="mb-2">
                            <label for="source" class="form-label">Budget Source:</label>
                            <select id="source" name="budgetSource" class="form-control" placeholder="Who is the sponsor?">
                            <option value="" disabled selected>Select Budget Source</option>
                            <option value="Ministry of Finance(MOF)">Ministry of Finance(MOF)</option>
                            <option value="Private Sector">Private Sector</option>
                            </select>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    // Ensure end date is not before the start date
    document.getElementById('start').addEventListener('change', function() {
        const startDate = this.value;
        const endDateInput = document.getElementById('end');
        endDateInput.min = startDate; // Set the minimum end date to the selected start date
    });

    document.getElementById('end').addEventListener('change', function() {
        const endDate = this.value;
        const startDate = document.getElementById('start').value;
        if (endDate < startDate) {
            alert('End date cannot be earlier than start date.');
            this.value = ''; // Clear the end date
        }
    });

    // Show success message after form submission
    function showSuccessMessage() {
        // Triggered when the form is submitted
        alert('Project Created Successfully!');
        return true; // Allow the form to submit
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-Ym2G28oVuKMbcbUP46OEuEUmPO0IkUfyRfMkgL37dkwSfVP1GMv4VJkxjNhypGn4" crossorigin="anonymous"></script>
</body>
</html>
