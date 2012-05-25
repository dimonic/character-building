<?php

    function get_sources($cookieval)
    {
      global $source;
      if (empty($cookieval)) {
        $cookieval = $_COOKIE[sourcebooks];
      }

      if (strpos($cookieval, "ph:true") !== false){
	$source[$c++] = "SRD";
	$source[$c++]= "PH";
      }
      if (strpos($cookieval, "dmg:true") !== false){
	$source[$c++] = "DMG";
      }
      if (strpos($cookieval, "mm:true") !== false){
	$source[$c++] = "MM";
      }
      if (strpos($cookieval, "dd:true") !== false){
	$source[$c++] = "DD";
      }
      if (strpos($cookieval, "df:true") !== false){
	$source[$c++] = "DF";
      }
      if (strpos($cookieval, "sas:true") !== false){
	$source[$c++] = "SaS";
      }
      if (strpos($cookieval, "mw:true") !== false){
	$source[$c++] = "MW";
      }
      if (strpos($cookieval, "tb:true") !== false){
	$source[$c++] = "TB";
      }
      if (strpos($cookieval, "rs:true") !== false){
	$source[$c++] = "RS";
      }
      if (strpos($cookieval, "rd:true") !== false){
	$source[$c++] = "RD";
      }
      if (strpos($cookieval, "rw:true") !== false){
	$source[$c++] = "RW";
      }
      if (strpos($cookieval, "cw:true") !== false){
	$source[$c++] = "CW";
      }
      if (strpos($cookieval, "cd:true") !== false){
	$source[$c++] = "CD";
      }
      if (strpos($cookieval, "car:true") !== false){
	$source[$c++] = "CAr";
      }
      if (strpos($cookieval, "cad:true") !== false){
	$source[$c++] = "CAd";
      }
      if (strpos($cookieval, "pg:true") !== false){
	$source[$c++] = "PG";
      }
      if (strpos($cookieval, "frcs:true") !== false){
	$source[$c++] = "FRCS";
      }
      if (strpos($cookieval, "mag:true") !== false){
	$source[$c++] = "Mag";
      }
      if (strpos($cookieval, "rac:true") !== false){
	$source[$c++] = "Rac";
      }
      if (strpos($cookieval, "und:true") !== false){
	$source[$c++] = "Und";
      }
      if (strpos($cookieval, "fp:true") !== false){
	$source[$c++] = "FP";
      }
      if (strpos($cookieval, "house:true") !== false){
	$source[$c++] = "HOUSE";
      }
      if (strpos($cookieval, "ua:true") !== false){
	$source[$c++] = "UA";
      }
      if (strpos($cookieval, "spc:true") !== false){
	$source[$c++] = "SpC";
      }
      if (strpos($cookieval, "be:true") !== false){
	$source[$c++] = "BE";
      }
      if (strpos($cookieval, "bv:true") !== false){
	$source[$c++] = "BV";
      }
      if (strpos($cookieval, "lg:true") !== false){
	$source[$c++] = "LG";
      }
      if (strpos($cookieval, "drm:true") !== false){
	$source[$c++] = "DrM";
      }
      if (strpos($cookieval, "ecs:true") !== false){
	$source[$c++] = "ECS";
      }
      if (empty($source[$c])) {
        $source[$c++] = "PH";
	$source[$c++] = "SRD";
      }
      // build source query string
      $first = 1;
      foreach($source as $source_item) {
	if ($first) {
	  $first = 0;
	  $source_select = " (INSTR(source, '$source_item')";
	} else {
	  $source_select .= " OR INSTR(source, '$source_item')";
	}
      }
      if (!empty($source_select)) {
        $source_select .=  ")";
      } else {
        $source_select = '1';
      }
      return $source_select;
    }

  function check_login()
  {

    $auth_ok = false;
    $login_a = array();
    $passwd_a = array();
    $md5_a = array();
    global $user_info;
    global $HTTP_SERVER_VARS;

    $login = $_SERVER['PHP_AUTH_USER'];
    $passwd = $_SERVER['PHP_AUTH_PW'];

    if (empty($login) || empty($passwd)) {
      // we can try their cookie if not already logged in
      $preferences = $_COOKIE[preferences];
      ereg('login:([^&]*)', $preferences, $login_a);
      ereg('passwd:([^&]*)', $preferences, $passwd_a);
      ereg('md5:([^&]*)', $preferences, $md5_a);
      $login = $login_a[1];
      $passwd = $passwd_a[1];
      $md5 = $md5_a[1];
    }
    // now we check the user table
    if (isset($login) && isset($passwd)) {
      require_once('../phplib/connect.inc.php');
      $query = "SELECT * FROM users WHERE username = '$login' AND passwd = MD5('$passwd')";
      $query_result = issue_query($query);
      if ($user_info = $query_result->fetchRow(DB_FETCHMODE_ASSOC)) {
        $auth_ok = true;
      }
    }
    return $auth_ok;
  }

function bonus_total($bonus_array) {

  $bonus = 0;
  if (is_array($bonus_array)) {
    foreach($bonus_array as $type => $value) {
      $bonus += $value;
    }
  }
  return $bonus;
}

function parse_query_string($url, $qmark=true)
{
   if ($qmark) {
       $pos = strpos($url, "?");
       if ($pos !== false) {
           $url = substr($url, $pos + 1);
       }
   }
   if (empty($url))
       return false;
   $tokens = explode("&", $url);
   $urlVars = array();
   foreach ($tokens as $token) {
       $value = string_pair($token, "=", "");
       if (preg_match('/^([^\[]*)(\[.*\])$/', $token, $matches)) {
           parse_query_string_array($urlVars, $matches[1], $matches[2], $value);
       } else {
           $urlVars[rawurldecode($token)] = rawurldecode($value);
       }
   }
   return $urlVars;
}

/**
 * Utility function for parse_query_string. Given a result array, a starting key, and a set of keys formatted like "[a][b][c]"
 * and the final value, updates the result array with the correct PHP array keys.
 *
 * @return void
 * @param array $result A result array to populate from the query string
 * @param string $k The starting key to populate in $result
 * @param string $arrayKeys The key list to parse in the form "[][a][what%20ever]"
 * @param string $value The value to place at the destination array key
*/
function parse_query_string_array(&$result, $k, $arrayKeys, $value)
{
   if (!preg_match_all('/\[([^\]]*)\]/', $arrayKeys, $matches))
       return $value;
   if (!isset($result[$k])) {
       $result[rawurldecode($k)] = array();
   }
   $temp =& $result[$k];
   $last = rawurldecode(array_pop($matches[1]));
   foreach ($matches[1] as $k) {
       $k = rawurldecode($k);
       if ($k === "") {
           $temp[] = array();
           $temp =& $temp[count($temp)-1];
       } else if (!isset($temp[$k])) {
           $temp[$k] = array();
           $temp =& $temp[$k];
       }
   }
   if ($last === "") {
       $temp[] = $value;
   } else {
       $temp[rawurldecode($last)] = $value;
   }
}

function string_pair(&$a, $delim='.', $default=false)
{
   $n = strpos($a, $delim);
   if ($n === false)
       return $default;
   $result = substr($a, $n+strlen($delim));
   $a = substr($a, 0, $n);
   return $result;
}

function get_field_info($table, $field_name)
{
  $query = "SHOW COLUMNS FROM `$table` LIKE '$field_name'";
  // echo "<td><pre>$query</pre></td>\n";
  $query_result = issue_query($query);
  $field_info = $query_result->fetchRow(DB_FETCHMODE_ASSOC);
  return $field_info;
}

// create an html form select for that field.
function form_select_enum($table, $field_name, $cur_value, $update_func = '', $form_name = '')
{
  if ($form_name == '') {
    $form_name = $field_name;
  }
  $enum_row = get_field_info($table, $field_name);
  // echo "<td><pre>$enum_row[Type]</pre></td>\n";
  preg_match_all("{'([^',]*)'}", $enum_row['Type'], $enum_array);
  if ($enum_row["Null"]) {
    array_splice($enum_array[1], 0, 0, '');
  }
  echo "<select name=\"$form_name\">\n";
  foreach ($enum_array[1] as $option) {
    if ($cur_value == $option) {
      echo "<option selected>$option</option>\n";
    } else {	    
      echo "<option>$option</option>\n";
    }
  }
  echo "</select>\n";
}

function form_radio_group($table, $field_name, $cur_value)
{
  $enum_row = get_field_info($table, $field_name);
  preg_match_all("{'([^',]*)'}", $enum_row['Type'], $enum_array);
  foreach ($enum_array[1] as $option) {
    if ($cur_value == $option) {
      echo "<input type='radio' name='$field_name' checked value='$option'/>$option<br/>\n";
    } else {	    
      echo "<input type='radio' name='$field_name' value='$option'/>$option<br/>\n";
    }
  }
}

function form_get_bool($table, $field_name, $cur_value)
{
  if ($cur_value) {
    echo "<input type='checkbox' name = '$field_name' checked/>\n";
  } else {
    echo "<input type='checkbox' name = '$field_name'/>\n";
  }
}

function form_input_text($table, $field_name, $cur_value, $size = 0, $form_field_name = "")
{
  if ($form_field_name == "") {
    $form_field_name = $field_name;
  }
  $field_info = get_field_info($table, $field_name);
  preg_match("{\(([0-9]+)\)}", $field_info["Type"], $maxlength);
  if ($size == 0) {
    $size = min($maxlength[1], 20);
  }
  echo "<input type='text' name='$form_field_name' value=\"$cur_value\" maxlength='$maxlength[1]' size='$size'/>\n";
}

function form_input_readonly($table, $field_name, $cur_value, $size = 0)
{
  $field_info = get_field_info($table, $field_name);
  preg_match("{\(([0-9]+)\)}", $field_info["Type"], $maxlength);
  if ($size == 0) {
    $size = min($maxlength[1], 20);
  }
  echo "<input type='text' readonly name='$field_name' value='$cur_value' maxlength='$maxlength[1]' size='$size'/>\n";
}

function form_input_hidden($table, $field_name, $cur_value)
{
  $field_info = get_field_info($table, $field_name);
  echo "<input type='hidden' name='$field_name' value='$cur_value'/>\n";
}

function form_input_number($table, $field_name, $cur_value, $size = 0, $update_func = '', $form_field_name = "")
{
  if ($form_field_name == "") {
    $form_field_name = "$field_name";
  }
  $field_info = get_field_info($table, $field_name);
  preg_match("{([^(]+)\(([0-9]+)\,?([0-9]*)\)}", $field_info["Type"], $type);
  switch ($type[1]) {
  case 'tinyint':
  case 'smallint':
  case 'int':
  case 'decimal':
    $maxlength = strlen(pow(2, $type[2] * 8 - 1));
    if ($size == 0) {
      $size = $maxlength;
    }
    echo "<input align='right' type='text' name='$form_field_name' value='$cur_value' maxlength='$maxlength' size='$size' onChange='$update_func'/>";
    break;
  default:
    echo "<pre>$type[0], $type[1], $type[2], $type[3]</pre>\n";
  }
}

function blank_zero($value)
{
  if ($value == 0) {
    return '';
  } else {
    return $value;
  }
}

function att_bonus($att)
{

  global $character;
  global $bonus_by_name;

  if ($att == 'int')
    $att = 'intel';
  $item_bonus = bonus_total($bonus_by_name[substr(strtoupper($att), 0, 1) . substr($att, 1, 2)]);
  $bonus = max(floor(($character["enh_{$att}"] - 10) / 2), floor(($character["$att"] + $item_bonus - 10) / 2));

  return $bonus;
}

?>
