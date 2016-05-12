<?php
require_once("navbar.php");
require_once("db.php");
$dbc = db_connect();
$query = "select id, email, ticket_num, service, build_type, os, reason, computer, notes from rebuilds order by 3 desc;";
$result = mysqli_query($dbc, $query);
echo "<div class=\"table-wrapper\" >";
echo "<table class=\"table table-striped table-hover\">";
echo "<tr>";
echo "<th>id</th>";
echo "<th>email</th>";
echo "<th>ticket_num</th>";
echo "<th>service</th>";
echo "<th>build_type</th>";
echo "<th>os</th>";
echo "<th>reason</th>";
echo "<th>computer</th>";
echo "<th>notes</th>";
echo "</tr>";
while($row = mysqli_fetch_row($result)) {
  echo "<tr>";
  foreach($row as $key=>$value) {
    echo "<td>$value</td>";
  }
  echo "</tr>";
}
echo "</table></div>";
?>
<style>
  .table-wrapper {
    overflow-y: auto;
    height: 90%;
    width: 90%;
    margin-left: 5%;
  }
</style>
