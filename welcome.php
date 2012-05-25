<html>
<head>
<title>Welcome to the Gentlemen Company of Adventurers</title>
<link rel="stylesheet" type=text/css href="styles/table.css" title="php-style">
</head>
<body>
<h1>Welcome</h1>

<p>We are a small bunch of gamers located in the Great White North
(actually south of many US cities) in the Toronto area, in
Canada.</p>

<p>This web-site is a resource to manage our games and assist us in
whatever ways possible in running games smoothly.</p>

<p>This site is undergoing near constant enhancement, so things may
break, change, or even improve over time. Visit often!</P>

<h2>News</h2>
<p>In spite of the Internet Explorer V5-6 deficiency in complying with
the HTML spec in that neither the &lt;button&gt; or the &lt;input
type=image&gt; elements send their value attributes to the server
properly when clicked, I have devised a succesful workaround.</p>

<p>Breaking our 'tradition' of not testing for Internet Explorer, we
have done some preliminary tests, and fixed some incompatibilities,
although we continue to strongly recommend the more secure and
standards compliant <a
href="http://www.mozilla.org/projects/seamonkey/">SeaMonkey</a> or <a
href="http://www.mozilla.org/projects/firefox/">Firefox</a> browsers
from the Mozilla project, or the fast and flexible <a
href="http://www.opera.com"/>Opera</a> web browser.</p>

<p>This is a private site, containing references to copyright material
the web-author and friends own. It is intended to make the use of
those books easier. If you own the books referenced here, it is
probably ok to use this information if it is useful to you. It is not
intended to substitute for the books themselves, which are available
from your neighbourhood hobby or games store, or from <a
href="http://www.wizards.com/dnd/">Wizards of the Coast</a>.</p>

<?php
require_once('magpierss/rss_fetch.inc');

$url = 'http://www.wizards.com/rss.asp?x=dnd';
$rss = fetch_rss($url);
$image = $rss->image[url];
$title = $rss->image[title];
echo "<h3>Newsfeed from: ";
echo "<img src='$image' alt='$title'></h3>\n";
foreach ($rss->items as $item ) {
  $title = $item[title];
  $url   = $item[link];
  echo "<a href=$url>$title</a></li><br>\n";
}

?>

<p>You will want Adobe Acrobat Reader to be able to print your
character sheets, custom spell sheets and initiative cards. If you
don't have it installed (and you probably already do), then click on
the <a href="#get_acrobat">link</a> below to get it. It's free.</p>

<table>

<tr>

<td>This site best viewed with<a href="http://www.mozilla.org/releases/#1.8b1"><br>
<img src="images/corporate_logos/badge-moz-05a.png" alt="Mozilla" height=31 width=88 border=0></a></td>

<td><a href="http://www.apache.org"><img src="images/corporate_logos/apache_pb.gif" height=32 width=259 alt="Apache web server" border=0></a></td>

<td><a href="http://www.php.net"><img src="images/corporate_logos/php.gif" height=67 width=120 alt="php" border=0></a></td>

<td><a href="http://www.latex-project.org"><img src="images/corporate_logos/latex.png" width=64 height=64 alt="LaTeX: a document preparation system" border=0></a></td>


<td>Database driven by<br><a href="http://www.mysql.org"><img src="images/corporate_logos/mysql.png" height=43 width=81 alt="MySQL" border=0></a></td>
</tr>

<tr>
<td><a href="http://www.adobe.com/products/acrobat/readstep2.html"
name="get_acrobat"><img src="images/corporate_logos/get_adobe_reader.gif" alt="Get
Adobe Acrobat Reader" height=31 width=88 border=0 align=left></a></td>


<td colspan=3><p>We welcome your feedback: if you have found an error, or a bug,
or you want your favourite source included, <a
href="mailto:enquiries@lbs.ca">contact us.</a></p></td>

<td><a href="http://www.lbs.ca/">This site brought to you by: <img
src="images/logos/lbs-logo-small.png" alt="Linux Based Solutions Ltd"
height=75 width=125 border=0 align=top></a><br>Linux Based Solutions
Ltd</td>

</tr>

</table>

<!-- BEGIN ChangeNotes Popup Link -->
<script language="JavaScript">
function watchit(url) {
  watchitWin = window.open('http://www.changenotes.com/addapage.php?url='+document.location,
	'watchitWindow',
	'scrollbars=yes,resizable=yes,toolbar=no,directories=no,status=no,menubar=no,height=550,width=600')
  watchitWin.focus()
  return false
}
</script>
<a href="http://www.changenotes.com/addapage.php" onclick='javascript:return watchit()'>Receive email when this page changes</a> 
<!-- END ChangeNotes Popup Link -->

</body>
</html>
