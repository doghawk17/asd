<?php 
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
}

if ($_SESSION['is_client'] == 0) {
  header("Location: ../employees/index.php");
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
    <title>My Gigs | Upwork Clone</title>
  </head>
  <body>
    <?php include 'includes/navbar.php'; ?>
    
    <div class="welcome-card">
      <h1><i class="fas fa-list-alt mr-3"></i>My Gigs</h1>
      <p>Manage your posted gigs, edit details, and view proposals from freelancers. Double-click on any gig to edit its details.</p>
      <div class="row mt-4">
        <?php $getAllGigsByUserId = getAllGigsByUserId($pdo, $_SESSION['user_id']); ?>
        <?php if (!empty($getAllGigsByUserId)) { ?>
          <?php foreach ($getAllGigsByUserId as $row) { ?>
          <div class="col-md-4 mb-4">
            <div class="content-card h-100 gigContainer" gig_id="<?php echo $row['gig_id'] ?>">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="card-icon">
                  <i class="fas fa-briefcase"></i>
                </div>
                <button class="deleteGigBtn btn btn-sm btn-danger">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </div>
              <h3><?php echo $row['title']; ?></h3>
              <p><?php echo $row['description']; ?></p>
              <div class="mb-3">
                <small class="text-muted">
                  <i class="fas fa-calendar-alt mr-1"></i> <?php echo date('M d, Y', strtotime($row['date_added'])); ?>
                </small>
              </div>
              <div class="d-flex justify-content-between align-items-center">
                <a href="get_gig_proposals.php?gig_id=<?php echo $row['gig_id']; ?>" class="btn btn-outline-primary">
                  <i class="fas fa-file-alt mr-1"></i> View Proposals
                </a>
              </div>
              
              <form class="editGigForm mt-4 d-none">
                <div class="form-group">
                  <input type="hidden" value="<?php echo $row['gig_id']; ?>" class="form-control gig_id" required>
                  <label>Title</label>
                  <input type="text" value="<?php echo $row['title']; ?>" class="form-control title" required>
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control description" rows="3" required><?php echo $row['description']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                  <i class="fas fa-save mr-1"></i> Save Changes
                </button>
              </form>
            </div>
          </div>
          <?php } ?>
        <?php } else { ?>
          <div class="col-12">
            <div class="alert alert-info text-center">
              <h4>No gigs posted</h4>
              <p>You haven't posted any gigs yet. Go to the dashboard to create your first gig!</p>
              <a href="index.php" class="btn btn-primary mt-2">Go to Dashboard</a>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script>
      $('.gigContainer').on('dblclick', function (event) {
        var editForm = $(this).find('.editGigForm');
        editForm.toggleClass('d-none');
      })

      $('.deleteGigBtn').on('click', function (event) {
        var formData = {
          gig_id: $(this).closest('.gigContainer').attr('gig_id'),
          deleteGig:1 
        }
        if (formData.gigID != "") {
          if (confirm("Are you sure you want to delete this gig?")) { 
              $.ajax({
                type:"POST",
                url:"core/handleForms.php",
                data: formData,
                success: function (data) {
                  location.reload();              
                }
              })
            }
        }
        else {
          alert("An error occured with your input")
        }
      })

      $('.editGigForm').on('submit', function (event) {
        event.preventDefault();
        var formData = {
          gig_id: $(this).find('.gig_id').val(),
          title: $(this).find('.title').val(),
          description: $(this).find('.description').val(),
          updateGig:1 
        }
        if (formData.gig_id != "" && formData.title != "" && formData.description != "") {
            $.ajax({
              type:"POST",
              url:"core/handleForms.php",
              data: formData,
              success: function (data) {
                location.reload();              
              }
            })            
        }
        else {
          alert("Make sure the input fields are not empty!")
        }
      })
    </script>
  </body>
</html>
