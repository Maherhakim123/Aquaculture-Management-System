<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Phase Details</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
    <div class="content p-3">
      <div class="container">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <h3 class="card-title">Activities Progress</h3>
          </div>
          <div class="card-body">
            <!-- export to excel -->
            <button class="btn btn-success mb-3" onclick="exportTableToExcel('activityTable', 'activities_progress')">
              <i class="fas fa-file-excel"></i> Export to Excel
            </button>
            <!-- export to pdf -->
            <button class="btn btn-danger mb-3 ms-2" onclick="exportTableToPDF()">
              <i class="fas fa-file-pdf"></i> Export to PDF
            </button>

            <table id="activityTable" class="table table-bordered table-striped">
              <thead class="thead-dark">
                <tr>
                  <th>Phase</th>
                  <th>Activity</th>
                  <th>Comment</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($progressData as $entry): ?>
                  <?php $activities = $entry['activities']; ?>
                  <?php $activityCount = count($activities); ?>
                  <?php $rowIndex = 0; ?>
                  <?php foreach ($activities as $activity): ?>
                 <tr>
            <?php if ($rowIndex === 0): ?>
                <td rowspan="<?= $activityCount ?>"><?= $entry['phase']->phaseName ?></td>
            <?php endif; ?>
            <td><?= $activity['activityType'] ?> - <?= $activity['activityName'] ?></td>
            <td>
                <?php if (!empty($activity['comments'])): ?>
                    <?php foreach ($activity['comments'] as $comment): ?>
                        <div>
                            <strong><?= htmlspecialchars($comment['username']) ?>:</strong>
                              <?= nl2br(htmlspecialchars($comment['comment'])) ?><br>
                            <small class="text-muted"><?= date('d M Y, h:i A', strtotime($comment['created_at'])) ?></small>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <em>No comments</em>
                <?php endif; ?>
            </td>
                  </tr>
                  <?php $rowIndex++; ?>
              <?php endforeach; ?>
          <?php endforeach; ?>

                </tbody>
            </table>
       </div>

            <div class="card-footer">
                <a href="<?= site_url('project/view/'.$projectID) ?>" class="btn btn-secondary">Back to Project</a>
            </div>
            
        </div>
      </div>
    </div>
  </div>


<!-- Optional: Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<!-- export into excel file .xlsx -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<!-- jsPDF and html2canvas for PDF export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
  // export excel function
function exportTableToExcel(tableID, filename = '') {
    const table = document.getElementById(tableID);
    const wb = XLSX.utils.table_to_book(table, { sheet: "Sheet1" });
    XLSX.writeFile(wb, filename ? filename + ".xlsx" : "export.xlsx");
}
 
  // export pdf function
async function exportTableToPDF() {
    const table = document.getElementById("activityTable");

    // Wrap table in a container for better rendering
    const container = document.createElement("div");
    container.appendChild(table.cloneNode(true));
    document.body.appendChild(container);

    const canvas = await html2canvas(container, { scale: 2 });
    const imgData = canvas.toDataURL("image/png");

    const { jsPDF } = window.jspdf;
    const pdf = new jsPDF("l", "mm", "a4");
    const imgProps = pdf.getImageProperties(imgData);
    const pdfWidth = pdf.internal.pageSize.getWidth();
    const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

    pdf.addImage(imgData, "PNG", 0, 10, pdfWidth, pdfHeight);
    pdf.save("activities_progress.pdf");

    document.body.removeChild(container); // Clean up
}
</script>


</body>
</html>
