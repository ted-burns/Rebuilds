<?php
if(session_status() == PHP_SESSION_NONE) {
  session_start();
}


if(!isset($_POST["action"])) {
  display();
}
else {
  switch($_POST["action"]) {
    case "display": display(); break;
    case "edit": edit(); break;
    case "new": insert(); break;
    case "get_details": get_details($_POST["name"]); break;
    default: display();
  }
}

function display() {
  require_once("navbar.php");
  require_once("db.php");
  $dbc = db_connect();
  $query = "select title, message, name from email where name = 'default';";
  $result = mysqli_query($dbc,$query);
  $row = mysqli_fetch_row($result);
  mysqli_free_result($result);
  $query = "select name from email where name != 'default';";

?>
<div id="alert-container">
</div>
<form class="form text-center center-block">
  <div class="form-group col-md-8 col-md-offset-2">
    <label for="name">Email Entry Name:</label>
    <select class="form-control" id="name" name="name">
      <?php echo "<option selected class=\"text-center\" value=\"$row[2]\">$row[2]</option>";
      if($result = mysqli_query($dbc, $query)) {
        while($name = mysqli_fetch_row($result)) {
          echo "<option value=\"$name[0]\">$name[0]</option>";
        }
        mysqli_free_result($result);
        mysqli_close($dbc);
      }
      echo "<option value=\"new\">Create New Email</option>";
      ?>
    </select>
    <input type="text" class="form-control" name="new-name" id="new-name" style="margin-top:10px;"/>
  </div>
  <div class="form-group col-md-8 col-md-offset-2">
    <label for="title">Email Title:</label><br/>
    <input type="text" class="form-control" id="title" <?php echo "value=\"$row[0]\""; ?>/>
  </div>
  <div class="form-group col-md-8 col-md-offset-2">
    <label for="message">Email Message:</label><br/>
    <textarea rows="6" class="form-control" id="message" ><?php echo $row[1]; ?></textarea>
  </div>
  <div class="form-group col-md-6">
    <input type="button" class="btn btn-default btn-lg" value="Test This Email" id="test"/>
  </div>
  <div class="form-group col-md-6">
    <input type="button" class="btn btn-primary btn-lg" value="Save Changes" id="send"/>
  </div>

  <!-- Modal -->
		<div class="modal fade" id="modal-test" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modal-test-label">Test Email</h4>
			  </div>
        <h4 style="margin-top: 10px; text-align: center;">Note: You must have saved the email before you can test it</h4>
      <form>
			  <div class="">

					<input type="hidden" name="test-name" id="test-name" value="Test Name" />
          <input type="hidden" name="insert" id="insert" value="" />

					 <div class="form-group container col-md-12" style="margin-top: 10px;">
						<label for="test-email">Email To Send Test To</label>
						<input type="email" required class="form-control" id="test-email" placeholder="john.doe@bc.edu" name="test-email">
					</div>

			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" id="send-test" class="btn btn-primary">Send Test Email</button>
        </form>
			  </div>
			</div>
		  </div>
		</div>


  <script>
    $("#new-name").hide();

    $("#send").click(function() {
      var val = $("#name").val();
      if(val == "new") {
        var newname = $("#new-name").val()
        $.ajax({
          url: "edit_mail.php",
          method: "POST",
          data: {action: "new", name: $("#new-name").val(), title: $("#title").val(), message: $("#message").val()},
          success: function(data) {
            $("#alert-container").html(data);
          }
        });
        $("#name").prepend("<option value='" + newname + "'>" + newname + "</option>");
        $("#name").val(newname);
        $("#new-name").hide();
      }
      else {
        $.ajax({
          url: "edit_mail.php",
          method: "POST",
          data: {action: "edit", name: $("#name").val(), title: $("#title").val(), message: $("#message").val()},
          success: function(data) {
            $("#alert-container").html(data);
          }
        });
      }
    });

    $("#name").change(function() {
      if( $("#name").val() != "new" ) {
        $("#new-name").hide();
        $.ajax({
          url: "edit_mail.php",
          method: "POST",
          data: {action: "get_details", name: $("#name").val()},
          success: function(data) {
            vals = data.split("0000000000");
            $("#title").val(vals[0]);
            $("#message").val(vals[1]);
          }
        });
      } else {
        $("#new-name").show();
        $("#title").val("");
        $("#message").val("");
      }
    });

    $("#test").click(function() {
      $("#modal-test").modal('show');
    });

    $("#send-test").click(function() {
      var email = $("#test-email").val();
      var test_name = $("#test-name").val();
      var email_name = $("#name").val();
      var data = {email: email, name: test_name, email_name: email_name};
      $.ajax({
        url: "mail.php",
        method: "POST",
        data: {email: email, name: test_name, email_name: email_name},
        success: function(data) {
          $("#modal-test").modal('hide');
        },
        error: function(error) {
          console.log(error);
        }
      });
    });
  </script>
</form>
<?php
}

function edit() {
  require_once("db.php");
  $dbc = db_connect();
  $name = $_POST["name"];
  $title = $_POST["title"];
  $message = $_POST["message"];
  $query = "update email set title=\"$title\", message=\"$message\" where name = \"$name\";";
  if(!($result = mysqli_query($dbc,$query))) {
    echo "<h3>Did not edit</h3>";
  }
  else {
    echo "<h3>Edited successfully</h3>";
  }
  mysqli_close($dbc);
}

function get_details() {
  $name = $_POST["name"];
  require_once("db.php");
  $dbc = db_connect();
  $query = "select title, message from email where name = \"$name\";";
  $result = mysqli_query($dbc,$query);
  if($result == False) {
    echo "Fail0000000000Fail";
  }
  else {
    $row = mysqli_fetch_row($result);
    echo $row[0]."0000000000".$row[1];
    mysqli_free_result($result);
  }
  mysqli_close($dbc);
}
function insert() {
  require_once("db.php");
  $dbc = db_connect();
  $name = $_POST["name"];
  $title = $_POST["title"];
  $message = $_POST["message"];
  $query = "insert into email (name, title, message) values ('$name','$title','$message');";
  mysqli_query($dbc, $query);
  mysqli_close($query);
}
