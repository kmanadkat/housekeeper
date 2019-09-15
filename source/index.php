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
  <title>Housekeeper Student Dashboard</title>
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
        <!-- notification message -->
        <?php if (isset($_SESSION['student_logged'])) : ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-inner--text"><strong>Welcome to online Housekeeping service.</strong>
            <?php echo $_SESSION['student_logged']; unset($_SESSION['student_logged']); ?>
          </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif ?>

        <?php require("headerstats.php"); ?>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--5">
      <div class="row mt-2 pb-5">
        <div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Housekeeping</h3>
                </div>
                <div class="col text-right">
                  <a href="request.php" class="btn btn-sm btn-primary">Send Request</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Housekeeper</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time Requested</th>
                    <th scope="col">Time In</th>
                    <th scope="col">Time Out</th>
                  </tr>
                </thead>
                <tbody>
<?php 
$requestrows = getRequests($_SESSION['rollnumber'], $db);
if(mysqli_num_rows($requestrows) > 0){
  while ($row = mysqli_fetch_assoc($requestrows)) {

?>
                  <tr>
                    <th scope="row">
<?php 
if($row['worker_id'] == NULL && $row['req_status'] == 0 ) {
  echo "<span style='color:#EE801A'>Not Alloted</span> - " .$row['reqid'];
} 
else if($row['worker_id'] != NULL && $row['req_status'] == 1 ){
  echo $row['name']." - <span style='color:#2980b9'>Alloted</span> - ".$row['reqid'];
}
else if($row['worker_id'] != NULL && $row['req_status'] == 2 ){
  echo $row['name']." - <span style='color:#27ae60'>Served</span> - ".$row['reqid'];
}
?>
                    </th>
                    <td>
                      <?php echo $row['date']; ?>
                    </td>
                    <td>
                    <?php 
                    $cleaningtime = $row['cleaningtime']; 
                    echo date('h:i a', strtotime($cleaningtime));
                    ?>
                    </td>
                    <td>
<?php 
if($row['timein'] == NULL) {
  echo "<span style='color:#EE801A'>--</span>";
} 
else if($row['timein'] != NULL){
  $timei = $row['timein']; 
  echo date('h:i a', strtotime($timei));
}
?>
                    </td>
                    <td>
<?php 
if($row['timeout'] == NULL) {
  echo "<span style='color:#EE801A'>--</span>";
} 
else if($row['timeout'] != NULL){
  $timeo = $row['timeout']; 
  echo date('h:i a', strtotime($timeo));
}
?>
                    </td>
                  </tr>
<?php }} ?>
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
