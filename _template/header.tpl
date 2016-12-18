<?php



$option = Options::read("SELECT * FROM options WHERE id = 1",PDO::FETCH_CLASS, 'Options');

function dis_menutop(){
$allPage = Menu::read("SELECT * FROM menu ORDER BY orderq ASC",PDO::FETCH_CLASS, 'Menu');

if ($allPage != FALSE) {
    echo '<ul><li><a href="">الرئيسية</a></li>';
    if (is_object($allPage)) {
        echo "<li><a href=\"$allPage->href\">". $allPage->title . "</a>";
        echo "</li>";
    } else {
    foreach ($allPage as $page){
        echo "<li><a href=\"$page->href\">". $page->title . "</a>";
        echo "</li>";
    }
    }
    echo '</ul>';
    
}
}

$allNews = Menu::read("SELECT * FROM pages WHERE idc = 2 ",PDO::FETCH_CLASS, 'Page');

$time = time(); 
   $Ar = new I18N_Arabic('Date'); 
   
  $fix = $Ar->dateCorrection ($time); 
   
  $timee = $Ar->date('l dS F Y ',$time, $fix);
$timee .= ' الموافق ';
 $Ar->setMode(3);
$timee .= $Ar->date('dS F Y ', $time);


?>

        <div id="wrap">

            <div id="top_bar">
                <!--  TOP_BAR  -->
                <div class="container">
                    <div class="row container">
                        <div class="date col-md-6">
                            <span class="icon icon-date"></span>
                           <?php echo $timee; ?>
                        </div>
                        <!--  -->
                        <div class="top_links col-md-6">
                            <ul>
                                <li><a href="?view=email"> - اتصل بنا</a>
                                </li>

                                <li><a href="<?php echo $option->bnr3_img; ?>" ><?php echo $option->bnr3_url; ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div style="clear:both;"></div>
            <!--  END TOP_BAR  -->
            <div id="header">
                <!--  HEADER  -->

                <div class="banner">
                    <img align="center" src="img/banner.jpg" class="img-responsive" alt="">
                </div>
                <!--  -->
                <nav class=" hidden-sm hidden-xs">
                    <div class="qwe container">
                        <?php dis_menutop() ?>
                    </div>
                </nav>
                <!--  -->
                <div class="container">
                    <div class="row break_news">
                        <div class="col-md-1 hidden-sm hidden-xs">
                            <span class="hline">آخر الأخبار :</span>
                        </div>
                        <div class="col-md-9">

                            <ul id="ticker">
                                <?php
                                foreach ($allNews as $pages){
                                
                                echo '<li><a href="?view=post&pid='. $pages->id .'">'. $pages->title .'</a></li>';
                                    }
                                ?>
                            </ul>
                        </div>
                        <div class="col-md-2 hidden-sm hidden-xs">
                            <ul class="list-inline soci">
                                <li>
                                    <a href="<?php echo $option->fb_url; ?>">
                                        <img src="img/fb.png" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $option->tw_url; ?>">
                                        <img src="img/tw.png" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $option->yt_url; ?>">
                                        <img src="img/yt.png" alt="">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--  END HEADER  -->
            <div id="content" class="container">
                <!--  CONTENT  -->
                <div class="row">
                    