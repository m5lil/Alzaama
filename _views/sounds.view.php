<?php

$allSound = Sound::read("SELECT * FROM sound ORDER BY sorder",PDO::FETCH_CLASS, 'Sound');
if ($allSound != FALSE) {

    if (is_object($allSound)) {
                    echo "<div class=\"accor\">"

        . "<center><h5>$allSound->stitle</h5></center>"
                . "<div>$allSound->slink</div>";
                    echo "</div>";
    } else {
    foreach ($allSound as $sound){
                    echo "<div class=\"accor\">"

        . "<center><h5>$sound->stitle</h5></center>"
                . "<div>$sound->slink</div>";
                    echo "</div><br />";
    }
    }
                    

}
