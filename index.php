<?php session_start(); ?>
<html>
<head>
  <title>WIHD Completed Rebuild Form</title>
  <script   src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
  <form action="mail.php" method="post" style="padding-left:10%;padding-right:10%;">
    <?php
      if(isset($_SESSION["result"])) {
       if($_SESSION["result"] == 1) {
          ?>
      <div class="alert alert-success alert-dismissible" style="text-align:center; margin-top:2%;"role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        Submitted
      </div>
          <?php
        }
        else {
          ?>
      <div class="alert alert-danger alert-dismissible" style="text-align:center;margin-top:2%;" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Warning!</strong> Did not submit correctly.
      </div>
      <?php
        }
      }
     ?>
    <h2 style="text-align:center">Boston College HelpDesk Rebuild Complete Form</h1>
    <div class="form-group col-lg-6">
      <label for="ticket_num" />Ticket Number:</label>
      <input required type="text" class="form-control" name="ticket_num" id="ticket_num" <?php
      if(isset($_SESSION["ticket_num"])) echo "value=\"".$_SESSION["ticket_num"]."\""; ?>/>
    </div>

    <div class="form-group col-lg-6">
      <label for="email">BC Email Address:</label>
      <input required type="email" class="form-control" name="email" id="email"  <?php
      if(isset($_SESSION["email"])) echo "value=\"".$_SESSION["email"]."\""; ?>/>
    </div>

    <div class="form-group col-lg-6">
      <label for="service">Service Performed:</label>
      <div class="radio col-lg-12">
        <label>
          <input required type="radio" name="service" value="Rebuild"
          <?php
          if(isset($_SESSION["service"]) && $_SESSION["service"] == "Rebuild") echo " selected ";?> >
            Rebuild
          </input>
        </label>
      </div>
      <div class="radio col-lg-12">
        <label>
          <input type="radio" name="service" value="Boot Camp" <?php
          if(isset($_SESSION["service"]) && $_SESSION["service"] == "Boot Camp") echo " selected ";?>>Boot Camp</input>
        </label>
      </div>
    </div>

    <div class="form-group col-lg-6">
      <label for="os">OS:</label>
      <select class="form-control" name="os" id="os">
        <option value="Windows 7" <?php
        if(isset($_SESSION["os"]) && $_SESSION["os"] == "Windows 7") echo " selected ";?>>Windows 7</option>
        <option value="Windows 8" <?php
        if(isset($_SESSION["os"]) && $_SESSION["os"] == "Windows 8") echo " selected ";?>>Windows 8</option>
        <option value="Windows 10" <?php
        if(isset($_SESSION["os"]) && $_SESSION["os"] == "Windows 10") echo " selected ";?>>Windows 10</option>
        <option value="OSX 10.9 Mavericks" <?php
        if(isset($_SESSION["os"]) && $_SESSION["os"] == "OSX 10.9 Mavericks") echo " selected ";?>>OSX 10.9 Mavericks</option>
        <option value="OSX 10.10 Yosemite" <?php
        if(isset($_SESSION["os"]) && $_SESSION["os"] == "OSX 10.10 Yosemite") echo " selected ";?>>OSX 10.10 Yosemite</option>
        <option value="OSX 10.11 El Capitan" <?php
        if(isset($_SESSION["os"]) && $_SESSION["os"] == "OSX 10.11 El Capitan") echo " selected ";?>>OSX 10.11 El Capitan</option>
      </select>
    </div>

    <div class="form-group col-lg-6">
      <label for="type">Build Type:</label>
      <div class="radio col-lg-12">
        <label>
          <input required type="radio" name="type" value="MDT" <?php
          if(isset($_SESSION["type"]) && $_SESSION["type"] == "MDT") echo " selected ";?>>MDT</input>
        </label>
      </div>
      <div class="radio col-lg-12">
        <label>
          <input type="radio" name="type" value="Windows 8 Refresh" <?php
          if(isset($_SESSION["type"]) && $_SESSION["type"] == "Windows 8 Refresh") echo " selected ";?>>Windows 8 Refresh</input>
        </label>
      </div>
      <div class="radio col-lg-12">
        <label>
          <input type="radio" name="type" value="OEM Disk" <?php
          if(isset($_SESSION["type"]) && $_SESSION["type"] == "OEM Disk") echo " selected ";?>>OEM Disk</input>
        </label>
      </div>
      <div class="radio col-lg-12">
        <label>
          <input type="radio" name="type" value="Double Rebuild" <?php
          if(isset($_SESSION["type"]) && $_SESSION["type"] == "Double Rebuild") echo " selected ";?>>Double Rebuild</input>
        </label>
      </div>
    </div>

    <div class="form-group col-lg-6">
      <label for="reason">Reason for Rebuild:</label>
      <select class="form-control" name="reason" id="reason">
        <option value="Visual Basic">Visual Basic</option>
        <option value="Excel Analytics Solver">Excel Analytics Solver</option>
        <option value="ARC GIS">ARC GIS</option>
        <option value="Corrupt OS">Corrupt OS</option>
        <option value="Bad SATA Cable">Bad SATA Cable</option>
        <option value="New HD">New Hard Drive</option>
        <option value="DMCA">DMCA</option>
        <option value="Customer Request/Upgrade">Customer Request/Upgrade</option>
        <option value="Wipe and Rebuild for New Employee">Wipe and Rebuild for New Employee</option>
        <option value="OSX Upgrade">OSX Upgrade</option>
      </select>
    </div>

    <div class="form-group col-lg-6">
      <label for="computer">Machine Type:</label>
      <input require type="text" class="form-control" name="computer" id="computer" <?php
      if(isset($_SESSION["email"])) echo "value=\"".$_SESSION["email"]."\""; ?>/>
    </div>

    <div class="form-group col-lg-6">
      <label for="notes">Notes:</label>
      <textarea rows="4" class="form-control" name="notes" id="notes" <?php
      if(isset($_SESSION["email"])) echo "value=\"".$_SESSION["email"]."\""; ?>></textarea>
    </div>

    <input type="submit" class="btn btn-primary btn-block" />
  </form>
</body>
</html>
