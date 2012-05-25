<?php
  // connect
  require_once('DB.php');
  require_once('../phplib/metabase.lib.php');
  require_once('../phplib/dnd.lib.php');

  db_connect("dnd");

  $post = $HTTP_POST_VARS;
  $returnto = $HTTP_GET_VARS[referer];

  // echo "<pre>$post[username]</pre>\n";
  $query = "SELECT * FROM `users` WHERE `username` = '$post[username]'";
  $query_result = issue_query($query);
  if (($row = $query_result->fetchRow(DB_FETCHMODE_ASSOC))) {
    if (DB::isError($row)) {
      die($row->getMessage());
    }
    header("Location: ../users/new-account2.php?referer=$returnto");
  } else {
    $query = "INSERT INTO users (`user_id`, `username`, `passwd`, `groups`, `fullname`) VALUES ('', '$post[username]', MD5('$post[passwd]'), NULL, '$post[fullname]')";
    issue_query($query);

    $preferences = $_COOKIE[preferences];
    // We are now logged in, so we can save their cookie:
    if (!ereg('login', $preferences)) {
      $preferences .= "login:$post[username]&passwd:$post[passwd]";
      setcookie('preferences', $preferences, time() + 60*60*24*365, '/~dnd/');
    }

    header("Location: $returnto");
  }
?>
