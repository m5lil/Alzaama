
<div class="sliderr">
<?php
$option = Options::read("SELECT * FROM options WHERE id = 1",PDO::FETCH_CLASS, 'Options');

$allSlides = Slider::read("SELECT * FROM slider",PDO::FETCH_CLASS, 'Slider');
if ($allSlides != FALSE) {
    echo '<ul class="bxslider">';
    if (is_object($allSlides)) {
        echo "<li><a href=\"$allSlides->slink\"><img height=400 width=100% src=" . $allSlides->simg . " title=" . $allSlides->stitle . " /></a><div class=\"bx-caption\"><span>" . $allSlides->stitle . "</span></div>";
        echo "</li>";
    } else {
    foreach ($allSlides as $slide){
        echo "<li><a href=\"$slide->slink\"><img height=400 width=100% src=\"$slide->simg \" title=" . $slide->stitle . " /></a><div class=\"bx-caption\"><span>" . $slide->stitle . "</span></div>";
        echo "</li>";
    }
    }
    echo '</ul>';
    
}
          
?>                        </div>
                        <div class="row">

                            <div class="col-md-12 vid">
                                <div class="pull-right"><h3 style="background-color:#fff; padding:6px; margin-bottom:-5px; border-radius:5px;">فيديوهات</h3></div>
                                <div class="pull-left" style="margin-top:20px;background-color:#fff; padding:6px; margin-bottom:-5px; border-radius:5px;">
                                    <span id="slider-next"></span>
                                    <span id="slider-prev"></span>
                                </div>
                                <div class="clearfix"></div>
                                <div class="videos">
<?php
$allSlides = Video::read("SELECT * FROM video ORDER BY id DESC LIMIT 24",PDO::FETCH_CLASS, 'Video');
if ($allSlides != FALSE) {
    if (is_object($allSlides)) {
        echo  "<div class=\"slide\">"
                . "<img src=\"http://i.ytimg.com/vi/$allSlides->vlink/mqdefault.jpg\" />"
                . "<div class=\"igcaption\">"
                . "<a href=\"https://www.youtube.com/watch?v=$allSlides->vlink\" class=\"html5lightbox\">$allSlides->vtitle</a>"
                . "</div>"
                . "</div>";
    } else {
    foreach ($allSlides as $slide){
        echo  "<div class=\"slide\">"
                . "<img src=\"http://i.ytimg.com/vi/$slide->vlink/mqdefault.jpg\" />"
                . "<div class=\"igcaption\">"
                . "<a href=\"https://www.youtube.com/embed/$slide->vlink\" class=\"html5lightbox\">$slide->vtitle</a>"
                . "</div>"
                . "</div>";
    }
    }
}
    ?>
                                </div>
                            </div>                   
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="conbox">
                                    <h4>آخر المقالات</h4>
                                    <ul class="newsticker">
                                        
<?php
$page = Page::read("SELECT * FROM pages WHERE idc = 8",PDO::FETCH_CLASS, 'Page');
                if ($page !== FALSE) {
                        foreach ($page as $pg){

                        echo '<li><a href="?view=post&pid='. $pg->id .'">'.$pg->title.'</a>'
                                . '<div class="detailss ">'
                                . '<span class="glyphicon glyphicon-calendar"></span>  <small>'.$pg->postdate.'</small> '
                            . '</div></li>';
                    }
                }
                ?>
                                    </ul>
                                    <div class="arrowupdown">
                                        <div class="btn btn-info btn-sm" id="nt-next">
                                            <span class="glyphicon glyphicon-chevron-down"></span>
                                        </div>
                                        <div class="btn btn-info btn-sm" id="nt-prev">
                                            <span class="glyphicon glyphicon-chevron-up"></span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="conbox">
                                    <h4>الأكثر مشاهدة</h4>
                                    <ul class="newsticker1">
                                        
<?php
$page = Page::read("SELECT * FROM pages WHERE idc = 3",PDO::FETCH_CLASS, 'Page');
                if ($page !== FALSE) {
                        foreach ($page as $pg){

                        echo '<li><a href="?view=post&pid='. $pg->id .'">'.$pg->title.'</a>'
                                . '<div class="detailss ">'
                                . '<span class="glyphicon glyphicon-calendar"></span>  <small>'.$pg->postdate.'</small> '
                            . '</div></li>';
                    }
                }
                ?>
                                    </ul>
                                    <div class="arrowupdown">
                                        <div class="btn btn-info btn-sm" id="nt-next1">
                                            <span class="glyphicon glyphicon-chevron-down"></span>
                                        </div>
                                        <div class="btn btn-info btn-sm" id="nt-prev1">
                                            <span class="glyphicon glyphicon-chevron-up"></span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                <br />
                <a href="<?php echo $option->bnr_url; ?>" ><img src="<?php echo $option->bnr_img; ?>" width="850" height="120" alt="" /></a>
               
                <div class="row"><br />
                    <div class="col-md-6">

                        <?php
                        $allbnr = e3lan::read("SELECT * FROM e3lan WHERE bnr = 1",PDO::FETCH_CLASS, 'E3lan');
                        if ($allbnr != FALSE) {
                            echo '<ul class="monasba">';
                            if (is_object($allbnr)) {
                                echo "<li><a href=\"$allbnr->link\"><img width=100% src=\"$allbnr->img\" title=\" \"  width=\"409\" height=\"400\" alt=\"\"  /></a>";
                                echo "</li>";
                            } else {
                                foreach ($allbnr as $slide){
                                    echo "<li><a href=\"$slide->link\"><img width=100% src=\"$slide->img \" title=\" \"  width=\"409\" height=\"400\" alt=\"\" /></a>";
                                    echo "</li>";
                                }
                            }
                            echo '</ul>';

                        }

                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                        $allbnr = e3lan::read("SELECT * FROM e3lan WHERE bnr = 2",PDO::FETCH_CLASS, 'E3lan');
                        if ($allbnr != FALSE) {
                            echo '<ul class="monasba">';
                            if (is_object($allbnr)) {
                                echo "<li><a href=\"$allbnr->link\"><img width=100% src=\"$allbnr->img\" title=\" \"  width=\"409\" height=\"400\" alt=\"\"  /></a>";
                                echo "</li>";
                            } else {
                                foreach ($allbnr as $slide){
                                    echo "<li><a href=\"$slide->link\"><img width=100% src=\"$slide->img \" title=\" \"  width=\"409\" height=\"400\" alt=\"\" /></a>";
                                    echo "</li>";
                                }
                            }
                            echo '</ul>';

                        }

                        ?>
                    </div>
                </div>