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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="css/style.css">

<div class="sidebar">
  <div class="sidebar-header">
    <a href="index.php" class="sidebar-brand">
      <i class="fas fa-user-tie mr-2"></i>
      Freelancer Portal
    </a>
  </div>
  
  <ul class="nav flex-column">
    <li class="nav-item">
      <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">
        <i class="fas fa-home"></i>
        Dashboard
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'interviews.php' ? 'active' : ''; ?>" href="interviews.php">
        <i class="fas fa-calendar-check"></i>
        Interviews
        <?php  
        $getNumOfPendingInterviews = getNumOfPendingInterviews($pdo, $_SESSION['user_id']); 
        if ($getNumOfPendingInterviews['pendingCount'] > 0) {
          echo '<span class="badge badge-danger ml-2">' . $getNumOfPendingInterviews['pendingCount'] . '</span>';
        }
        ?>
      </a>
    </li>
  </ul>

  <div class="user-section">
    <div class="user-info">
      <div class="user-avatar">
        <i class="fas fa-user"></i>
      </div>
      <div>
        <div class="user-name"><?php echo $_SESSION['username']; ?></div>
        <div class="user-role">Freelancer</div>
      </div>
    </div>
    <a class="logout-link" href="core/handleForms.php?logoutUserBtn=1">
      <i class="fas fa-sign-out-alt"></i>
      Logout
    </a>
  </div>
</div>

<div class="main-content">
