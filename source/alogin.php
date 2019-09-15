<?php require("server.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Housekeeper Admin Login</title>

  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">  

  <!-- Custom Style -->
  <link rel="stylesheet" href="assets/css/main.min.css">

  <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
  <link rel="manifest" href="favicon/site.webmanifest">
</head>
<body>
  <header>
    <div class="row parent-row">
      <!-- Image -->
      <div class="col s1 l7 hide-on-med-and-down">
        <div class="flex-v-center">
          <h2>Housekeeper</h2>
          <p>
            <span id="day_today"></span>
            <span id="date_today"></span>
            <span id="month_today"></span>
            <span id="circle">.</span>
            <span id="year_today"></span>
          </p>
          <p class="support-text">Browse requests and complaints. <br>Allot Housekeepers.</p>
        </div>
      </div>
      <!-- Form -->
      <div class="col s12 l5">
        <div class="center-align form-align">
          <h4>Sign In</h4>
          <p class="hide-on-large-only">Browse student requests and complaints. Allot Housekeepers.</p>
          <div class="row">
            <form action="" method="POST" autocomplete="off" class="col s12">
              <?php include("errors.php") ?>
              <div class="row flex-h-center mb-0">
                <div class="input-field col s8">
                  <input type="text" name="adminUsername" id="rollnumber" class="validate" required>
                  <label for="rollnumber">Username</label>
                </div>
              </div>
              <div class="row flex-h-center">
                <div class="input-field col s8">
                  <input type="password" name="adminPassword" id="password" class="validate" required>
                  <label for="password">Password</label>
                </div>
              </div>
              <button type="submit" name="adminLogin" class="waves-effect waves-light btn">Continue</button>
            </form>
            <a class="link" href="login.php">or Student login</a>
          </div>
        </div>
      </div>
    </div>

  </header>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>