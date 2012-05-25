<?php

  require_once('DB.php');
  require_once('../phplib/lib.inc.php');
  require_once('../phplib/dnd.lib.php');
  require_once('../phplib/connect.inc.php');

  if (check_login() == false) {
    header('WWW-Authenticate: Basic realm="Character Management (Cancel to create new user)"');
    header('HTTP/1.0 401 Unauthorized');

    include("../users/new-account.php");
  } else {
    // and go to their page    
    include("../characters/browse.php");
  }
?>
