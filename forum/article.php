<?
  header("Expires: ".gmdate("D, d M Y H:i:s",time()+(3600*24))." GMT");

  // register parameters
  $id=$_REQUEST["id"];
  $group=$_REQUEST["group"];

  include "config.inc.php";
  include "auth.inc";
  include "$file_newsportal";

  $message=message_read($id,0,$group);
  if (!$message) {
    header ("HTTP/1.0 404 Not Found");
    $subject=$title;
    $title.=' - Article not found';
    if($ns!=false)
    nntp_close($ns);
  } else {
    $subject=htmlspecialchars($message->header->subject);
    header("Last-Modified: ".date("r", $message->header->date));
    $title.= ' - '.$subject;
  }
  include "head.inc";
?>

<h1 class="np_article_headline"><? echo $subject; ?></h1>

<div class="np_buttonbar">
<? 
  if ((!$readonly) && ($message))
    echo '<span class="np_button"> <a class="np_button" href="'.
         $file_post.'?type=reply&id='.urlencode($id).
         '&group='.urlencode($group).'">'.$text_article["button_answer"].
         '</span></a>';
//  echo '[<a href="'.$file_cancel.'?type=reply&id='.urlencode($id).
//       '&group='.urlencode($group).'">Loeschen</a>]'."\n";
  echo '<span class="np_button"><a class="np_button" href="'.
       $file_thread.'?group='.urlencode($group).'">'.$group.'</a></span>';
  echo '<span class="np_button"><a class="np_button" href="'.
       $file_index.'">'.$text_thread["button_grouplist"].'</a></span>';
?>
</div>

<? 
  if (!$message)
    // article not found
    echo $text_error["article_not_found"];
  else {
    if($article_showthread)
      $thread=thread_cache_load($group);
    message_show($group,$id,0,$message);
    if($article_showthread)
      message_thread($message->header->id,$group,$thread);
  }
  include "tail.inc";
?>
