<?php

require_once('DB.php');
require_once('../phplib/lib.inc.php');
require_once('../phplib/dnd.lib.php');
require_once('../phplib/connect.inc.php');

echo "<html><body>\n";

$file = "feats-clean.html";
if (! ($FEATS = fopen($file, "r"))) {
  die("Could not open file: $file\n");
}

$max_length = 1024;
while ($line = fgets($FEATS, $max_length)) {
    $part = array();
    ereg("<.*>(.*)</(.*)>", $line, $part);
    $level = $part[2];
    $label = $part[1];
    switch ($level) {
	case 'h3':
	    // new feat, time to dump accumulated info and clear
	    $feat[Prerequisites] = $feat[Prerequisite];
	    $fighter =  (stristr($feat[Special], 'fighter')) ? 'Yes' : 'No';
	    $query = "INSERT INTO `feat` (`name`, `type`, `Fighter`, `prerequisites`, `benefit`, `normal`, `special`, `source`) VALUES ('$feat[name]', '$feat[type]', '$fighter', '$feat[Prerequisites]', '$feat[Benefit]', '$feat[Normal]', '$feat[Special]', 'PHB')";
	    issue_query($query);
	    $feat = array();
	    $accumulate = "";
	    ereg("(.*)\[(.*)\]", $label, $part);
	    $feat[name] = trim($part[1]);
	    $feat[type] = trim($part[2]);
            break;
	case 'h5':
	    $accumulate = trim($label);
	    break;
        default:
	    $feat[$accumulate] .= addslashes(trim(strip_tags($line, "<b><i>")));
	    break;
    }
}

fclose($FEATS);

echo "</body></html>\n";

?>
