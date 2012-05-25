<html>
<head>
<link rel="stylesheet" type=text/css href="../styles/table.css" title="php-style">

</head>
<body>
<?php
   $file = array();

   $picture = $_GET['pic'];
   if ($picture != '') {
     echo "<img src='$picture'/>\n";
   }
   $folder = $_GET['fld'];
   if ($folder != '') {
     echo "<h2>$folder</h2>\n";
     $col = 0;
     $width = 5;
     echo "<p>Click on an image to select.</p>\n";
     echo "<form name='image' action='../characters/edit-1.php' method='get'>\n<table>\n<tr>";
     $handle = opendir("$folder");
     $num = 0;
     while($file[$num] = readdir($handle)) {
       $num++;
     }
     sort($file);
     // first value is empty (becuase of final readdir returns false), so we skip '0'
     for ($c = 1; $file[$c]; $c++) {
       if(filetype("$folder/$file[$c]") == 'file') {
         if (preg_match('/.gif$/', "$file[$c]")) { // using gifs as thumbnails
	   $base = basename($file[$c], '.gif');
	   echo "<td><button type='submit' name='portrait' title='$base' value='$folder/$base.jpg' onClick='parent.opener.document.$_GET[ff].src=this.value; parent.opener.document.query.$_GET[ff].value=this.value; parent.window.close();'><img src='$folder/$file[$c]' alt='$base'/><br/>$base</button></td>\n";
	   if (++$col >= $width) {
	     $col = 0;
	     echo "</tr>\n<tr>";
	   }
	 }
       }
     }
     echo "</tr>\n</table>\n</form>";
   }
?>
  

</body>
</html>



