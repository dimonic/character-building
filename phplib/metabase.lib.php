<?php
  function db_connect($db_name) {
    global $db;

    $host = "localhost";
    $user = "gcoa";
    $password = "gcoa";
    $db = DB::connect("mysql://$user:$password@$host/$db_name");
    if (DB::iserror($db)) {
      die($db->getMessage());
    }
    return $db;
  }

  // returns new sequence number from sequence table
  function new_sequence($name) {
    $sql_query = "SELECT * FROM `sequences` WHERE name = '$name'";
    $query_result = issue_query($sql_query);
    $row = $query_result->fetchRow(DB_FETCHMODE_ASSOC);
    if (DB::iserror($query_result)) {
      die($query_result->getMessage());
    }
    $old_num = $row[number];

    $new_num = $old_num + 1;
    // put new (current) number back into "numbers"
    $sql_query = "UPDATE sequences SET number = $new_num WHERE name = '$name' LIMIT 1";
    issue_query($sql_query);
    return $new_num;
  }


  /* create_edit_template
     reads a table and constructs a quick editing template
  */
  function create_edit_template($table_name, $edit_name, $edit_id) {
    global $db;

    // get info about the table
    $query = "SELECT * FROM `$table_name`";
    $result = issue_query($query);
    $info = $result->tableInfo();
    $sequence = 1;
    
    $insert_preface = "INSERT INTO $edit_name (edit_id, sequence, new_row, cols, rows, len, type, value) VALUES(";
    foreach ($info as $field) {
      $insertion = $insert_preface . "'$edit_id', '$sequence', 'Yes', 1, 1, '$field[len]', 'label', '$field[name]')";
      issue_query($insertion);
      $sequence++;
      $insertion = $insert_preface . "'$edit_id', '$sequence', 'No', 1, 1, '$field[len]', '$field[type]', '$field[name]')";
      issue_query($insertion);
      $sequence++;
    }
  }

  /* edit_table
     edits a table or view using a template
     requires row_id to be in the form "{$table}_id" such as "creature_id" 
     for the table 'creature".
     $new_page is the page to which the user will be dispatched after editing
     the table.
  */
  function edit_table($table, $row_id, $template, $edit_id, $new_page) {

    // fetch the data
    $query = "SELECT * FROM `$table` WHERE {$table}_id = '$row_id'";
    $data = issue_query($query);
    $data_row = $data->fetchRow(DB_FETCHMODE_ASSOC);
    if (DB::isError($data_row)) {
      die ($data_row->getMessage());
    }
?>

<script language=JavaScript type="text/javascript">
   function editJoin(table, join_id, id) 
   {
     alert('Join_id = ' + join_id + ', obj_id = ' + id);
     window.open('edit_join.php?table=' + table + '&join_id=' + join_id + '&obj_id=' + id);
   }
</script>

<?php 

    // create form
    echo "<form method=\"post\" action=\"handle_update.php\">\n";

    sub_table_edit($table, $data_row, $template, $edit_id);

    // create hidden buttons for table and field identification
    echo "<input type=\"hidden\" name=\"table\" value=\"$table\">\n";
    $id_name = "{$table}_id";
    echo "<input type=\"hidden\" name=\"record_id\" value=\"$data_row[$id_name]\">\n";
    echo "<input type=\"hidden\" name=\"new_page\" value=\"$new_page\">\n";

    // create standard submit/reset/cancel buttons
    echo "<table>\n";
    echo "<tr><td><input type=\"submit\" name=\"submit\" value=\"Submit\"></td>";
    echo "<td><input type=\"reset\"></td>";
    echo "<td><input type=\"submit\" name=\"cancel\" value=\"Cancel\"></td></tr>\n";
    echo "</table>\n";
    echo "</form>\n";
  }

  /* submit update
     obtains name of table from post variable $post[table], 
     id of record from $post[table_id],
     $new_page is the page to go after handling the update.
  */
  function submit_update($post){
    global $db;

    // get info about table
    $table = $post[table];
    $new_page = $post[new_page];
    $query = "SELECT * FROM `$table`";
    $result = issue_query($query);
    $info = $result->tableInfo(DB_TABLEINFO_ORDER);

    echo "<html>\n";
    echo "<head>\n";
    echo "<title>Updating $post[table]</title>\n";
    echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"table.css\" title=\"home-style\">\n";
    echo "<script language=JavaScript type=\"text/javascript\">\n";
    echo "  function redirect_page(new_page) {\n";
    echo "    location.replace(new_page);\n";
    echo "  }\n";
    echo "</script>\n";
    echo "</head>\n";
    echo "<body onLoad=\"redirect_page('$new_page');\">\n";
    echo "<body>\n";
    if ($post[cancel] != "Cancel") {
      $update_cmd = "UPDATE `$table` SET ";
      $keys = array_keys($post);
      foreach ($keys as $key) {
        if ($key != table && $key != table_id && $key != 'submit' && $key != 'record_id' && $key != 'new_page') {
	  $field_num = $info["order"][$key];
	  switch($info[$field_num][type]) {
	    case 'string':
              $update_cmd .= "`$key` = '$post[$key]', ";
	      break;
	    default :
	      if (empty($post[$key])) {
                $post[$key] = 0;
              }
	      $update_cmd .= "`$key` = $post[$key], ";
	  }
	}
      }
      $update_cmd = substr($update_cmd, 0, strlen($update_cmd) - 2) . " WHERE {$table}_id = '$post[record_id]'";
      echo "<pre>$update_cmd</pre>\n";
      issue_query($update_cmd);
    }
    echo "</body>\n";
    echo "</html>\n";
  }

  // this function is called recusively, to render tables nested within tables.
  function sub_table_edit($table, $data_row, $template, $edit_id) {
    // fetch the edit-template
    $edit_query = "SELECT * FROM `$template` WHERE edit_id = '$edit_id' ORDER BY sequence";
    $edit_result = issue_query($edit_query);

    echo "\n<table border=\"1\" cellspacing=\"0\">\n<tr>\n";

    $id = $table . '_id';

    while ($edit_row = $edit_result->fetchRow(DB_FETCHMODE_ASSOC)) {
      if ($edit_row[new_row] == 'Yes') {
        echo "</tr>\n<tr>\n";
      }
      $value = $edit_row[value];
      switch ($edit_row[type]) {
        case 'table' :
	  echo "  <td colspan=\"$edit_row[cols]\" rowspan=\"$edit_row[rows]\">";
	  sub_table_edit($table, $data_row, $template, $value);
	  echo "  </td>";
	  break;
        case 'label':
          echo "  <th colspan=\"$edit_row[cols]\" rowspan=\"$edit_row[rows]\">$value</th>\n";
	  break;
	case 'join':
	  echo "  <td colspan=\"$edit_row[cols]\" rowspan=\"$edit_row[rows]\"><input type=button value=\"Edit attacks\" onClick=\"editJoin('$table', '$value', '$data_row[$id]');\"></td>\n";
	  break;
	case 'enum' :
	  $enum_query = "SHOW COLUMNS FROM $table LIKE '$value'";
	  // echo "<td><pre>$enum_query</pre></td>\n";
	  $enum_result = issue_query($enum_query);
	  $enum_row = $enum_result->fetchRow(DB_FETCHMODE_ASSOC);
	  // echo "<td><pre>$enum_row[Type]</pre></td>\n";
	  preg_match_all("{'([^',]*)'}", $enum_row['Type'], $enum_array);
	  echo "<td colspan=\"$edit_row[cols]\" rowspan=\"$edit_row[rows]\"><select name=\"$value\">";
	  foreach ($enum_array[1] as $option) {
	    if ($data_row[$value] == $option) {
	      echo "<option selected>$option</option>\n";
	    } else {	    
	      echo "<option>$option</option>\n";
	    }
	  }
	  echo "</select></td>\n";
	  break;
        default :
        // later to put code here for validation of specific data types (use switch)
	  $size = min($edit_row[len], 40);
          echo "  <td colspan=\"$edit_row[cols]\" rowspan=\"$edit_row[rows]\"><input type=\"text\" size=\"$size\" maxlen=\"$edit_row[len]\" value=\"$data_row[$value]\" name=\"$value\"></td>\n";
	  break;
      } // endswitch
    }
    echo "</tr>\n</table>\n";
  }
  

  /* view_table
     prepare query gets column information from a "view" table, 
     join information from a "join" table
     and creates a data query based on the two tables.
     Outputs a <tr> with the column lables as described in the view table,
     Then performs a query on the data, and outputs the contents of the table
  */
  function view_table($view_name, $view_id, $join_name, $join_id, $order_by, $where_clause, $double_click_func = '', $nrows = 0, $start_row = 0) 
  {
    global $post;

    // javascript to hilight clicked row, un-hilight previous row
    echo <<< END_OF_SCRIPT
<script language="JavaScript" type="text/javascript">
  var last_selected;

  function hilightRow(which, row_id) 
  {
  
    if (document.getElementById) { // DOM feature supported
       if (last_selected == undefined) {
         last_selected = document.getElementById(document.view.record_id.value);
       }
       last_selected.className = "Data";
       last_selected = which;
       which.className = "DataSelected";
       document.view.record_id.value = row_id;
    }
  }

  function keyPress(event)
  {
    switch (event.which) {
      case 55: // home
        dispatch('top');
	break;
      case 57: // pageup
        dispatch('pageup');
	break;
      case 51: // pagedown
        dispatch('pagedown');
	break;
      case 49: // end
        dispatch('bottom');
	break;
      default:
        if (last_selected == undefined) {
          last_selected = document.getElementById(document.view.record_id.value);
        }
        parent = last_selected.parentNode;
        c = 1;  // iterate through child elements (<tr>s)
        while (child = parent.childNodes[c]) {
          if (child == last_selected) {
            switch(event.which) {
	      case 56:	// key up
	        if(c - 2 >= 0) {
                  newChild = parent.childNodes[c - 2];
	        } else {
		  dispatch('scrollup');
		  return;
		}
                break;
	      case 50:	// key down
	        if (parent.childNodes[c + 2]) {
                  newChild = parent.childNodes[c + 2];
                } else {
		  dispatch('scrolldown');
		  return;
		}
	        break;
	      default:
	        return;
	        break;
            } // end switch
            break;
          } // end if
	  c += 2;
        } // end while
        if (newChild != undefined) {
          last_selected.className = 'Data';
	  last_selected = newChild;
          newChild.className = 'DataSelected';
          document.view.record_id.value = newChild.id;        
        } // endif
	break;
    } //end switch
  }
</script>

END_OF_SCRIPT;
  
    /* Read "view" table, and print table-headings as <th>s in a <tr> */
    $view_query = "SELECT * FROM `$view_name` WHERE view_id = '$view_id'";
    $view_result = issue_query($view_query);
    $label_row = "";
    $having_clause = "";
    while ($view_row = $view_result->fetchRow(DB_FETCHMODE_ASSOC)) {
      if (DB::isError($view_row)) {
        die ($view_row->getMessage());
      }
      /* replace non-word-identifier characters with underscore for alias names */
      $alias = preg_replace('/\W+/', '_', $view_row[value]);
      $search_value = $post[$alias];
      $label_row .= "<th>$view_row[label]<br><input class=\"small\" type=text size=\"" . strlen($view_row[label])*2 . "\" name=\"$alias\" value=\"$search_value\" onChange=\"dispatch('research');\"></th>\n";
      $label_row_foot .= "<th>$view_row[label]</th>\n";
      if (!empty($search_value)) { // then we have to search on it
        if (empty($having_clause)) {
          $having_clause = "HAVING ";
          $had_having = true;
        } else {
          $having_clause .= " AND ";
        }
	$search_term = substr($search_value, 1);
        switch(substr($search_value, 0, 1)) {
          case "=":
	    $having_clause .= "$alias = $search_term";
	    break;
	  case ">":
	    $having_clause .= "$alias > $search_term";
	    break;
	  case "<":
	    $having_clause .= "$alias < $search_term";
	    break;
	  case '\\':
	    $search_term = substr($search_term, 1);
	    $having_clause .= "LEFT($alias, LENGTH('$search_term')) = '$search_term'";
	    break;
	  default:
            $having_clause .= "INSTR(LCASE($alias), LCASE('$search_value'))";
	    break;
	}
      }
      $col_type[$alias] = $view_row[type];
      $tables .= $view_row[value] . ' AS ' . $alias . ', ';
    }
    // echo "<pre>$having_clause</pre>\n";
    echo "<thead>\n";
    echo "<tr>$label_row</tr>\n";
    echo "</thead>\n";
    echo "<tfoot>\n";
    echo "<tr>$label_row_foot</tr>\n";
    echo "</tfoot>\n";
    /* start building the query, with SELECT from tables */
    $select_from = 'SELECT ' . $tables;
    /* query the join table for join information */
    if (empty($join_name)) {
      $select_from .= " FROM ";
    } else {
      $join_query = "SELECT * FROM `$join_name` WHERE join_id = '$join_id'";
      $join_result = issue_query($join_query);
      $join_row = $join_result->fetchRow(DB_FETCHMODE_ASSOC);
      if(DB::IsError($join_row)) {
        die($join_row->getMessage());
      }
      // add in main table record_id
      $main_table = $join_row[from_table];
      $data_query = $main_table . '.' . $main_table . '_id FROM `' . $join_row[from_table] . '`';

      /* create all the joins */
      do {
        if(DB::IsError($join_row)) {
          die($join_row->getMessage());
        }
        /* check for grouping */
        if ($join_row[group_on] == 'Yes') {
          $grouping .= "$join_row[from_table].$join_row[from_field], ";
        }
        $data_query .= ' ' . $join_row[join_type] . ' JOIN ' . $join_row[to_table] . ' ON ' . $join_row[from_table] . '.' . $join_row[from_field] . ' = ' . $join_row[to_table] . '.' . $join_row[to_field];
      } while ($join_row = $join_result->fetchRow(DB_FETCHMODE_ASSOC));
    }
    $data_query = $select_from . $data_query;
    if (strlen($grouping) > 0) {
      $data_query .= " GROUP BY " . substr($grouping, 0, strlen($grouping) - 2);
    }
    $data_query .= " $having_clause";
    if (!empty($where_clause)) {
      $data_query .= " WHERE $where_clause";
    }
    $data_query .= " ORDER BY $order_by";
    if (empty($start_row)) {
      $start_row = 0;
    }
    if ($nrows != 0 && $start_row != -1) {
      $data_query .= " LIMIT $start_row, $nrows";
    }
    echo "<pre>$data_query</pre>\n";
    /* now perform data query */
    echo "<tbody>\n";
    $data_result = issue_query($data_query);
    $actual_nrows = $data_result->numRows();
    if ($start_row == -1) {
      $start_row = $actual_nrows - $nrows;
      if ($start_row < $nrows) {
	$start_row = 0;
      }
      $data_query .= " LIMIT $start_row, $nrows";
      echo "<pre>$data_query</pre>\n";
      $data_result = issue_query($data_query);
    }
    $first_row = true;
    while ($data_row = $data_result->fetchRow(DB_FETCHMODE_ASSOC)) {
      if (DB::isError($data_row)) {
        die ($data_row->getMessage());
      }
      // print the table-row
      $record_id = $main_table . '_id';
      if ($first_row) {
	echo "<input type=hidden name=record_id value='$data_row[$record_id]'>\n";
        echo "<tr class=\"DataSelected\" id=\"$data_row[$record_id]\" onClick=\"hilightRow(this, '$data_row[$record_id]')\" onDblClick=\"$double_click_func\">";
	$first_row = false;
      } else {
        echo "<tr class=\"Data\" id=\"$data_row[$record_id]\" onClick=\"hilightRow(this, '$data_row[$record_id]')\" onDblClick=\"$double_click_func\">";
      }
      $keys = array_keys($data_row);
      foreach ($keys as $key) {
        if ($key != $record_id) {
          echo "<td>";
          if ($col_type[$key] == 'image') {
	    echo "<img src=\"", $data_row[$key], "\" alt=\"Image\">";
	  } else {
	    echo $data_row[$key];
	  }
	  echo "</td>";
	}
      }
      echo "</tr>\n";
    }
    echo "</tbody>\n";
    echo "</table>\n";
    echo "<input type=hidden name=actual_start_row value=\"$start_row\">\n";
    echo "<input type=hidden name=actual_nrows value=\"$actual_nrows\">\n";
    return $data_query;
  }

  function issue_query ($query_string) {
    global $db;

    // echo "<pre>$query_string\n</pre>";
    $query_result = $db->query($query_string);
    if (DB::iserror($query_result)) {
      echo "<pre>$query_string</pre>\n";
      die($query_result->getMessage());
    }
    return $query_result;
  }
?>
