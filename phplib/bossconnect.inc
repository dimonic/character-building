<?php
  // connect to database
  require_once('DB.php');
  $host = "localhost";
  $database = "dnd";
  $user = "root";
  $password = "wa\$mozar";
  $db = DB::connect("mysql://$user:$password@$host/$database");
  if (DB::iserror($db)) {
    echo "<pre>Problem connecting to dnd database</pre>\n";
    die($db->getMessage());
  }
?>