<?php
$action = isset($_GET['action']) ? $_GET['action'] : null;
if ($action !== null && $action == 'add') {
    if (isset($_POST['save'])) {
        $video = new Video();
        $video->vtitle = $_POST['vtitle'];
        $video->vlink = $_POST['vlink'];
        $video->cvid = $_POST['cvid'];
        if ($video->save()) {
                    echo '<script>window.location.href="'. HOST_NAME . 'admin/?view='.$_GET['view'].'"</script>';
        }  else {
            echo 'Error';
        }
    }
}elseif ($action !== null && $action == 'edit') {
    $item = isset($_GET['item']) ? intval($_GET['item']) : null;
    if($item){
        $video = Video::read("SELECT * FROM video WHERE id = $item",PDO::FETCH_CLASS, 'Video');
        if ($video !== FALSE) {
            if (isset($_POST['save'])) {
                $video->vtitle = $_POST['vtitle'];
                $video->vlink = $_POST['vlink'];
                $video->cvid = $_POST['cvid'];
                if ($video->save()) {
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
        $video = Video::read("SELECT * FROM video WHERE id = $item",PDO::FETCH_CLASS, 'Video');
        if ($video !== FALSE) {
                if ($video->delete()) {
                    echo '<script>window.location.href="'. HOST_NAME . 'admin/?view='.$_GET['view'].'"</script>';
                }  else {
                    echo 'Error';
                }

        }
    }

}

?>


<h2>الفيديوهات</h2>


<?PHP
if ($action !== null && ($action == 'add' || $action == 'edit')){
?>
<div class="help-block">Use This Form To Add Cats  </div>
<form action="" method="post" enctype="multipart/form-data" >
    <div id="form-group">
        <table>
            <tr>
                <td><label for="vtitle">العنوان</label></td>
                <td><input class="form-control" required type="text" name="vtitle" value="<?php if(isset($video)){    echo $video->vtitle; }?>"></td>
            </tr>
            <tr>
                <td><label for="vlink">كود الفيديو</label></td>
                <td><input class="form-control" required type="text" name="vlink" value="<?php if(isset($video)){    echo $video->vlink; }?>"></td>
            </tr>
            <tr>
                <td><label for="ccid">التصنيف الرئيسي</label></td>
                <td>
                    <select name="cvid" required>
                        <option value="<?php  if(isset($video)){  echo $video->cvid;  }?>">
                        <?php  if(isset($video)){  echo 'تم الإختيار مسبقا';  }  else {echo 'لم يتم إختيار تصنيف بعد';}?>
                        </option>
                        <?php
                        $pag = Cat::read("SELECT * FROM cat WHERE kind = 2",PDO::FETCH_CLASS, 'Cat');
                        foreach ($pag as $pg){ ?>
                        <option value="<?php echo $pg->id ?>"><?php echo $pg->title ?></option>
                        <?php } ?>
                    </select>
                </td>   
            </tr>
            <tr>
                <td><input class="btn" type="submit" name="save" value="Done"></td>
            </tr>
        </table>
    </div>
    

    

    
</form>
<?PHP }  else {
     Video::control();
}


?>
