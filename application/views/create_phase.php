<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Phase</title>
</head>
<body>

<div class="content-wrapper">
    <div class="container p-3">
        <h2>Create New Phase</h2>

        <form action="<?= site_url('phase/add') ?>" method="post">
            <input type="hidden" name="projectID" value="<?= $projectID ?>">

            <label>Phase Name:</label>
            <input type="text" name="phaseName" required><br>

            <label>Start Date:</label>
            <input type="date" name="startDate" required><br>

            <label>Deadline:</label>
            <input type="date" name="deadline" required><br>

            <label>Status:</label>
            <select name="status" required>
                <option value="Not Started">Not Started</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
            </select><br>

            <label>Progress (%):</label>
            <input type="number" name="progress" min="0" max="100" required><br>

            <input type="submit" value="Create Phase">
        </form>

        <!-- Back Button -->
        <a href="<?= site_url('project/view/'.$projectID) ?>" class="btn btn-secondary">Back to Project</a>
    </div>
</div>

</body>
</html>
