<?php
  session_start();
  unset($_SESSION);
  $email = $_POST["email"];
  $ticket_num = $_POST["ticket_num"];
  $service = $_POST["service"];
  $build_type = $_POST["type"];
  $os = $_POST["os"];
  $reason = $_POST["reason"];
  $computer = $_POST["computer"];
  $notes = $_POST["notes"];

  // Always set content-type when sending HTML email
  $headers = 'From: helpdesk@bc.edu' . "\r\n" .
      'Reply-To: helpdesk@bc.edu' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();

// More headers

$message = "Hello,

Your computer is ready to be picked up. Our hours are Monday - Friday 9am - 5pm.

Have a nice day.";
mail($email, "Your Computer is Ready",$message,$headers);

$dbc = mysqli_connect("localhost:3306","root","root", "rebuilds") or die("unable to connect to db");
$query = "insert into rebuilds (email, ticket_num, service, build_type, os, reason, computer, notes) values ";
$query.= "(\"$email\", $ticket_num, \"$service\",\"$build_type\",\"$os\",\"$reason\",\"$computer\",\"$notes\");";
$_SESSION["result"] = mysqli_query($dbc, $query);
mysqli_close($dbc);
if($_SESSION["result"] == 1) {
  $_SESSION["email"] = $_POST["email"];
  $_SESSION["ticket_num"] = $_POST["ticket_num"];
  $_SESSION["service"] = $_POST["service"];
  $_SESSION["type"] = $_POST["type"];
  $_SESSION["os"] = $_POST["os"];
  $_SESSION["reason"] = $_POST["reason"];
  $_SESSION["computer"] = $_POST["computer"];
  $_SESSION["notes"] = $_POST["notes"];

}
header("Location: index.php");
