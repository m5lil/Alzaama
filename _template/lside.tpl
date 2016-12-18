<?php

function dis_menu($parent = 0){
    

$allPage = Page::read("SELECT * FROM page WHERE parent_id = $parent AND position = 0 AND shown = 1 ORDER BY tty ASC",PDO::FETCH_CLASS, 'Page');

if ($allPage != FALSE) {
    echo '<ul>';
    if (is_object($allPage)) {
        echo "<li><a href=\"?pid=$allPage->id\">". $allPage->title . "</a>";
            dis_menu($allPage->id);
        echo "</li>";
    } else {
    foreach ($allPage as $page){
        echo "<li><a href=\"?pid=$page->id\">". $page->title . "</a>";
            dis_menu($page->id);
        echo "</li>";
    }
    }
    echo '
    </ul>';
    
}
}
function dis_acco($parent){
    

$allAccor = Accor::read("SELECT * FROM accor WHERE head = $parent ORDER BY idd",PDO::FETCH_CLASS, 'Page');

if ($allAccor != FALSE) {
    if (is_object($allAccor)) {
        echo "<li><a href=\"$allAccor->url\">". $allAccor->title . "</a></li>";
    } else {
    foreach ($allAccor as $accor){
        echo "<li><a href=\"$accor->url\">". $accor->title . "</a></li>";
    }
    }    
}
}


?>

        


                    <div class="side col-md-3">
                        <div class="accor" id="accordion">
                            <h5 style="border-top-left-radius: 7px; border-top-right-radius: 7px;"><?php echo $option->side_1; ?></h5>
                            <div>
                                <ul class="acco_links">
                                    <?php dis_acco(1) ?>
                                </ul>
                                
                            </div>
                            <h5><?php echo $option->side_2; ?></h5>
                            <div>
                                <ul class="acco_links">
                                    <?php dis_acco(2) ?>
                                </ul>
                            </div>
                            <h5><?php echo $option->side_3; ?></h5>
                            <div>
                                <ul class="acco_links">
                                    <?php dis_acco(3) ?>
                                </ul>
                            </div>
                            <h5 style="border-bottom-left-radius: 7px; border-bottom-right-radius: 7px;">
                                <span class="glyphicon glyphicon-chevron-up"></span>
                            </h5>
                        </div>
                        <div class="block_side">
                            <div class="head_block">
                                <h5>الصوتيات</h5>
                                <div class="blockcontent">
                                    <iframe width="100%" height="450" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/46556725&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>

                                </div>
                            </div>
                        </div>
                        <div class="block_side">
                            <div class="head_block">
                                <h5>ركن المناسبات</h5>
                                <div class="blockcontent">
                                                                        <?php
$allSlides = Slider::read("SELECT * FROM monasba",PDO::FETCH_CLASS, 'Monasba');
if ($allSlides != FALSE) {
    echo '<ul class="monasba">';
    if (is_object($allSlides)) {
        echo "<li><a href=\"$allSlides->link\"><img width=100% src=\"$allSlides->img\" title=\" \" /></a>";
        echo "</li>";
    } else {
    foreach ($allSlides as $slide){
        echo "<li><a href=\"$slide->link\"><img width=100% src=\"$slide->img \" title=\" \" /></a>";
        echo "</li>";
    }
    }
    echo '</ul>';
    
}
          
?>

                                </div>
                            </div>
                        </div>
                        <div class="block_side">
                            <div class="head_block">
                                <h5>مواقيت الصلاه</h5>
                                <div class="blockcontent">
                                    <iframe  name="prayertimes" src="http://timesprayer.com/widgets.php?name=cairo.html&frame=1" width="250" height="170" style="border: none; " scrolling="no"></iframe>
                                </div>
                            </div>
                        </div>
                        <div class="block_side">
                            <div class="head_block">
                                <h5>خدمة الباحثين</h5>
                                <div class="blockcontent">
                                    يسعدنا تلقى أسألتكم والإجابة على إستفساراتكم <br />
                                    <button class="playy btn btn-xs" id="play" onclick="location.href='http://alzama.com/?view=email';">
                                        <span class="glyphicon glyphicon-exclamation-sign"></span> إرسل سؤال
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>