<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Project</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Project Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <dl>
                                    <dt><b class="border-bottom border-primary">Project Name</b></dt>
                                    <dd><?php echo $project->projectName; ?></dd>
                                    <dt><b class="border-bottom border-primary">Location</b></dt>
                                    <dd><?php echo $project->projectLocation; ?></dd>
                                    <dt><b class="border-bottom border-primary">Start Date</b></dt>
                                    <dd><?php echo date("d F Y", strtotime($project->startDate)); ?></dd>
                                </dl>
                                <div class="card-tools">
                            <a href="<?php echo site_url('project/list'); ?>" class="btn btn-secondary btn-sm">Back to List</a>
                        </div>
                            </div>
                            <div class="col-md-6">
                                <dl>
                                    <dt><b class="border-bottom border-primary">End Date</b></dt>
                                    <dd><?php echo date("d F Y", strtotime($project->endDate)); ?></dd>
                                    <dt><b class="border-bottom border-primary">Budget</b></dt>
                                    <dd><?php echo $project->budget; ?></dd>
                                    <dt><b class="border-bottom border-primary">Budget Source</b></dt>
                                    <dd><?php echo $project->budgetSource; ?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>




    


</body>
</html>
