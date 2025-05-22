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
    <title>Gig Proposals | Upwork Clone</title>
  </head>
  <body>
    <?php include 'includes/navbar.php'; ?>
    
    <div class="welcome-card">
      <h1><i class="fas fa-file-alt mr-3"></i>Gig Proposals</h1>
      <p>Review proposals from freelancers and schedule interviews. Double-click on any proposal card to schedule an interview.</p>
      <div class="row mt-4">
        <?php $getGigById = getGigById($pdo, $_GET['gig_id']); ?>
        <div class="col-md-5">
          <div class="content-card">
            <div class="card-icon">
              <i class="fas fa-briefcase"></i>
            </div>
            <h3><?php echo $getGigById['gig_title']; ?></h3>
            <p><?php echo $getGigById['gig_description']; ?></p>
            <div class="mb-3">
              <small class="text-muted">
                <i class="fas fa-calendar-alt mr-1"></i> <?php echo date('M d, Y', strtotime($getGigById['date_added'])); ?><br>
                <i class="fas fa-user mr-1"></i> <?php echo $_SESSION['username']; ?>
              </small>
            </div>
            <a href="gigs_posted.php" class="btn btn-outline-primary">
              <i class="fas fa-arrow-left mr-1"></i> Back to My Gigs
            </a>
          </div>
        </div>
        <div class="col-md-7">
          <div class="content-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <div class="d-flex align-items-center">
                <div class="card-icon mr-3">
                  <i class="fas fa-calendar-check"></i>
                </div>
                <h3 class="mb-0">Scheduled Interviews</h3>
              </div>
            </div>
            
            <?php $getAllInterviewsByGig = getAllInterviewsByGig($pdo, $_GET['gig_id']); ?>
            <?php if (!empty($getAllInterviewsByGig)) { ?>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Freelancer</th>
                      <th>Start Time</th>
                      <th>End Time</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($getAllInterviewsByGig as $row) { ?>
                    <tr>
                      <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                      <td><?php echo date('M d, Y h:i A', strtotime($row['time_start'])); ?></td>
                      <td><?php echo date('M d, Y h:i A', strtotime($row['time_end'])); ?></td>
                      <td>
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
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            <?php } else { ?>
              <div class="alert alert-info">
                <i class="fas fa-info-circle mr-2"></i> No interviews scheduled yet. Double-click on a proposal below to schedule an interview.
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-12">
        <h2 class="mb-4"><i class="fas fa-user-tie mr-2"></i>Freelancer Proposals</h2>
      </div>
      
      <?php $getProposalsByGigId = getProposalsByGigId($pdo, $_GET['gig_id']); ?>
      <?php if (!empty($getProposalsByGigId)) { ?>
        <?php foreach ($getProposalsByGigId as $row) { ?>
        <div class="col-md-4 mb-4">
          <div class="content-card proposal-card h-100 gigProposalContainer">
            <div class="d-flex align-items-center mb-3">
              <div class="user-avatar mr-3">
                <i class="fas fa-user"></i>
              </div>
              <div>
                <h3 class="mb-0"><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></h3>
                <small class="text-muted">
                  <i class="fas fa-calendar-alt mr-1"></i> <?php echo date('M d, Y', strtotime($row['date_added'])); ?>
                </small>
              </div>
            </div>
            
            <p><?php echo $row['description']; ?></p>
            
            <form class="addNewInterviewForm d-none mt-4">
              <h4 class="mb-3">Schedule Interview</h4>
              <div class="form-group">
                <label><i class="fas fa-clock mr-1"></i> Start Time</label>
                <input type="hidden" class="freelancer_id" value="<?php echo $row['user_id']; ?>">
                <input type="hidden" class="gig_id" value="<?php echo $_GET['gig_id']; ?>">
                <input type="datetime-local" class="time_start form-control">
              </div>
              <div class="form-group">
                <label><i class="fas fa-clock mr-1"></i> End Time</label>
                <input type="datetime-local" class="time_end form-control">
              </div>
              <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-calendar-plus mr-1"></i> Schedule Interview
              </button>
            </form>
          </div>
        </div>
        <?php } ?>
      <?php } else { ?>
        <div class="col-12">
          <div class="alert alert-info text-center">
            <h4>No proposals yet</h4>
            <p>There are no proposals for this gig yet. Check back later!</p>
          </div>
        </div>
      <?php } ?>
    </div>
    <script>
      $('.gigProposalContainer').on('dblclick', function (event) {
        var addNewInterviewForm = $(this).find('.addNewInterviewForm');
        addNewInterviewForm.toggleClass('d-none');
      })

      $('.addNewInterviewForm').on('submit', function (event) {
        event.preventDefault();
        
        // Get current date and time
        var now = new Date();
        var timeStart = new Date($(this).find('.time_start').val());
        var timeEnd = new Date($(this).find('.time_end').val());
        
        // Client-side validation
        if (timeStart < now) {
          alert("Cannot schedule interviews in the past!");
          return;
        }
        
        if (timeEnd <= timeStart) {
          alert("End time must be after start time!");
          return;
        }
        
        var formData = {
          freelancer_id: $(this).find('.freelancer_id').val(),
          gig_id: $(this).find('.gig_id').val(),
          time_start: $(this).find('.time_start').val(),
          time_end: $(this).find('.time_end').val(),
          insertNewGigInterview:1
        }

        if (formData.freelancer_id != "" && formData.gig_id != "" 
            && formData.time_start != "" && formData.time_end != "") {
          $.ajax({
            type: "POST",
            url:"core/handleForms.php",
            data: formData,
            success:function (data) {
              if (data) {
                location.reload()
              }
              else {
                // Check if it's a conflict or already scheduled
                var existingInterviews = <?php echo json_encode(getAllInterviewsByGig($pdo, $_GET['gig_id'])); ?>;
                var isConflict = false;
                
                // Check for conflicts with existing interviews
                for (var i = 0; i < existingInterviews.length; i++) {
                  var interview = existingInterviews[i];
                  var interviewStart = new Date(interview.time_start);
                  var interviewEnd = new Date(interview.time_end);
                  
                  if ((timeStart >= interviewStart && timeStart <= interviewEnd) || 
                      (timeEnd >= interviewStart && timeEnd <= interviewEnd) ||
                      (timeStart <= interviewStart && timeEnd >= interviewEnd)) {
                    isConflict = true;
                    break;
                  }
                }
                
                if (isConflict) {
                  alert("This time slot conflicts with an existing interview!");
                } else {
                  alert("You already scheduled an interview with this freelancer!");
                }
              }
            }
          })
        }
        else {
          alert("Make sure no input fields are empty!")
        }
      })
    </script>
    <?php include 'includes/footer.php'; ?>
  </body>
</html>
