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
  <title>Complaints - Housekeeper Admin Dashboard</title>
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
                  <h3 class="mb-0">Complaints Record</h3>
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
                    <th colspan="3">Complaint</th>
                  </tr>
                </thead>
                <tbody>
<?php 
$info = getComplaints($_SESSION['username'],$db);
if(mysqli_num_rows($info) > 0){
  while ($row = mysqli_fetch_assoc($info)) {

?>
                  <tr>
                    <th scope="row">
<?php 
  $numstars = $row['rating'];
  $str="";
  for ($i=0; $i < $numstars; $i++) { 
    if($i==0)
      $str .= "<i class='fas fa-star fa-xs' style='color:#f1c40f'></i>";
    else
      $str .= "<i class='ml-1 fas fa-star fa-xs' style='color:#f1c40f'></i>";
  }
  echo $row['name'] ."<br>". $str;
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
                    <td colspan="3" style="height: 80px; overflow-y:auto">
<?php
echo $row['complaint'];
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