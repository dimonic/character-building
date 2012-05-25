<?php
  $query = "DELETE FROM `character_equipments` WHERE `character_id` = '$_POST[character_id]'";
  issue_query($query);
  // insert up to 45 equipment sets
  for ($c = 0; $c < 44; $c++) {
    if (!empty($_POST["equip_name_{$c}"])) {
      $query = "INSERT INTO `character_equipments` (`character_id`, `name`, `description`, `location`, `weight`, `price`) VALUES ('" . $_POST["character_id"] . "',
                 '" . $_POST["equip_name_{$c}"] . "',
	         '" . $_POST["equip_desc_{$c}"] . "',
	         '" . $_POST["equip_loc_{$c}"] . "',
	         '" . $_POST["equip_wt_{$c}"] . "',
	         '" . $_POST["equip_price_{$c}"] . "')";
      $query_result = issue_query($query);
    }
  }
?>
