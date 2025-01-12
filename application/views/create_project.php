
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Create Project</title>
</head>
<body>


<div class="content-wrapper">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h2>ADD NEW PROJECT</h2>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('project/add')?>" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Project Name: </label>
                            <input type="text" id="name" name="projectName" class="form-control" value="<?php echo set_value('name'); ?>" placeholder="Enter Project name">
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Project Location:</label>
                            <input type="text" id="location" name="projectLocation" class="form-control" value="<?php echo set_value('location'); ?>" placeholder="Where is the location?">
                        </div>
                        <div class="mb-3">
                            <label for="start" class="form-label">Start Date:</label>
                            <input type="date" id="start" name="startDate" class="form-control" value="<?php echo set_value('start'); ?>" placeholder="Star?">
                        </div>
                        <div class="mb-3">
                            <label for="end" class="form-label">End Date:</label>
                            <input type="date" id="end" name="endDate" class="form-control" value="<?php echo set_value('end'); ?>" placeholder="Fisnish">
                        </div>
                        <div class="mb-3">
                            <label for="budget" class="form-label">Budget:</label>
                            <input type="text" id="budget" name="budget" class="form-control" placeholder="Budget">
                        </div>
                        <div class="mb-3">
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



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-Ym2G28oVuKMbcbUP46OEuEUmPO0IkUfyRfMkgL37dkwSfVP1GMv4VJkxjNhypGn4" crossorigin="anonymous"></script>
</body>
</html>
