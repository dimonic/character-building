<?php
  // connect to database
  require_once('DB.php');
  $host = "localhost";
  $database = "dnd";
  $user = "gcoa";
  $password = "gcoa";
  $db = DB::connect("mysql://$user:$password@$host/$database");
  if (DB::iserror($db)) {
    echo "<pre>Problem connecting to $database database as user $user</pre>\n";
    die($db->getMessage());
  }
?>