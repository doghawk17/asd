<?php require_once 'core/dbConfig.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <style>
      body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #00897B 0%, #004D40 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .login-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 100%;
        max-width: 500px;
      }
      .login-header {
        background: linear-gradient(135deg, #00897B 0%, #004D40 100%);
        color: white;
        padding: 2rem;
        text-align: center;
      }
      .login-header h2 {
        margin: 0;
        font-weight: 700;
        font-size: 1.75rem;
      }
      .login-body {
        padding: 2rem;
      }
      .login-footer {
        padding: 1rem 2rem;
        text-align: center;
        background: #f8f9fa;
      }
      .btn-primary {
        background-color: #00897B;
        border-color: #00897B;
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
      }
      .btn-primary:hover {
        background-color: #00695C;
        border-color: #00695C;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 137, 123, 0.2);
      }
    </style>
    <title>Client Login | Upwork Clone</title>
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="login-card">
            <div class="login-header">
              <i class="fas fa-briefcase fa-3x mb-3"></i>
              <h2>Client Login</h2>
              <p class="mb-0">Sign in to access your client dashboard</p>
            </div>
            <div class="login-body">
              <?php  
                if (isset($_SESSION['message']) && isset($_SESSION['status'])) {
                  if ($_SESSION['status'] == "200") {
                    echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
                  } else {
                    echo '<div class="alert alert-danger">' . $_SESSION['message'] . '</div>'; 
                  }
                }
                unset($_SESSION['message']);
                unset($_SESSION['status']);
              ?>
              
              <form action="core/handleForms.php" method="POST">
                <div class="form-group">
                  <label for="username"><i class="fas fa-user mr-2"></i>Username</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
                </div>
                <div class="form-group">
                  <label for="password"><i class="fas fa-lock mr-2"></i>Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                </div>
                <div class="form-group mt-4">
                  <button type="submit" class="btn btn-primary btn-block" name="loginUserBtn">
                    <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                  </button>
                </div>
              </form>
            </div>
            
            <div class="login-footer">
              <p class="mb-0">Don't have an account? <a href="register.php">Register as a Client</a></p>
              <p class="mt-2 mb-0">Are you a freelancer? <a href="../freelancer/login.php">Login as Freelancer</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
