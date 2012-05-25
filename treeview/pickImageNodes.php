// You can find instructions for this file here:
// http://www.treeview.net

// Decide if the names are links or just the icons
ICONPATH = '' //change if the gif's folder is a subfolder, for example: 'images/'
USETEXTLINKS = 1
STARTALLOPEN = 0
USEFRAMES = 0
USEICONS = 1
WRAPTEXT = 1
PRESERVESTATE = 1


foldersTree = gFld("<b>Pick a <?= $_GET[ff] ?></b>", "pickImageFrameset.php?<?= $_SERVER[QUERY_STRING] ?>");
aux1 = insFld(foldersTree, gFld('<?= $_GET[ff] ?>', 'javascript:undefined'));

<?php

function traverse_folders($start_path, $parent)
{
  $handle = opendir($start_path);
  $num = 0;
  while($file[$num] = readdir($handle)) {
    $num++;
  }
  sort($file);
  for ($c = 1; $file[$c]; $c++) {
    switch(filetype("$start_path/$file[$c]")) {
    case 'dir':
      if ($file[$c] == '.' || $file[$c] == '..') {
	continue;
      }
      $new = $parent + 1;
      echo "aux$new = insFld(aux$parent, gFld('$file[$c]', 'pickImageFrameset.php?fld=$start_path/$file[$c]&ff=$_GET[ff]&topdir=$_GET[topdir]'));\n";
      traverse_folders("$start_path/$file[$c]", $new);
      break;
    default:
      break;
    }
  }
  closedir($handle);
}

$start_path = $_GET[topdir];

traverse_folders($start_path, 1);
?>
