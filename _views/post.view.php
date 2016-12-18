
<div
  class="fb-like"
  data-share="true"
  data-width="450"
  data-show-faces="true">
</div><br />
<br />
<?php
            
            $cid = isset($_GET['cid']) ? intval($_GET['cid']) : null;
            if ($cid !== null) {
                $page = Page::read("SELECT * FROM pages WHERE idc = $cid ORDER BY qerw",PDO::FETCH_CLASS, 'Page');
                if ($page !== FALSE) {
                    if (is_object($page)) {
                        echo '<h4> 1 <a href="?view=post&pid='. $page->id .'&title='. $page->title .'">'. $page->title .'</a></h4>';
                    }  else {
                        $i = 1;
                        foreach ($page as $pg){
                        echo '<h4> '.$i++.' <a href="?view=post&pid='. $pg->id .'&'. $pg->title .'">'. $pg->title .'</a></h4><hr />';
                             }
                    }
                }
            }
//            ++++++++++++++++++++++++++++++++++++++
           
            $pid = isset($_GET['pid']) ? intval($_GET['pid']) : null;
            if ($pid !== null) {
                $page = Page::read("SELECT * FROM pages WHERE idp = 1 AND id = $pid",PDO::FETCH_CLASS, 'Page');
                if ($page !== FALSE) {
                    $content = $page->content;
                    $title = $page->title;
                }
            }
            ?>


<h3><?php echo $title; ?></h3>
<hr />
<?php echo $content; ?>
<?php
if ($pid !== null) {
    
    echo '<div class="fb-comments" data-href="http://www.alzama.com/'.$_SERVER['REQUEST_URI'].'" data-width="100%" data-numposts="5" data-colorscheme="light"></div>';
}
?>
