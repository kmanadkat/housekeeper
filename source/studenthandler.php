<?php
  session_start();
  require("db.php");

  // ================== Clean Request Handler =================== //
  if(isset($_POST['reqSubmit']) && isset($_SESSION['rollnumber'])){
    $rollnumber = $_SESSION['rollnumber'];
    $reqDate = mysqli_real_escape_string($db, $_POST['reqDate']);
    $reqTime = mysqli_real_escape_string($db, $_POST['reqTime']);
    // Format Date Before Submission
    $reqdate = date('Y-m-d', strtotime($reqDate));

    $req_query = "INSERT into cleanrequest(rollnumber,date,cleaningtime) values ('$rollnumber','$reqdate','$reqTime')";
    $req_result = mysqli_query($db,$req_query);
    if ($req_result) {
      $_SESSION['req_sent'] = "Cleaning Request is sent for ".$reqdate." ".$reqTime;
    }else {
      $_SESSION['req_failed'] = "Failed to send request, contact administrator.";
    }
    header("Location: request.php");
  }

  // ================== Feedback Handler =================== //
  if(isset($_POST['feedSubmit'])  && isset($_SESSION['rollnumber']) ){

    $rollnumber = $_SESSION['rollnumber'];
    $feedreqid = mysqli_real_escape_string($db, $_POST['feedReqid']);
    $feedrating = mysqli_real_escape_string($db, $_POST['feedRating']);
    $feedtimein = mysqli_real_escape_string($db, $_POST['feedTimein']);
    $feedtimeout = mysqli_real_escape_string($db, $_POST['feedTimeout']);
    $feedsuggestion = mysqli_real_escape_string($db, $_POST['feedSuggestion']);
    $feedcomplaints = mysqli_real_escape_string($db, $_POST['feedComplaints']);

    $feed_query = "INSERT into feedback(rollnumber,request_id,rating,timein,timeout) values ('$rollnumber','$feedreqid','$feedrating','$feedtimein','$feedtimeout')";

    // Submit Feedback
    $feed_result = mysqli_query($db, $feed_query);

    // Increment Rooms Cleaned and req status
    $workerid = mysqli_query($db, "SELECT worker_id from cleanrequest where request_id='$feedreqid'");
    $workerid2 = mysqli_fetch_assoc($workerid);
    $workerid3 = $workerid2['worker_id'];
    mysqli_query($db, "Update housekeeper set rooms_cleaned = rooms_cleaned + 1 where worker_id = '$workerid3'");
    mysqli_query($db, "Update cleanrequest set req_status = 2 where request_id = '$feedreqid'");

    if ($feed_result) {
      $_SESSION['feed_sent'] = "Feedback is sent for request id - ".$feedreqid;
    }

    $feedid = mysqli_query($db, "SELECT feedback_id from feedback where request_id='$feedreqid'");
    $feedid2 = mysqli_fetch_assoc($feedid);
    $feedid3 = $feedid2['feedback_id'];

    if($feedsuggestion != ""){
      $suggest_query = "INSERT into suggestions(feedback_id,rollnumber,suggestion) values ('$feedid3','$rollnumber','$feedsuggestion')";
      $suggest_result = mysqli_query($db, $suggest_query);
    }

    if($feedcomplaints != ""){
      $complaint_query = "INSERT into complaints(feedback_id,rollnumber,complaint) values ('$feedid3','$rollnumber','$feedcomplaints')";
      $complaint_result = mysqli_query($db, $complaint_query);
      
      mysqli_query($db, "Update housekeeper set complaints = complaints + 1 where worker_id = '$workerid3'");
    }
    header("Location: feedback.php");
  }
?>