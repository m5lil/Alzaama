
<?php
$cvid = isset($_GET['cvid']) ? intval($_GET['cvid']) : null;
if ($cvid === null) {

$allSlides = Cat::read("SELECT * FROM cat WHERE kind = 2",PDO::FETCH_CLASS, 'Cat');
echo '<center><h2>الفيديوهات</h2></center><br />';
if ($allSlides != FALSE) {
    if (is_object($allSlides)) {
        echo '<h4> <a class="btn btn-large btn-block btn-primary" href="?view=videos&cvid='. $allSlides->id .'&title='. $allSlides->title .'">'. $allSlides->title .'</a></h4>';
    } else {
    foreach ($allSlides as $allSlide){
        echo '<h4><a class="btn btn-large btn-block btn-primary" href="?view=videos&cvid='. $allSlide->id .'&title='. $allSlide->title .'">'. $allSlide->title .'</a></h4>';
    }
    }
}
}  else {
    



    $allSlides = Video::read("SELECT * FROM video WHERE cvid = $cvid",PDO::FETCH_CLASS, 'Video');
    if ($allSlides !== FALSE) {
        echo '<div style="display:none;" class="html5gallery" data-skin="mediapage" data-width="800" data-height="472">';
    if (is_object($allSlides)) {
        echo "<a href=\"http://www.youtube.com/embed/$allSlides->vlink\"><img src=\"http://img.youtube.com/vi/$allSlides->vlink/2.jpg\" alt=\"$allSlides->vtitle\" /></a>";
    } else {
    foreach ($allSlides as $slide){
        echo "<a href=\"http://www.youtube.com/embed/$slide->vlink\"><img src=\"http://img.youtube.com/vi/$slide->vlink/2.jpg\" alt=\"$slide->vtitle\" /></a>";
    }
    }
    }
}
    echo '</div>';

    
    
        

    
    
     