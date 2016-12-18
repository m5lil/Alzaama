<?php
$action = isset($_GET['action']) ? $_GET['action'] : null;
if ($action !== null && $action == 'add') {
    if (isset($_POST['save'])) {
        $gallary = new Gallary();
        $gallary->gtitle = $_POST['gtitle'];
        $gallary->gorder = $_POST['gorder'];
        $gallary->ccid = $_POST['ccid'];
        $path_img = $_FILES['gimg']['tmp_name'];
        $name_img = $_FILES['gimg']['name'];
        $type_img = $_FILES['gimg']['type'];
        $destination = IMG_PATH . 'upload' . DS;
        move_uploaded_file($path_img, $destination . $name_img);
        $gallary->gimg = IMG_HOST . 'upload/' . $name_img;
        if ($gallary->save()) {
                    echo '<script>window.location.href="'. HOST_NAME . 'admin/?view='.$_GET['view'].'"</script>';
        }  else {
            echo 'Error';
        }
    }
}elseif ($action !== null && $action == 'edit') {
    $item = isset($_GET['item']) ? intval($_GET['item']) : null;
    if($item){
        $gallary = Gallary::read("SELECT * FROM gallary WHERE id = $item",PDO::FETCH_CLASS, 'Gallary');
        if ($gallary !== FALSE) {
            if (isset($_POST['save'])) {
                $gallary->gtitle = $_POST['gtitle'];
                $gallary->gorder = $_POST['gorder'];
                $gallary->ccid = $_POST['ccid'];
                if ($gallary->save()) {
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
        $gallary = Gallary::read("SELECT * FROM gallary WHERE id = $item",PDO::FETCH_CLASS, 'Gallary');
        if ($gallary !== FALSE) {
                if ($gallary->delete()) {
                    echo '<script>window.location.href="'. HOST_NAME . 'admin/?view='.$_GET['view'].'"</script>';
                }  else {
                    echo 'Error';
                }

        }
    }

}

?>


<h2>معرض الصور</h2>


<?PHP
if ($action !== null && ($action == 'add' || $action == 'edit')){
?>
<div class="help-block">Use This Form To Add Cats  </div>
<form action="" method="post" enctype="multipart/form-data" >
    <div id="form-group">
        <table>
            <tr>
                <td><label for="gtitle">العنوان</label></td>
                <td><input class="form-control" required type="text" name="gtitle" value="<?php if(isset($gallary)){    echo $gallary->gtitle; }?>"></td>
            </tr>
            <tr>
                <td><label for="gimg">الصورة</label></td>
                <td><input type="file" name="gimg" class="form-control" value="<?php if(isset($gallary)){    echo $gallary->gimg; }?>"></td>
            </tr>
            <tr>
                <td><label for="gorder">الترتيب</label></td>
                <td><input class="form-control" required type="text" name="gorder" value="<?php if(isset($gallary)){    echo $gallary->gorder; }?>"></td>
            </tr>
                        <tr>
                <td><label for="ccid">التصنيف الرئيسي</label></td>
                <td>
                    <select name="ccid" required>
                        <option value="<?php  if(isset($gallary)){  echo $gallary->ccid;  }?>">
                        <?php  if(isset($pages)){  echo 'تم الإختيار مسبقا';  }  else {echo 'لم يتم إختيار تصنيف بعد';}?>
                        </option>
                        <?php
                        $pag = Cat::read("SELECT * FROM cat WHERE kind = 1",PDO::FETCH_CLASS, 'Cat');
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
     Gallary::control();
}


?>
