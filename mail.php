<?php
if(session_status() == PHP_SESSION_NONE) {
  session_start();
}
  unset($_SESSION);

  $email = $_POST["email"];

  $insert = isset($_POST["insert"]) ? True: False;
  if($insert == True) {
    $ticket_num = $_POST["ticket_num"];
    $service = $_POST["service"];
    $build_type = $_POST["type"];
    $os = $_POST["os"];
    $reason = $_POST["reason"];
    $computer = $_POST["computer"];
    $notes = $_POST["notes"];
  }
  $name = $_POST["name"];
  $email_name = $_POST["email_name"];


  // Always set content-type when sending HTML email
  $headers = 'From: helpdesk@bc.edu' . "\r\n" .
      'Reply-To: helpdesk@bc.edu' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();

// More headers

$dbc = mysqli_connect("localhost:3306","root","root", "test");

$result = mysqli_query($dbc,"select title, message from email where name = \"$email_name\";");

$row = mysqli_fetch_row($result);
$message = $row[1];
$split = explode("[name]", $message);
if(count($split) > 1) {
  $count = count($split);
  for($i=0; $i<$count;$i++) {
    if($i == 0) {
      $message = $split[$i];
    }
    else {
      $message .= $name.$split[$i];
    }
  }
}
mysqli_free_result($result);

$signature = "\n--
BC Walk-in Help Desk
O'Neil 316 Monday-Friday 9am-5pm
617-552-8916";
mail($email, $row[0],$message.$signature,$headers);


if($insert == True) {
  $query = "insert into rebuilds (email, ticket_num, service, build_type, os, reason, computer, notes) values ";
  $query.= "(\"$email\", $ticket_num, \"$service\",\"$build_type\",\"$os\",\"$reason\",\"$computer\",\"$notes\");";
  $_SESSION["result"] = mysqli_query($dbc,$query);
  $result = mysqli_query($dbc,"select * from rebuilds where ticket_num = $ticket_num;");
  if($row = mysqli_fetch_row($result)) {
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["ticket_num"] = $_POST["ticket_num"];
    $_SESSION["service"] = $_POST["service"];
    $_SESSION["type"] = $_POST["type"];
    $_SESSION["os"] = $_POST["os"];
    $_SESSION["reason"] = $_POST["reason"];
    $_SESSION["computer"] = $_POST["computer"];
    $_SESSION["notes"] = $_POST["notes"];
  }
  else {
    $_SESSION["result"] = 1;
  }
  mysqli_close($dbc);
  header("Location: submitted.php");
}
