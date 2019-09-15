<?php
  session_start();
  require("db.php");

    // ================== Clean Request Handler =================== //
    if(isset($_POST['allotSubmit']) && isset($_SESSION['username'])){
      $reqId = mysqli_real_escape_string($db, $_POST['allotId']);
      $workerId = mysqli_real_escape_string($db, $_POST['workerId']);
  
      $allot_query = "Update cleanrequest set worker_id = '$workerId', req_status=1 where request_id = '$reqId'";
      $allot_result = mysqli_query($db,$allot_query);
      if ($allot_result) {
        $_SESSION['worker_alloted'] = "Housekeeper successfully alloted";
      }else {
        $_SESSION['allotment_failed'] = "Failed to allot worker, contact site management.";
      }
      header("Location: allot.php");
    }

    // Student Registration
    if(isset($_POST['regSubmit']) && isset($_SESSION['username'])){
      $rollnumber = mysqli_real_escape_string($db, $_POST['regRoll']);
      $roomnumber = mysqli_real_escape_string($db, $_POST['regRoom']);
      $floornumber = mysqli_real_escape_string($db, $_POST['regFloor']);
      $password = md5(12345);
      $roomnumber = strtolower($roomnumber);

      $hostel_name = substr($_SESSION['username'], -1);
      $reg_query = "Insert into student values ('$rollnumber', '$password', '$roomnumber', '$floornumber', '$hostel_name')";
      $reg_result = mysqli_query($db, $reg_query);
      if($reg_result){
        $_SESSION['student_registered'] = 'Student with Rollnumber '. $rollnumber .' is Registered.';
      } else{
        $_SESSION['student_registered'] = 'Student is already Registered!';
      }
      header("Location: registerstudent.php");
    }


    // Worker Registration
    if(isset($_POST['regKeeperSubmit']) && isset($_SESSION['username'])){
      $name = mysqli_real_escape_string($db, $_POST['regName']);
      $floornumber = mysqli_real_escape_string($db, $_POST['regFloor']);
      $hostel_name = substr($_SESSION['username'], -1);

      $name = strtolower($name);

      $reg_query = "Insert into housekeeper (name, hostel, floor) values ('$name', '$hostel_name', '$floornumber')";
      $reg_result = mysqli_query($db, $reg_query);
      if($reg_result){
        $_SESSION['worker_registered'] = 'New Housekeeper Registered.';
      } else{
        $_SESSION['worker_registered'] = 'Resistration Failed!';
      }
      header("Location: registerworker.php");
    }

?>