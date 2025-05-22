<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <style>
      body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
      }
      
      .navbar {
        background: linear-gradient(90deg, #00897B 0%, #004D40 100%);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 1rem 2rem;
      }
      
      .navbar-brand {
        font-weight: 700;
        font-size: 1.5rem;
        letter-spacing: 0.5px;
      }
      
      .hero-section {
        padding: 5rem 0;
        text-align: center;
      }
      
      .hero-title {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        color: #333;
      }
      
      .hero-subtitle {
        font-size: 1.25rem;
        color: #666;
        margin-bottom: 3rem;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
      }
      
      .choice-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
      }
      
      .choice-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
      }
      
      .card-img-container {
        height: 250px;
        overflow: hidden;
      }
      
      .card-img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
      }
      
      .choice-card:hover .card-img-container img {
        transform: scale(1.05);
      }
      
      .card-content {
        padding: 2rem;
        text-align: center;
      }
      
      .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #333;
      }
      
      .card-text {
        color: #666;
        margin-bottom: 1.5rem;
      }
      
      .btn-client {
        background: linear-gradient(135deg, #00897B 0%, #004D40 100%);
        border: none;
        border-radius: 50px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
      }
      
      .btn-client:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 137, 123, 0.2);
        color: white;
      }
      
      .btn-freelancer {
        background: linear-gradient(135deg, #5E35B1 0%, #3949AB 100%);
        border: none;
        border-radius: 50px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
      }
      
      .btn-freelancer:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(94, 53, 177, 0.2);
        color: white;
      }
      
      .footer {
        background: #f8f9fa;
        padding: 2rem 0;
        text-align: center;
        margin-top: 5rem;
      }
    </style>
    <title>Upwork Clone | Find Talent or Work</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="#">
          <i class="fas fa-briefcase mr-2"></i>Upwork Clone
        </a>
      </div>
    </nav>
    
    <div class="container">
      <div class="hero-section">
        <h1 class="hero-title">Find Talent. Find Work.</h1>
        <p class="hero-subtitle">Connect with the best freelancers for your projects or find exciting work opportunities as a freelancer.</p>
        
        <div class="row">
          <div class="col-md-6 mb-4">
            <div class="choice-card">
              <div class="card-img-container">
                <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Client image">
              </div>
              <div class="card-content">
                <h3 class="card-title">I'm a Client</h3>
                <p class="card-text">Looking to hire skilled professionals for your project? Find the perfect match from our pool of talented freelancers.</p>
                <a href="client/login.php" class="btn btn-client">
                  <i class="fas fa-briefcase mr-2"></i>Hire Talent
                </a>
              </div>
            </div>
          </div>
          
          <div class="col-md-6 mb-4">
            <div class="choice-card">
              <div class="card-img-container">
                <img src="https://images.unsplash.com/photo-1598257006626-48b0c252070d?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Freelancer image">
              </div>
              <div class="card-content">
                <h3 class="card-title">I'm a Freelancer</h3>
                <p class="card-text">Ready to showcase your skills and find exciting projects? Browse available gigs and submit your proposals.</p>
                <a href="freelancer/login.php" class="btn btn-freelancer">
                  <i class="fas fa-user-tie mr-2"></i>Find Work
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <footer class="footer">
      <div class="container">
        <p class="mb-0">© 2025 Upwork Clone. All rights reserved.</p>
      </div>
    </footer>
  </body>
</html>
