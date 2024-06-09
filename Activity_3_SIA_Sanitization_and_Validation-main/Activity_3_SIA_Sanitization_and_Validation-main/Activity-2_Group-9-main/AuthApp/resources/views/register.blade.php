<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register Page</title>
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
    .alert-success {
      background-color: #d4edda; 
      border-color: #c3e6cb;
      color: #155724; 
    }
    #preview-image-container {
      max-width: 50%;
      height: auto;
      display: flex;
      justify-content: center;
    }
    #preview-image {
      max-width: 100%;
      max-height: 300px;
      border-radius: 50%; 
      cursor: pointer; 
    }
    #profile-picture-container {
      width: 170px;
      height: 170px;
      border-radius: 50%;
      background-color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      cursor: pointer;
      border: 2px dashed #ccc;
      margin: 0 auto;
      margin-bottom: 2px; 
      }
    #profile-picture-container:hover {
      border-color: #E65C19;
    }
    #profile-picture-label {
      margin: 0;
      font-weight: bold;
    }
  </style>
</head>
<body>
<div class="row justify-content-center mt-5">
  <div class="col-lg-5">
    <div class="card">
      <div class="card-header">
        <!-- Register title -->
        <h1 class="card-title">Register</h1>
      </div>
      <div class="card-body">
        <!-- Display success message if present -->
        @if(Session::has('success'))
          <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
          </div>
        @endif

        <!-- Display error message if present -->
        @if(Session::has('error'))
          <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
          </div>
        @endif

        <!-- Display error message if password validation fails -->
        @if ($errors->has('password'))
          <div class="alert alert-danger" role="alert">
            {{ $errors->first('password') }}
          </div>
        @endif

        <!-- Display error message if contact number validation fails -->
        @if ($errors->has('contact'))
          <div class="alert alert-danger" role="alert">
            {{ $errors->first('contact') }}
          </div>
        @endif

        <!-- Display error message if profile_picture validation fails -->
        @if ($errors->has('profile_picture'))
          <div class="alert alert-danger" role="alert">
            {{ $errors->first('profile_picture') }}
          </div>
        @endif

        <!-- Display error message if age validation fails -->
        @if ($errors->has('age'))
          <div class="alert alert-danger" role="alert">
            {{ $errors->first('age') }}
          </div>
                @endif

        <!-- Display error message if duplicate email-->
                @if ($errors->has('email'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('email') }}
            </div>
        @endif

        <!-- Registration form -->
        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <!-- Profile picture input field -->
          <div class="mb-3 text-center" id="profile-picture-container" onclick="document.getElementById('profile_picture').click()">
            <label for="profile_picture" id="profile-picture-label">Click to Upload</label>
            <input type="file" name="profile_picture" class="form-control" id="profile_picture" style="display: none;" accept="image/*" onchange="previewImage(event)">
          </div>

          <!-- Image preview -->
          <div class="mb-3 d-flex justify-content-center" id="preview-image-container">
            <img id="preview-image" src="#" alt="Preview Image" style="display: none;">
          </div>

          <!-- Cancel button for profile picture -->
          <div class="mb-3 d-flex justify-content-end">
            <button type="button" class="btn btn-secondary" onclick="cancelProfilePicture()">Cancel</button>
          </div>

          <!-- Name input field -->
          <div class="mb-3 input-group">
          <span class="input-group-text"><i class="fa fa-user"></i></span>
            <input type="text" name="name" class="form-control" id="name" placeholder="Full Name" required>
          </div>

          <!-- Email input field -->
          <div class="mb-3 input-group">
          <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
            <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
          </div>

          <!-- Password input field -->
          <div class="mb-3 input-group">
            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
          </div>

          <!-- Password confirmation input field -->
          <div class="mb-3 input-group">
            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm Password" required>
          </div>


          <!-- Contact Number input field -->
          <div class="mb-3 input-group">
          <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
            <input type="int" name="contact" class="form-control" id="contact" placeholder="Contact Number" required>
          </div>

          <!-- Age field -->
          <div class="mb-3 input-group">
          <span class="input-group-text"><i class="fa-solid fa-image-portrait"></i></span>
            <input type="int" name="age" class="form-control" id="age" placeholder="Age" required>
          </div>

          <!-- Register button -->
          <div class="mb-3">
            <div class="d-grid">
              <button class="btn btn-primary">Register</button>
            </div>
          </div>

          <!-- Link to login page -->
          <div class="mb-3">
            <p class="text-center">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  function previewImage(event) {
  var reader = new FileReader();
  reader.onload = function(){
    var container = document.getElementById('profile-picture-container');
    container.style.backgroundImage = "url('" + reader.result + "')";
    container.style.backgroundSize = "cover";
    container.style.backgroundPosition = "center";
    container.style.backgroundRepeat = "no-repeat";
    container.style.border = "none";
    
    // Hide the "Click to Upload" label
    var label = document.getElementById('profile-picture-label');
    label.style.display = "none";
  }
  reader.readAsDataURL(event.target.files[0]);
}
  function cancelProfilePicture() {
    // Clear the background image of the container
    var container = document.getElementById('profile-picture-container');
    container.style.backgroundImage = "none";

     // Show the "Click to Upload" label
  var label = document.getElementById('profile-picture-label');
  label.style.display = "block";
    container.style.border = "2px dashed #ccc";

    // Reset the file input field
    var input = document.getElementById('profile_picture');
    input.value = '';
  }
</script>
</body>
</html>


