<?php
  // makes yy/mm/dd format string from mysql datetime format.
  function datetime2date($datetime) {
    if (strlen($datetime) == 0) {
      return "00/00/00";
    }
    return substr($datetime,2,2) . "/" . substr($datetime,4,2) . "/" . substr($datetime,6,2);
  }

  // build_datetime creates a mysql datetime value from a yy/mm/dd and optional hh:mm
  function build_datetime($date, $time = '00:00') {
    if ($date == '00/00/00') {
      return "00000000000000";
    } else {
      return '20' . substr($date, 0, 2) . substr($date, 3, 2) . substr($date, 6, 2) . substr($time, 0, 2) . substr($time, 3, 2) . '00';
    }
  }

  function datetime2time($datetime) {
    if (strlen($datetime) == 0) {
      return "00:00";
    }
    return substr($datetime, 8, 2) . ":" . substr($datetime, 10,2);
  }

  function reparagraph($string) {
    return str_replace("\n", "<p>", $string);
  }

  function issue_query ($query_string) {
    global $db;

    $query_result = $db->query($query_string);
    if (DB::iserror($query_result)) {
      echo "<pre>$query_string</pre>\n";
      die($query_result->getMessage());
    }
    return $query_result;
  }

  function new_sequence($name) {
    $sql_query = "SELECT $name FROM sequences WHERE 1 LIMIT 1";
    $query_result = issue_query($sql_query);
    $row = $query_result->fetchRow(DB_FETCHMODE_ASSOC);
    if (DB::iserror($query_result)) {
      die($query_result->getMessage());
    }
    $old_num = $row[$name];

    $new_num = $old_num + 1;
    // put new (current) number back into "numbers"
    $sql_query = "UPDATE numbers SET $name = $new_num WHERE $name = $old_num LIMIT 1";
    issue_query($sql_query);
    return $new_num;
  }

  function get_selects($customer_num, $field_name) {
    global $db;

    $result = $db->getAll("SELECT value FROM categories WHERE cust_num = '$customer_num' AND fname = '$field_name'");
    if (DB::isError($query_result)) {
      die($query_result->getMessage());
    }
    return $result;    
  }

  function show_selects($customer_num, $field_name, $value, $heading) {
    $selects = get_selects($customer_num, $field_name);
    echo '<tr><th class="Edit">',$heading,'</th><td><select name="',$field_name,'">', "\n";
    echo "\t", '<option selected>',$value,'</option>', "\n";
    foreach ($selects as $selection) {
      if ($selection[0] != $value) {
        echo "\t<option>$selection[0]</option>\n";
      }
    }
    echo "</select></td></tr>\n";
  }

  // accepts an array of arrays of checkbox definitions with the sql "SELECT" portion
  function build_filter($checkbox_sets, $posted_vars) {
    foreach (array_keys($checkbox_sets) as $checkbox_set) {
      if (! empty($posted_vars[$checkbox_set])) {
        $sql_filter .= " AND (";
	$first = 1;
        foreach (array_keys($checkbox_sets[$checkbox_set]) as $checkbox) {
          if (in_array($checkbox, $posted_vars[$checkbox_set])) {
	    if ($first == 0) {
	      $sql_filter .= " OR ";
            }
            $first = 0;
	    $sql_filter .= "(" . $checkbox_sets[$checkbox_set][$checkbox] . ")";
	  } 
        }
        $sql_filter .= ")";
      }
    }
    return $sql_filter;
  }

  function show_checkbox_sets($checkbox_sets, $posted_vars) {
    foreach (array_keys($checkbox_sets) as $checkbox_set) {
      echo "  <td>\n";
      foreach (array_keys($checkbox_sets[$checkbox_set]) as $checkbox) {
        echo "  <input type=checkbox name=${checkbox_set}[] value=\"", $checkbox, (in_array($checkbox, $posted_vars[$checkbox_set])) ? "\" checked" : "\"", ">",$checkbox,"</input><br>\n";
      }
      echo "  </td>\n";
    }
  }
?>