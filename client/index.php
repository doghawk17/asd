<?php 
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
}

if ($_SESSION['is_client'] == 0) {
  header("Location: ../freelancer/index.php");
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
    <title>Client Dashboard | Upwork Clone</title>
  </head>
  <body>
    <?php include 'includes/navbar.php'; ?>
    
    <div class="welcome-card">
      <h1><i class="fas fa-briefcase mr-3"></i>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
      <p>Find talented freelancers and manage your projects efficiently. Post gigs, review proposals, and schedule interviews all in one place.</p>
      <div class="row">
        <div class="col text-center">
          <button class="showCreateGigForm btn btn-primary">Create New Gig!</button>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-10">
          <form class="createNewGig d-none">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="title form-control">
            </div>
            <div class="form-group">
              <label for="title">Description</label>
              <input type="text" class="description form-control">
              <input type="submit" class="btn btn-primary float-right mt-4">
            </div>
          </form>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-12">
          <h2 class="mb-4"><i class="fas fa-list-alt mr-2"></i>Available Gigs</h2>
        </div>
        <?php $getAllGigs = getAllGigs($pdo); ?>
        <?php if (!empty($getAllGigs)) { ?>
          <?php foreach ($getAllGigs as $row) { ?>
          <div class="col-md-4 mb-4">
            <div class="content-card h-100">
              <div class="card-icon">
                <i class="fas fa-briefcase"></i>
              </div>
              <h3><?php echo $row['title']; ?></h3>
              <p><?php echo $row['description']; ?></p>
              <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                  <i class="fas fa-user mr-1"></i> <?php echo $row['username']; ?><br>
                  <i class="fas fa-calendar-alt mr-1"></i> <?php echo date('M d, Y', strtotime($row['date_added'])); ?>
                </small>
                <a href="get_gig_proposals.php?gig_id=<?php echo $row['gig_id']; ?>" class="btn btn-outline-primary">View Details</a>
              </div>
            </div>
          </div>
          <?php } ?>
        <?php } else { ?>
          <div class="col-12">
            <div class="alert alert-info text-center">
              <h4>No gigs available</h4>
              <p>There are no gigs posted yet. Be the first to create one!</p>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script>
      $('.showCreateGigForm').on('click', function (event) {
        $('.createNewGig').toggleClass('d-none');
      })

      $('.createNewGig').on('submit', function (event) {
        event.preventDefault();

        var formData = {
          title: $(this).find('.title').val(),
          description: $(this).find('.description').val(),
          createNewGig:1
        }

        if (formData.title != "" && formData.description != "") {
          $.ajax({
            type:"POST",
            url: "core/handleForms.php",
            data:formData,
            success:function (data) {
              location.reload()
            }
          })
        }
        else {
          alert("Make sure there are no empty input fields!")
        }

      })
    </script>
  </body>
</html>
