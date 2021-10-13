<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  ================================================== -->
  <meta charset="utf-8">
  <title>Efarm | Farms in your pocket</title>

  <!-- Mobile Specific Metas
  ================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Construction Html5 Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Themefisher">
  <meta name="generator" content="Themefisher Constra HTML Template v1.0">

  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="css/style.css">
  
  <!-- Main Script -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="js/sign_in.js"></script>
  

    

</head>

<body id="body">

<section class="signin-page account">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="block text-center">
          <h1>Efarm</h1>
          <h2 class="text-center">Create Your Account</h2>
       
          <form class="text-left clearfix" id="sign_in" action="php/signup.php" method="post">

            <div class="form-group">
              <input type="text" class="form-control " id="first_name" name="first_name" placeholder="First Name" required minlength="3">
            </div>

            <div class="form-group">
              <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required minlength="3">
            </div>

            <div class="form-group">
              <label class="radio-container m-r-45">
                Farmer
                <input type="radio" name="user_type" value="0" required/>
              </label>
            </div>

            <div class="form-group">
              <label class="radio-container m-r-45">
                Customer
                <input type="radio" name="user_type" value="1" required/>
              </label>
            </div>

            <div class="form-group">
              <input type="email" class="form-control" id="email" name="email"  placeholder="Email" required minlength="7">
            </div>

            <div class="form-group" id="password_alert">
              <input type="password" class="form-control" id="password" name="password1"  placeholder="Password" required minlength="8">
            </div>

            <div class="form-group">
              <input type="password" class="form-control" id="confirm_password" name="password2"  placeholder="Confirm password" required minlength="8">
            </div>

            <div class="text-center">
              <button type="button" class="btn btn-main text-center" id="submitt">Sign In</button>
            </div>

          </form>
          <p class="mt-20">Already hava an account ?<a href="/"> Login</a></p>
        </div>
      </div>
    </div>
  </div>
</section>
  </body>
  </html>