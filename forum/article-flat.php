<?
  header("Expires: ".gmdate("D, d M Y H:i:s",time()+(3600*24))." GMT");
  header("Cache-Control: max-age=100");
  header("Pragma: cache");


  // register parameters
  $id=$_REQUEST["id"];
  $group=$_REQUEST["group"];
  if($_REQUEST["first"])
    $first=$_REQUEST["first"];

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

<?
if($message) {
  // load thread-data and get IDs of the actual subthread
  $thread=thread_load($group);
  $subthread=thread_getsubthreadids($message->header->id,$thread);

  // If no page is set, lets look, if we can calculate the page by
  // the message-number
  if(!$first) {
    $first=intval(array_search($id,$subthread)/$articleflat_articles_per_page)*
           $articleflat_articles_per_page+1;
  }

  // navigation line
  $navline='<div class="np_buttonbar">';
  $navline.='<span class="np_button"><a class="np_button" href="'.
            $file_index.'">'.$text_thread["button_grouplist"].'</a>';
  $navline.=' &#187; ';
  $navline.='<a class="np_button" href="'.
            $file_thread.'?group='.urlencode($group).'">'.$group.'</a></span>';
  $navline.='<span class="np_pages">'.
            articleflat_pageselect($group,$id,count($subthread),$first).
            '</span>';
  $navline.='</div>';
  echo $navline;

  // which articles are exactly on this page?
  $pageids=array();
  for($i=$first-1; (($i<count($subthread)) && 
                  ($i<$first+$articleflat_articles_per_page-1)); $i++) {  
    $pageids[]=$subthread[$i];
  }

  // display the thread on top
  // change some of the default threadstyle-values
  $thread_show["replies"]=true;
  $thread_show["threadsize"]=false;
  $thread_show["lastdate"]=false;
  //message_thread($message->header->id,$group,$thread,$pageids);
  message_thread($message->header->id,$group,$thread,false);
  echo '<br>';


  foreach($pageids as $subid) {
    flush();
    $message=message_read($subid,0,$group);
    echo '<a name="'.$subid.'"> </a>';
    message_show($group,$subid,0,$message,$articleflat_chars_per_articles);
    if ((!$readonly) && ($message)) {
      echo '<form action="'.$file_post.'">'.
           '<input type="hidden" name="id" value="'.urlencode($subid).'">'.
           '<input type="hidden" name="type" value="reply">'.
           '<input type="hidden" name="group" value="'.urlencode($group).'">'.           
           '<input type="submit" value="'.$text_article["button_answer"].
           '">'.
           '</form>';
    }
  }
  echo $navline;
}
include "tail.inc";
?>