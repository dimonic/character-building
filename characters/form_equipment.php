  <table>
    <tr><th>Mundane equipment</th><th>Description</th><th>Location</th><th>Price</th><th>Weight</th></tr>
<?php
    $equip_query = "SELECT * FROM `character_equipments` WHERE `character_id` = '$_POST[character_id]' ORDER BY `location`, `character_equipment_id`";
    $equip_query_result = issue_query($equip_query);
    $c = 1;
    while ($equip_row = $equip_query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
      if (DB::isError($equip_row)) {
	die($equip_row->getMessage());
      }
      echo "<tr><td>";
      form_input_text('character_equipments', 'name', $equip_row[name], "", "equip_name_$c");
      echo "</td>\n<td>";
      form_input_text('character_equipments', 'description', $equip_row[description], "", "equip_desc_$c");
      echo "</td>\n<td>";
      form_input_text('character_equipments', 'location', $equip_row[location], "", "equip_loc_$c");
      echo "</td>\n<td>";
      form_input_number('character_equipments', 'price', $equip_row[price], 6, "", "equip_price_$c");
      echo "</td>\n<td>";
      form_input_number('character_equipments', 'weight', $equip_row[weight], 6, "", "equip_wt_$c");
      echo "</td></tr>\n";
      $c++;
    }
    for ($d = $c; $d < max(20, $c + 5); $d++) {
      echo "<tr><td>";
      form_input_text('character_equipments', 'name', $equip_row[name], "", "equip_name_$d");
      echo "</td>\n<td>";
      form_input_text('character_equipments', 'description', $equip_row[description], "", "equip_desc_$d");
      echo "</td>\n<td>";
      form_input_text('character_equipments', 'location', $equip_row[location], "", "equip_loc_$d");
      echo "</td>\n<td>";
      form_input_number('character_equipments', 'price', $equip_row[price], 6, "", "equip_price_$d");
      echo "</td>\n<td>";
      form_input_number('character_equipments', 'weight', $equip_row[weight], 6, "", "equip_wt_$d");
      echo "</td></tr>\n";
    }
?>	
  </table>
