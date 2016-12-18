<?php
if ($_GET['c']) {
    $activation = $_GET['c'];
    $sql = "SELECT * FROM users WHERE activation = '". $activation ."'";
    $found = User::read($sql, PDO::FETCH_CLASS, 'User');
    if ($found) {
        $found->activation = '';
        $found->status = 1;
        if ($found->save()) {
            echo '<script>window.location.href="'. HOST_NAME . '?view=login"</script>';
        }
    }
}
