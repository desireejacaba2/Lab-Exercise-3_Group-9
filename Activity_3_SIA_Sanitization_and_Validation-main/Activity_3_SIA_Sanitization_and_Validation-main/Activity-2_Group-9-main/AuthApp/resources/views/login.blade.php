<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <style>
    /* Custom styles */
    body {
    background-image: url('{{ asset("imgbg.jpg") }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    }
    .card {
      background-color: rgba(0, 0, 0, 0.4); /* Use rgba to set the transparency */
      border-radius: 10px;
      margin-bottom: 50px;
    }
    .card-header {
      background-color: #E65C19;
      color: #fff; 
      border-top-left-radius: 10px !important;
      border-top-right-radius: 10px !important;
    }
    .btn-primary {
      background-color: #E65C19; 
      border-color: #E65C19;
    }
    .btn-primary:hover {
      background-color: #FDA403;
      border-color: #FDA403;
    }
    .alert-danger {
      background-color: #f8d7da; /* Light red alert background */
      border-color: #f5c6cb;
      color: #721c24; /* Dark red text */
    }
  </style>
</head>
<body>
<div class="row justify-content-center mt-5">
  <div class="col-lg-4">
    <div class="card">
      <div class="card-header">
        <!-- Login title -->
        <h1 class="card-title">Login</h1>
      </div>
      <div class="card-body">
        <!-- Display error message if present -->
        @if(Session::has('error'))
          <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
          </div>
        @endif
        <!-- Login form -->
        <form action="{{ route('login') }}" method="POST">
          @csrf
          <!-- Email input field -->
          <div class="mb-3 input-group">
          <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
            <input type="email" name="email" class="form-control" id="email" placeholder="Your Email" required>
          </div>
          <!-- Password input field -->
          <div class="mb-3 input-group">
          <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
            <input type="password" name="password" class="form-control" id="password" placeholder="Your Password" required>
          </div>
          <!-- Login button -->
          <div class="mb-3">
            <div class="d-grid">
              <button class="btn btn-primary">Login</button>
            </div>
          </div>
          <!-- Link to registration page -->
          <div class="mb-3">
            <p class="text-center">No account yet? <a href="{{ route('register') }}">Register here</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>
