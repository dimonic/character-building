<?
  header("Expires: ".gmdate("D, d M Y H:i:s",time()+(3600*24))." GMT");
  include "config.inc.php";
    $attachment_delete_alternative=false;
    $attachment_uudecode=false;

  // register parameters
  $id=$_REQUEST["id"];
  $group=$_REQUEST["group"];

  include "auth.inc";
  include "$file_newsportal";

  $message=message_read($id,0,$group);
  if (!$message) {
    header ("HTTP/1.0 404 Not Found");
    echo $text_error["article_not_found"];
  }
  else {
    header("Content-type: text/plain");
    flush();
    $ns=nntp_open($server,$port);

    if ($ns != false) {

     $head=readPlainHeader($ns,$group,$id);
     for ($i=0; $i<count($head); $i++)
      echo $head[$i]."\n";
     $body=message_read($id,0,$group);
     $body=$body->body[0];
     echo($body);
    }
    nntp_close($ns);
  }
?>
