
<?php
$ccid = isset($_GET['ccid']) ? intval($_GET['ccid']) : null;
if ($ccid === null) {

$allSlides = Cat::read("SELECT * FROM cat WHERE kind = 1",PDO::FETCH_CLASS, 'Cat');
echo '<center><h2>ألبومات الصور</h2></center><br />';
if ($allSlides != FALSE) {
    if (is_object($allSlides)) {
        echo '<h4> <a class="btn btn-large btn-block btn-primary" href="?view=gallary&ccid='. $allSlides->id .'&title='. $allSlides->title .'">'. $allSlides->title .'</a></h4>';
    } else {
    foreach ($allSlides as $allSlide){
        echo '<h4><a class="btn btn-large btn-block btn-primary" href="?view=gallary&ccid='. $allSlide->id .'&title='. $allSlide->title .'">'. $allSlide->title .'</a></h4>';
    }
    }
}
}  else {
    



    $allSlides = Gallary::read("SELECT * FROM gallary WHERE ccid = $ccid",PDO::FETCH_CLASS, 'Gallary');
    if ($allSlides !== FALSE) {
        echo '<div style="display:none;" class="html5gallery" data-skin="mediapage" data-width="800" data-height="472">';
    if (is_object($allSlides)) {
        echo "<a href=\"img/upload/$allSlides->gimg\"><img src=\"img/upload/$allSlides->gimg\" alt=\"$allSlides->gtitle\" /></a>";
    } else {
    foreach ($allSlides as $slide){
        echo "<a href=\"$slide->gimg\"><img src=\"$slide->gimg\" alt=\"$slide->gtitle\"></a>";
    }
    }
    }
}
    echo '</div>';

    
    
        
