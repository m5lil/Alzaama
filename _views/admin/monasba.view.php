<?php
$action = isset($_GET['action']) ? $_GET['action'] : null;
if ($action !== null && $action == 'add') {
    if (isset($_POST['save'])) {
        $monasba = new Monasba();
        $monasba->link = $_POST['link'];
        $path_img = $_FILES['img']['tmp_name'];
        $name_img = $_FILES['img']['name'];
        $type_img = $_FILES['img']['type'];
        $destination = IMG_PATH . 'upload' . DS;
        move_uploaded_file($path_img, $destination . $name_img);
        $monasba->img = IMG_HOST . 'upload/' . $name_img;
        if ($monasba->save()) {
                    echo '<script>window.location.href="'. HOST_NAME . 'admin/?view='.$_GET['view'].'"</script>';
        }  else {
            echo 'Error';
            echo $monasba->img;
        }
    }
}elseif ($action !== null && $action == 'edit') {
    $item = isset($_GET['item']) ? intval($_GET['item']) : null;
    if($item){
        $monasba = Monasba::read("SELECT * FROM monasba WHERE id = $item",PDO::FETCH_CLASS, 'Monasba');
        if ($monasba !== FALSE) {
            if (isset($_POST['save'])) {
                $monasba->link = $_POST['link'];
                $path_img = $_FILES['img']['tmp_name'];
                $name_img = $_FILES['img']['name'];
                $type_img = $_FILES['img']['type'];
                $destination = IMG_PATH . 'upload' . DS;
                move_uploaded_file($path_img, $destination . $name_img);
                $monasba->img = IMG_HOST . 'upload/' . $name_img;
                if ($monasba->save()) {
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
        $monasba = Monasba::read("SELECT * FROM monasba WHERE id = $item",PDO::FETCH_CLASS, 'Monasba');
        if ($monasba !== FALSE) {
                if ($monasba->delete()) {
                    echo '<script>window.location.href="'. HOST_NAME . 'admin/?view='.$_GET['view'].'"</script>';
                }  else {
                    echo 'Error';
                }

        }
    }

}

?>


<h2>المناسبات</h2>


<?PHP
if ($action !== null && ($action == 'add' || $action == 'edit')){
?>
<div class="help-block">Use This Form To Add Cats  </div>
<form action="" method="post" enctype="multipart/form-data" >
    <div id="form-group">
        <table>
            <tr>
                <td><label for="img">الصوره</label></td>
                <td><input type="file" name="img" class="form-control" placeholder="صورتك"></td>
            </tr>
            <tr>
                <td><label for="link">الرابط</label></td>
                <td>
                    <select name="link">
                        <option value="<?php  if(isset($monasba)){  echo $monasba->link;  }?>">
                        <?php  if(isset($monasba)){  echo $monasba->link;  }  else {echo 'لم يتم إختيار تصنيف بعد';}?>
                        </option>
                        <?php
                        $pag = Page::read("SELECT * FROM pages",PDO::FETCH_CLASS, 'Page');
                        foreach ($pag as $pg){ ?>
                        <option value="/?view=post&pid=<?php echo $pg->id ?>"><?php echo $pg->title ?></option>
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
     Monasba::control();
}


?>
