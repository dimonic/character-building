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
<title>Annotated Map of Flanaess</title>
<link rel="stylesheet" type=text/css href="../styles/table.css" title="php-style">
<script language="JavaScript" type="text/javascript" src="../javascript/pick-classes.js"></script>
</head>
<body>

<h1>Annotated Map of the Flanaess</h1>



<? include("flanaess-new"); ?>

<? include("footer.html"); ?>
