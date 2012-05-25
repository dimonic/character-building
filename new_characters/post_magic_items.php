<?php
  // save the weapons, armour and other magic items
  $query = "UPDATE `characters` SET ";
  for ($c = 1; $c <= 4; $c++) {
    $query .= '`weapon_' . $c . '`="'. $_POST["weapon_{$c}"] . '",
	   `weapon_' . $c . '_include`="' . (($_POST["weapon_{$c}_include"]) ? '1' : '0') . '",
	   `weapon_' . $c . '_bonus`="' . $_POST["weapon_{$c}_bonus"] . '",
	   `weapon_' . $c . '_attacks`="' . $_POST["weapon_{$c}_attacks"] . '",
	   `weapon_' . $c . '_damage`="' . $_POST["weapon_{$c}_damage"] . '",
	   `weapon_' . $c . '_crit`="' . $_POST["weapon_{$c}_crit"] . '",
	   `weapon_' . $c . '_range`="' . $_POST["weapon_{$c}_range"] . '",
	   `weapon_' . $c . '_weight`="' . $_POST["weapon_{$c}_weight"] . '",
	   `weapon_' . $c . '_type`="' . $_POST["weapon_{$c}_type"] . '",
           `weapon_' . $c . '_usefinesse`="' . $_POST["weapon_{$c}_usefinesse"] . '",
           `weapon_' . $c . '_size`="' . $_POST["weapon_{$c}_size"] . '",
	   `weapon_' . $c . '_special`="' . $_POST["weapon_{$c}_special"] . '",
	   `weapon_' . $c . '_cost`="' . $_POST["weapon_{$c}_cost"] . '", ';
  }
  $query .= "`armor`='$_POST[armor]',
	   `armor_magic`='$_POST[armor_magic]',
	   `armor_type`='$_POST[armor_type]',
	   `armor_bonus`='$_POST[armor_bonus]',
	   `armor_max_dex`='$_POST[armor_max_dex]',
	   `armor_check_pen`='$_POST[armor_check_pen]',
	   `armor_spell_fail`='$_POST[armor_spell_fail]',
	   `armor_cost`='$_POST[armor_cost]',
	   `armor_special`='$_POST[armor_special]',
	   `armor_weight`='$_POST[armor_weight]',
	   `shield`='$_POST[shield]',
	   `shield_magic`='$_POST[shield_magic]',
	   `shield_type`='$_POST[shield_type]',
	   `shield_bonus`='$_POST[shield_bonus]',
	   `shield_max_dex`='$_POST[shield_max_dex]',
	   `shield_check_pen`='$_POST[shield_check_pen]',
	   `shield_spell_fail`='$_POST[shield_spell_fail]',
	   `shield_cost`='$_POST[shield_cost]',	
	   `shield_special`='$_POST[shield_special]',
	   `shield_weight`='$_POST[shield_weight]'";
  $query .= " WHERE `id` = '$_POST[character_id]'";

  $query_result = issue_query($query);

  // delete existing magic items from character_item
  $query = "DELETE FROM `character_items` WHERE `character_id` = '$_POST[character_id]'";
  issue_query($query);
  // insert up to 60 magic item sets
  for ($c = 0; $c < 60; $c++) {
    if (!empty($_POST["magic_name_{$c}"]) || !empty($_POST["magic_brief_{$c}"])) {
      $query = "INSERT INTO `character_items` (`character_id`, `type`, `name`, `brief_description`, `properties`, `description`, `weight`, `price`) VALUES ('" . $_POST["character_id"] . "',
                 '" . $_POST["magic_type_{$c}"] . "',
                 '" . $_POST["magic_name_{$c}"] . "',
                 '" . $_POST["magic_brief_{$c}"] . "',
	         '" . $_POST["magic_properties_{$c}"] . "',
	         '" . $_POST["magic_description_{$c}"] . "',
	         '" . $_POST["magic_weight_{$c}"] . "',
	         '" . $_POST["magic_price_{$c}"] . "')";
      // echo "<pre>$query</pre>\n";
      $query_result = issue_query($query);
    }
  }
?>