<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
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



    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>EDIT PROJECT</h2>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url('project/update') ?>" method="POST">
                        <input type="hidden" name="projectID" value="<?php echo $project->projectID; ?>">

                            <div class="mb-3">
                                <label for="name" class="form-label">Project Name: </label>
                                <input type="text" id="name" name="projectName" class="form-control"
                                    value="<?php echo isset($project->projectName) ? $project->projectName : ''; ?>"
                                    placeholder="Enter Project name">
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Project Location:</label>
                                <input type="text" id="location" name="projectLocation" class="form-control"
                                    value="<?php echo isset($project->projectLocation) ? $project->projectLocation : ''; ?>"
                                    placeholder="Where is the location?">
                            </div>
                            <div class="mb-3">
                                <label for="start" class="form-label">Start Date:</label>
                                <input type="date" id="start" name="startDate" class="form-control"
                                    value="<?php echo isset($project->startDate) ? $project->startDate : ''; ?>"
                                    placeholder="Start Date">
                            </div>
                            <div class="mb-3">
                                <label for="end" class="form-label">End Date:</label>
                                <input type="date" id="end" name="endDate" class="form-control"
                                    value="<?php echo isset($project->endDate) ? $project->endDate : ''; ?>"
                                    placeholder="Finish Date">
                            </div>
                            <div class="mb-3">
                                <label for="budget" class="form-label">Budget:</label>
                                <input type="text" id="budget" name="budget" class="form-control"
                                    value="<?php echo isset($project->budget) ? $project->budget : ''; ?>"
                                    placeholder="Budget">
                            </div>
                            <div class="mb-3">
                                <label for="source" class="form-label">Budget Source:</label>
                                <select id="source" name="budgetSource" class="form-control">
                                    <option value="Ministry of Finance(MOF)"<?php echo isset($project->budgetSource) && $project->budgetSource == 'Ministry of Finance(MOF)' ? 'selected' : ''; ?>>
                                    Ministry of Finance(MOF)
                                    </option>
                                    <option value="Private Sector"<?php echo isset($project->budgetSource) && $project->budgetSource == 'Private Sector' ? 'selected' : ''; ?>>
                                    Private Sector
                                    </option>
                                </select>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Edit</button>
                            </div>
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