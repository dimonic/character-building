<?php

  // connect
  require_once('DB.php');
  require_once('../phplib/metabase.lib.php');
  require_once('../phplib/dnd.lib.php');

  db_connect("dnd");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Annotated Map of the Free City of Greyhawk</title>
<link rel="stylesheet" type=text/css href="../styles/table.css" title="php-style">
<script language="JavaScript" type="text/javascript" src="../javascript/pick-classes.js"></script>
</head>
<body>

<h2>Annotated Map of the Free City of Greyhawk</h2>



<? include("greyhawk"); ?>

<? include("footer.html"); ?>
