<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="css/style.css">

<div class="sidebar">
  <div class="sidebar-header">
    <a href="index.php" class="sidebar-brand">
      <i class="fas fa-briefcase mr-2"></i>
      Client Portal
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
      <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'gigs_posted.php' ? 'active' : ''; ?>" href="gigs_posted.php">
        <i class="fas fa-list-alt"></i>
        My Gigs
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'all_proposals.php' ? 'active' : ''; ?>" href="all_proposals.php">
        <i class="fas fa-file-alt"></i>
        All Proposals
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
        <div class="user-role">Client</div>
      </div>
    </div>
    <a class="logout-link" href="core/handleForms.php?logoutUserBtn=1">
      <i class="fas fa-sign-out-alt"></i>
      Logout
    </a>
  </div>
</div>

<div class="main-content">
