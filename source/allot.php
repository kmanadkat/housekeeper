<?php 
  session_start();
  if (!isset($_SESSION['username'])) {
  	header("Location: alogin.php");
  }
  if (isset($_GET['logout'])) {
    unset($_SESSION['username']);
    session_destroy();
  	header("Location: alogin.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Housekeeper Admin Dashboard</title>
  <?php require("meta.php"); ?>
</head>
<body>
  <!-- Side Navigation -->
  <?php require("allotsidenav.php"); ?>
  <!-- Main content -->
  <div class="main-content">
      <!-- Header -->
      <div class="header bg-background pb-6 pt-5 pt-md-6">
      <div class="container-fluid">
        <!-- notification message -->
        <?php if (isset($_SESSION['admin_logged'])) : ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-inner--text"><strong>Welcome to online Housekeeping admin portal.</strong>
            <?php echo $_SESSION['admin_logged']; unset($_SESSION['admin_logged']); ?>
          </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif ?>

        <!-- notification message -->
        <?php if (isset($_SESSION['worker_alloted'])) : ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-inner--text"><strong><?php echo $_SESSION['worker_alloted']; ?></strong>
            <?php unset($_SESSION['worker_alloted']); ?>
          </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif ?>


        <?php require("allotheader.php"); ?>
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
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Housekeeper</th>
                    <th scope="col">Room</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time Requested</th>
                    <th scope="col">Time In</th>
                    <th scope="col">Time Out</th>
                  </tr>
                </thead>
                <tbody>
<?php 
$info = getRequests($_SESSION['username'],$db);
if(mysqli_num_rows($info) > 0){
  while ($row = mysqli_fetch_assoc($info)) {

?>
                  <tr>
                    <th scope="row">
<?php 
if($row['wid']==NULL){
  echo "<a href='allotworker.php?request_id=". $row['request_id'] ."&room_num=".$row['room']."&req_time=".date('h:i a', strtotime($row['cleaningtime']))."' class='btn btn-sm btn-primary'>Allot Housekeeper</a>";
} else if ($row['wid'] != NULL && $row['req_status'] == 1){
  echo $row['name'] . " - Alloted";
} else if ($row['wid'] != NULL && $row['req_status'] == 2){
  $numstars = $row['rating'];
  $str="";
  for ($i=0; $i < $numstars; $i++) { 
    if($i==0)
      $str .= "<i class='fas fa-star fa-xs' style='color:#f1c40f'></i>";
    else
      $str .= "<i class='ml-1 fas fa-star fa-xs' style='color:#f1c40f'></i>";
  }
  echo $row['name'] ."<br>". $str;
}
?>
                    </th>
                    <td>
<?php
echo strtoupper($row['room']);
?>
                    </td>
                    <td>
<?php
echo $row['date'];
?>
                    </td>
                    <td>
<?php
$cleaningtime = $row['cleaningtime']; 
echo date('h:i a', strtotime($cleaningtime));
?>                      
                    </td>
                    <td>
<?php
if($row['timein']==NULL){
  echo "--";
} else{
  $fdtimein = $row['timein']; 
  echo date('h:i a', strtotime($fdtimein));
}
?>  
                    </td>
                    <td>
<?php
if($row['timeout']==NULL){
  echo "--";
} else{
  $fdtimeout = $row['timeout']; 
  echo date('h:i a', strtotime($fdtimeout));
}
?>  
                    </td>
                  </tr>
<?php
  }}
?>
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