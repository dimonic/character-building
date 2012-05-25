<?php

  // deal with character portrait
  $portrait = $_POST['portrait'];
  $uploaded_portrait = $_POST['client_portrait'];
  if (is_uploaded_file($_FILES['uploaded_portrait']['tmp_name'])) {
    if (preg_match('/image\/(gif|jpeg|jpg|png)/', $_FILES['uploaded_portrait']['type'], $type)) {
      $uploaded_portrait = $_FILES['uploaded_portrait']['name'];
      $portrait = tempnam("../uploads/", "portrait") . "." . $type[1];
      move_uploaded_file($_FILES['uploaded_portrait']['tmp_name'], $portrait);
    }
  }
  // deal with character symbol
  $symbol = $_POST['symbol'];
  $uploaded_symbol = $_POST['client_symbol'];
  if (is_uploaded_file($_FILES['uploaded_symbol']['tmp_name'])) {
    if (preg_match('/image\/(gif|jpeg|jpg|png)/', $_FILES['uploaded_symbol']['type'], $type)) {
      $uploaded_symbol = $_FILES['uploaded_portrait']['name'];
      $symbol = tempnam("../uploads/", "symbol") . $type[1];
      move_uploaded_file($_FILES['uploaded_symbol']['tmp_name'], $symbol);
    }
  }

  $query = "UPDATE `characters` SET 
	   `campaign`='$_POST[campaign]',
	   `dm`='$_POST[dm]',
	   `sourcebooks`='$_POST[sourcebooks]',
	   `name`='$_POST[name]', 
	   `race`='$_POST[race]', 
	   `region`='$_POST[region]', 
	   `gender`='$_POST[gender]', 
	   `alignment`='$_POST[alignment]', 
	   `deity`='$_POST[deity]', 
	   `notes`='$_POST[notes]', 
	   `client_portrait`='$uploaded_portrait',
	   `portrait`='$portrait',
	   `client_symbol`='$uploaded_symbol',
	   `symbol`='$symbol' ";
  for ($c = 1; $c <= 4; $c++) {
    $query .= ', 
           `class' . $c . '`="' . $_POST["class{$c}"] . '", `level' . $c . '`="' . $_POST["level{$c}"] . '"';
  }
  for ($c = 1; $c<= 8; $c++) {
    $query .= ',
           `language_' . $c . '`="' . $_POST["language_{$c}"] . '"';
  }
  $query .= ",
           `str`='$_POST[str]', 
	   `dex`='$_POST[dex]', 
	   `con`='$_POST[con]', 
	   `intel`='$_POST[intel]', 
	   `wis`='$_POST[wis]', 
	   `cha`='$_POST[cha]', 
	   `init_str`='$_POST[init_str]', 
	   `init_dex`='$_POST[init_dex]', 
	   `init_con`='$_POST[init_con]', 
	   `init_intel`='$_POST[init_intel]', 
	   `init_wis`='$_POST[init_wis]', 
	   `init_cha`='$_POST[init_cha]',
	   `hp` = '$_POST[hp]'";

  $query .= " WHERE `id` = '$_POST[character_id]'";
  $query_result = issue_query($query);
?>