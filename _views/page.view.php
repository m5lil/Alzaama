<?php
            
            $pid = isset($_GET['pid']) ? intval($_GET['pid']) : null;
            if ($pid !== null) {
                $page = Page::read("SELECT * FROM pages WHERE idp = 0 AND id = $pid",PDO::FETCH_CLASS, 'Page');
                if ($page !== FALSE) {
                    $content = $page->content;
                    $title = $page->title;
                }
            }
            ?>


<h3><?php echo $title; ?></h3>
<hr />
<?php echo $content; ?>