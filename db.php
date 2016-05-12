<?php

function db_connect() {
  return mysqli_connect("localhost:3306","root","root", "test");
}
