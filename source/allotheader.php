<?php 
  if (!isset($_SESSION['username'])) {
  	header("Location: alogin.php");
  }
  if (isset($_GET['logout'])) {
    unset($_SESSION['username']);
    session_destroy();
    mysqli_close($db);
  	header("Location: alogin.php");
  }
  require("db.php");
  require("allotfunctions.php");

  $complaintcount = getComplantCount($db);
  $requestcount = getRequestCount($db);
  $suggestioncount = getSuggestionCount($db);
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
              <span class="h2 font-weight-bold mb-0"> <?php echo $requestcount['count(*)']; ?></span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                <i class="fas fa-chart-bar"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-muted text-sm">
            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> <?php echo $requestcount['count(*)']; ?></span>
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
              <span class="h2 font-weight-bold mb-0"> <?php echo $suggestioncount['count(*)']; ?></span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                <i class="far fa-file-alt"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-muted text-sm">
            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> <?php echo $suggestioncount['count(*)']; ?></span>
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
              <span class="h2 font-weight-bold mb-0"> <?php echo $complaintcount['count(*)']; ?></span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                <i class="fas fa-chart-pie"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-muted text-sm">
            <span class="text-danger mr-2"><i class="fas fa-arrow-up"></i> <?php echo $complaintcount['count(*)']; ?></span>
            <span class="text-nowrap">Since last month</span>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>