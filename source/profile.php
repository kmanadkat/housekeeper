<?php 
  session_start();
  if (!isset($_SESSION['rollnumber'])) {
  	header("Location: login.php");
  }
  if (isset($_GET['logout'])) {
    unset($_SESSION['rollnumber']);
    session_destroy();
    mysqli_close($db);
  	header("Location: login.php");
  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Profile - Housekeeper Student Dashboard</title>
  <?php require("meta.php"); ?>
</head>
<body>
  <!-- Side Navigation -->
  <?php require("sidenav.php"); ?>
  <!-- Main content -->
  <div class="main-content">
      <!-- Header -->
      <div class="header bg-background pb-6 pt-5 pt-md-6">
      <div class="container-fluid">
        <?php 
          require("headerstats.php"); 
          $student = getStudent($_SESSION['rollnumber'], $db); 
        ?>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--5">
      <div class="row mt-2">
        <div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Your Profile</h3>
                </div>
                <div class="col text-right">
                  <a href="mailto:kmanadkat@gmail.com" target="_blank" class="btn btn-sm btn-primary">Request Change</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" style="font-size: 12px;">Roll Number</th>
                    <th scope="col" style="font-size: 13px;"><?php echo $student['rollnumber']; ?></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Hostel</th>
                    <td><?php echo strtoupper($student['hostel']); ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Floor</th>
                    <td><?php echo $student['floor']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Room</th>
                    <td><?php echo strtoupper($student['room']); ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/argon.min.js"></script>
</body>
</html>
