<?php 
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
}

if ($_SESSION['is_client'] == 1) {
  header("Location: ../client/index.php");
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <title>My Interviews | Upwork Clone</title>
  </head>
  <body>
    <?php include 'includes/navbar.php'; ?>
    
    <div class="welcome-card">
      <h1><i class="fas fa-calendar-check mr-3"></i>My Interviews</h1>
      <p>Manage your scheduled interviews and update their status. Accept or reject interview requests from clients.</p>
      <div class="row mt-4">
        <?php $getAllInterviewsByUserId = getAllInterviewsByUserId($pdo, $_SESSION['user_id']); ?>
        <?php if (!empty($getAllInterviewsByUserId)) { ?>
          <?php foreach ($getAllInterviewsByUserId as $row) { ?>
          <div class="col-md-4 mb-4">
            <div class="content-card h-100" gig_interview_id="<?php echo $row['gig_interview_id']; ?>">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="card-icon">
                  <i class="fas fa-calendar-check"></i>
                </div>
                <?php 
                  if ($row['status'] == "Accepted") {
                    echo '<span class="status-badge status-accepted">Accepted</span>';
                  }
                  if ($row['status'] == "Rejected") {
                    echo '<span class="status-badge status-rejected">Rejected</span>';
                  } 
                  if ($row['status'] == "Pending") {
                    echo '<span class="status-badge status-pending">Pending</span>';
                  }
                ?>
              </div>
              
              <h3><?php echo $row['title']; ?></h3>
              <p><?php echo $row['description']; ?></p>
              
              <div class="mb-4">
                <small class="text-muted">
                  <i class="fas fa-user mr-1"></i> Client: <?php echo $row['client_name']; ?><br>
                  <i class="fas fa-clock mr-1"></i> Start: <?php echo date('M d, Y h:i A', strtotime($row['time_start'])); ?><br>
                  <i class="fas fa-clock mr-1"></i> End: <?php echo date('M d, Y h:i A', strtotime($row['time_end'])); ?>
                </small>
              </div>
              
              <div class="form-group">
                <label><i class="fas fa-check-circle mr-1"></i> Update Status</label>
                <select class="interviewStatus form-control">
                  <option value="">Change Status</option>
                  <option value="Accepted">Accept Interview</option>
                  <option value="Rejected">Decline Interview</option>
                  <option value="Pending">Mark as Pending</option>
                </select>
              </div>
            </div>
          </div>
          <?php } ?>
        <?php } else { ?>
          <div class="col-12">
            <div class="alert alert-info text-center">
              <h4>No interviews scheduled</h4>
              <p>You don't have any interviews scheduled yet. Apply to gigs to get interview invitations!</p>
              <a href="index.php" class="btn btn-primary mt-2">Browse Gigs</a>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script>
      $('.interviewStatus').on('change', function (event) {
        event.preventDefault();
        var formData = {
          gig_interview_id: $(this).closest('.content-card').attr('gig_interview_id'),
          status: $(this).val(),
          updateInterviewStatus:1
        }

        if (formData.gig_interview_id != "" && formData.status != "") {
          $.ajax({
            type:"POST",
            url:"core/handleForms.php",
            data:formData,
            success:function (data) {
              location.reload();
            }
          })
        }
        else {
          alert("Make sure no fields are empty!");
        }
      })
    </script>
  </body>
</html>
