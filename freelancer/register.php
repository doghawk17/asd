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
      background: linear-gradient(135deg, #5E35B1 0%, #3949AB 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .register-card {
      background: white;
      border-radius: 20px;
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      width: 100%;
      max-width: 600px;
      margin: 2rem 0;
    }
    .register-header {
      background: linear-gradient(135deg, #5E35B1 0%, #3949AB 100%);
      color: white;
      padding: 2rem;
      text-align: center;
    }
    .register-header h2 {
      margin: 0;
      font-weight: 700;
      font-size: 1.75rem;
    }
    .register-body {
      padding: 2rem;
    }
    .register-footer {
      padding: 1rem 2rem;
      text-align: center;
      background: #f8f9fa;
    }
    .btn-primary {
      background-color: #5E35B1;
      border-color: #5E35B1;
      border-radius: 12px;
      padding: 0.75rem 1.5rem;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    .btn-primary:hover {
      background-color: #4527A0;
      border-color: #4527A0;
      transform: translateY(-2px);
      box-shadow: 0 4px 10px rgba(94, 53, 177, 0.2);
    }
  </style>
  <title>Freelancer Registration | Upwork Clone</title>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="register-card">
          <div class="register-header">
            <i class="fas fa-user-tie fa-3x mb-3"></i>
            <h2>Freelancer Registration</h2>
            <p class="mb-0">Create your freelancer account to find work and submit proposals</p>
          </div>
          <div class="register-body">
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
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="first_name"><i class="fas fa-user mr-2"></i>First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your first name" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="last_name"><i class="fas fa-user mr-2"></i>Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter your last name" required>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <label for="username"><i class="fas fa-at mr-2"></i>Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Choose a username" required>
              </div>
              
              <div class="form-group">
                <label for="password"><i class="fas fa-lock mr-2"></i>Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Create a password" required>
              </div>
              
              <div class="form-group">
                <label for="confirm_password"><i class="fas fa-check-circle mr-2"></i>Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
              </div>
              
              <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary btn-block" name="insertNewUserBtn">
                  <i class="fas fa-user-plus mr-2"></i>Create Account
                </button>
              </div>
            </form>
          </div>
          
          <div class="register-footer">
            <p class="mb-0">Already have an account? <a href="login.php">Login as a Freelancer</a></p>
            <p class="mt-2 mb-0">Are you a client? <a href="../client/register.php">Register as Client</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    // $('#registrationForm').on('submit', function (event) {
    //   event.preventDefault();

    //   var formData = {
    //     first_name: $('#first_name').val(),
    //     last_name: $('#last_name').val(),
    //     username: $('#username').val(),
    //     password: $('#password').val(),
    //     createNewUser: 1,
    //   };

    //   if (formData.first_name != "" && formData.last_name != "" && formData.username != "") {
    //     $.ajax({
    //       type:"POST",
    //       url:"core/handleForms.php",
    //       data: formData,
    //       success: function (data) {
    //         console.log(data);
    //       },
    //       error: function (xhr, status, error) {
    //         console.log(error);
    //       }
    //     })
    //   }
    //   else {
    //     alert("Make sure no input fields are empty!")
    //   }
    // })
  </script>
</body>
</html>
