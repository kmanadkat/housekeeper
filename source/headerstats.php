<?php 
  if (!isset($_SESSION['rollnumber'])) {
  	header("Location: login.php");
  }
  if (isset($_GET['logout'])) {
    unset($_SESSION['rollnumber']);
    session_destroy();
    mysqli_close($db);
  	header("Location: login.php");
  }
  require("db.php");
  require('studentfunctions.php');
  $requestCount = getRequestCount($_SESSION['rollnumber'], $db);
  $complaintCount = getComplantCount($_SESSION['rollnumber'], $db);
  $suggestionCount = getSuggestionCount($_SESSION['rollnumber'], $db);
?>
<div class="header-body">
  <!-- Card stats -->
  <div class="row">
    <div class="col-lg-4 col-md-6">
      <div class="card card-stats mb-4 mb-xl-0">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Clean Requests</h5>
              <span class="h2 font-weight-bold mb-0"><?php echo $requestCount['count(*)']; ?></span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                <i class="fas fa-chart-bar"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-muted text-sm">
            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> <?php echo $requestCount['count(*)']; ?></span>
            <span class="text-nowrap">Since last week</span>
          </p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="card card-stats mb-4 mb-xl-0">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Suggestions</h5>
              <span class="h2 font-weight-bold mb-0"><?php echo $suggestionCount['count(*)']; ?></span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                <i class="far fa-file-alt"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-muted text-sm">
            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> <?php echo $suggestionCount['count(*)']; ?></span>
            <span class="text-nowrap">Since last week</span>
          </p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="card card-stats mb-4 mb-xl-0">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Complaints</h5>
              <span class="h2 font-weight-bold mb-0"><?php echo $complaintCount['count(*)']; ?></span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                <i class="fas fa-chart-pie"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-muted text-sm">
            <span class="text-danger mr-2"><i class="fas fa-arrow-up"></i> <?php echo $complaintCount['count(*)']; ?></span>
            <span class="text-nowrap">Since last month</span>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>