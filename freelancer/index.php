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
    <title>Freelancer Dashboard | Upwork Clone</title>
  </head>
  <body>
    <?php include 'includes/navbar.php'; ?>
    
    <div class="welcome-card">
      <h1><i class="fas fa-user-tie mr-3"></i>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
      <p>Browse available gigs and submit your proposals. Remember, you can only submit one proposal per gig, so make it count!</p>
      <div class="row mt-5">
        <div class="col-12">
          <h2 class="mb-4"><i class="fas fa-briefcase mr-2"></i>Available Gigs</h2>
        </div>
        
        <?php $getAllGigs = getAllGigs($pdo); ?>
        <?php if (!empty($getAllGigs)) { ?>
          <?php foreach ($getAllGigs as $row) { ?>
          <div class="col-md-4 mb-4">
            <div class="content-card gig-card h-100">
              <div class="card-icon">
                <i class="fas fa-briefcase"></i>
              </div>
              <h3><?php echo $row['title']; ?></h3>
              <p><?php echo $row['description']; ?></p>
              <div class="mb-3">
                <small class="text-muted">
                  <i class="fas fa-user mr-1"></i> Posted by: <?php echo $row['username']; ?><br>
                  <i class="fas fa-calendar-alt mr-1"></i> <?php echo date('M d, Y', strtotime($row['date_added'])); ?>
                </small>
              </div>
              
              <?php $getProposalByGig = getProposalByGig($pdo, $row['gig_id'], $_SESSION['user_id']); ?>
              <?php if (!empty($getProposalByGig)) { ?>
                <div class="alert alert-success mb-3">
                  <h5><i class="fas fa-check-circle mr-2"></i>Your Proposal</h5>
                  <p><?php echo $getProposalByGig['gig_proposal_description']; ?></p>
                  <small class="text-muted">Submitted: <?php echo date('M d, Y', strtotime($getProposalByGig['date_added'])); ?></small>
                  
                  <form class="deleteProposalForm mt-3">
                    <input type="hidden" class="gig_proposal_id" value="<?php echo $getProposalByGig['gig_proposal_id']; ?>">
                    <button type="submit" class="btn btn-sm btn-danger">
                      <i class="fas fa-trash-alt mr-1"></i> Delete Proposal
                    </button>
                  </form>
                </div>
              <?php } else { ?>
                <div class="alert alert-light mb-3">
                  <h5><i class="fas fa-info-circle mr-2"></i>No Proposal Yet</h5>
                  <p>Submit your proposal below to apply for this gig.</p>
                </div>
                
                <form class="submitGigProposal">
                  <div class="form-group">
                    <label><i class="fas fa-file-alt mr-1"></i> Your Proposal</label>
                    <input type="hidden" value="<?php echo $row['gig_id']; ?>" class="gig_id">
                    <textarea class="gig_proposal_description form-control" rows="3" placeholder="Why are you the best candidate for this gig?"></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-paper-plane mr-1"></i> Submit Proposal
                  </button>
                </form>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
        <?php } else { ?>
          <div class="col-12">
            <div class="alert alert-info text-center">
              <h4>No gigs available</h4>
              <p>There are no gigs posted yet. Check back later for new opportunities!</p>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script>
      $('.submitGigProposal').on('submit', function (event) {
        event.preventDefault();

        var formData = {
          gig_id: $(this).find('.gig_id').val(),
          gig_proposal_description: $(this).find('.gig_proposal_description').val(),
          newGigProposal: 1,
        }

        if (formData.gig_id != "" && formData.gig_proposal_description != "") {
          $.ajax({
            type:"POST",
            url:"core/handleForms.php",
            data:formData,
            success:function (data) {
              if (data) {
                location.reload();
              }
              else {
                alert("You're allowed to submit your proposal only once!");
              }
            }
          })
        }
        else {
          alert("Make sure no input fields are empty!");
        }
      })

      $('.deleteProposalForm').on('submit', function (event) {
        event.preventDefault();

        var formData = {
          gig_proposal_id: $(this).find('.gig_proposal_id').val(),
          deleteGigProposal: 1,
        }

        if(confirm("Are you sure you want to delete this proposal?")) {
          $.ajax({
            type:"POST",
            url:"core/handleForms.php",
            data:formData,
            success: function (data) {
              location.reload();
            }
          })
        }
      })

      
    </script>
  </body>
</html>
