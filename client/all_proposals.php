<?php 
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
}

if ($_SESSION['is_client'] == 0) {
  header("Location: ../freelancer/index.php");
}

// Function to get all proposals for all gigs posted by the current client
function getAllProposalsForClient($pdo, $user_id) {
  $sql = "SELECT 
            gigs.gig_id AS gig_id,
            gigs.gig_title AS gig_title,
            fiverr_users.user_id AS freelancer_id,
            fiverr_users.first_name AS first_name,
            fiverr_users.last_name AS last_name,
            gig_proposals.gig_proposal_description AS description,
            gig_proposals.date_added AS date_added
          FROM gigs
          JOIN gig_proposals ON gigs.gig_id = gig_proposals.gig_id
          JOIN fiverr_users ON gig_proposals.user_id = fiverr_users.user_id
          WHERE gigs.user_id = ?
          ORDER BY gig_proposals.date_added DESC";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$user_id]);
  return $stmt->fetchAll();
}

$allProposals = getAllProposalsForClient($pdo, $_SESSION['user_id']);
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
    <title>All Proposals | Upwork Clone</title>
  </head>
  <body>
    <?php include 'includes/navbar.php'; ?>
    
    <div class="welcome-card">
      <h1><i class="fas fa-file-alt mr-3"></i>All Proposals</h1>
      <p>View all proposals submitted by freelancers for your gigs. Review and schedule interviews with potential candidates.</p>
      
      <div class="row mt-5">
        <div class="col-12">
          <h2 class="mb-4"><i class="fas fa-file-alt mr-2"></i>Freelancer Proposals</h2>
        </div>
        
        <?php if (count($allProposals) > 0) { ?>
          <?php foreach ($allProposals as $proposal) { ?>
            <div class="col-md-4 mb-4">
              <div class="content-card proposal-card h-100">
                <div class="d-flex align-items-center mb-3">
                  <div class="user-avatar mr-3">
                    <i class="fas fa-user"></i>
                  </div>
                  <div>
                    <h3 class="mb-0"><?php echo htmlspecialchars($proposal['first_name'] . ' ' . $proposal['last_name']); ?></h3>
                    <small class="text-muted">
                      <i class="fas fa-calendar-alt mr-1"></i> <?php echo date('M d, Y', strtotime($proposal['date_added'])); ?>
                    </small>
                  </div>
                </div>
                
                <div class="mb-3">
                  <span class="badge badge-primary"><?php echo htmlspecialchars($proposal['gig_title']); ?></span>
                </div>
                
                <p>
                  <?php 
                    // Limit description to 150 characters
                    $description = htmlspecialchars($proposal['description']);
                    echo (strlen($description) > 150) ? substr($description, 0, 150) . '...' : $description;
                  ?>
                </p>
                
                <div class="mt-auto">
                  <a href="get_gig_proposals.php?gig_id=<?php echo $proposal['gig_id']; ?>" class="btn btn-outline-primary btn-block">
                    <i class="fas fa-eye mr-1"></i> View Details
                  </a>
                </div>
              </div>
            </div>
          <?php } ?>
        <?php } else { ?>
          <div class="col-12">
            <div class="alert alert-info text-center">
              <h4>No proposals yet</h4>
              <p>You haven't received any proposals for your gigs yet. Try posting more gigs to attract freelancers!</p>
              <a href="index.php" class="btn btn-primary mt-2">Post a New Gig</a>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
  </body>
</html>
