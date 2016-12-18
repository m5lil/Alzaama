<?php
$action = isset($_GET['action']) ? $_GET['action'] : null;
if ($action !== null && $action == 'add') {
    if (isset($_POST['save'])) {
        $sound = new Sound();
        $sound->stitle = $_POST['stitle'];
        $sound->sorder = $_POST['sorder'];
        $sound->slink = $_POST['slink'];
        if ($sound->save()) {
                    echo '<script>window.location.href="'. HOST_NAME . 'admin/?view='.$_GET['view'].'"</script>';
        }  else {
            echo 'Error';
        }
    }
}elseif ($action !== null && $action == 'edit') {
    $item = isset($_GET['item']) ? intval($_GET['item']) : null;
    if($item){
        $sound = Sound::read("SELECT * FROM sound WHERE id = $item",PDO::FETCH_CLASS, 'Sound');
        if ($sound !== FALSE) {
            if (isset($_POST['save'])) {
                $sound->stitle = $_POST['stitle'];
                $sound->sorder = $_POST['sorder'];
                $sound->slink = $_POST['slink'];
                if ($sound->save()) {
                    echo '<script>window.location.href="'. HOST_NAME . 'admin/?view='.$_GET['view'].'"</script>';
                }  else {
                    echo 'Error';
                }
            }

        }
    }
}elseif ($action !== null && $action == 'delete') {
    $item = isset($_GET['item']) ? intval($_GET['item']) : null;
    if($item){
        $sound = Sound::read("SELECT * FROM sound WHERE id = $item",PDO::FETCH_CLASS, 'Sound');
        if ($sound !== FALSE) {
                if ($sound->delete()) {
                    echo '<script>window.location.href="'. HOST_NAME . 'admin/?view='.$_GET['view'].'"</script>';
                }  else {
                    echo 'Error';
                }

        }
    }

}

?>


<h2>الصوتيات</h2>


<?PHP
if ($action !== null && ($action == 'add' || $action == 'edit')){
?>
<div class="help-block">Use This Form To Add Cats  </div>
<form action="" method="post"  >
    <div id="form-group">
        <table>
            <tr>
                <td><label for="stitle">العنوان</label></td>
                <td><input class="form-control" required type="text" name="stitle" value="<?php if(isset($sound)){    echo $sound->stitle; }?>"></td>
            </tr>
            <tr>
                <td><label for="slink">كود قائمة التشغيل</label></td>
                <td><textarea cols="90" class="form-control"name="slink"  ><?php  if(isset($sound)){  echo $sound->slink;  }?></textarea></td>
            </tr>
            <tr>
                <td><label for="sorder">الترتيب</label></td>
                <td><input class="form-control" required type="text" name="sorder" value="<?php if(isset($sound)){    echo $sound->sorder; }?>"></td>
            </tr>
            
            
            
            <tr>
                <td><input class="btn" type="submit" name="save" value="Done"></td>
            </tr>
        </table>
    </div>
    

    

    
</form>
<?PHP }  else {
     Sound::control();
}


?>
