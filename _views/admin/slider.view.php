<?php
$action = isset($_GET['action']) ? $_GET['action'] : null;
if ($action !== null && $action == 'add') {
    if (isset($_POST['save'])) {
        $slider = new Slider();
        $slider->stitle = $_POST['stitle'];
        $slider->slink = $_POST['slink'];
        $slider->sorder = $_POST['sorder'];
        $path_img = $_FILES['simg']['tmp_name'];
        $name_img = $_FILES['simg']['name'];
        $type_img = $_FILES['simg']['type'];
        $destination = IMG_PATH . 'upload' . DS;
        move_uploaded_file($path_img, $destination . $name_img);
        $slider->simg = IMG_HOST . 'upload/' . $name_img;
        if ($slider->save()) {
                    echo '<script>window.location.href="'. HOST_NAME . 'admin/?view='.$_GET['view'].'"</script>';
        }  else {
            echo 'Error';
        }
    }
}elseif ($action !== null && $action == 'edit') {
    $item = isset($_GET['item']) ? intval($_GET['item']) : null;
    if($item){
        $slider = Slider::read("SELECT * FROM slider WHERE id = $item",PDO::FETCH_CLASS, 'Slider');
        if ($slider !== FALSE) {
            if (isset($_POST['save'])) {
                $slider->stitle = $_POST['stitle'];
                $slider->slink = $_POST['slink'];
                $slider->sorder = $_POST['sorder'];
                $path_img = $_FILES['simg']['tmp_name'];
                $name_img = $_FILES['simg']['name'];
                $type_img = $_FILES['simg']['type'];
                $destination = IMG_PATH . 'upload' . DS;
                move_uploaded_file($path_img, $destination . $name_img);
                $slider->simg = IMG_HOST . 'upload/' . $name_img;
                if ($slider->save()) {
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
        $slider = Slider::read("SELECT * FROM slider WHERE id = $item",PDO::FETCH_CLASS, 'Slider');
        if ($slider !== FALSE) {
                if ($slider->delete()) {
                    echo '<script>window.location.href="'. HOST_NAME . 'admin/?view='.$_GET['view'].'"</script>';
                }  else {
                    echo 'Error';
                }

        }
    }

}

?>


<h2>السلايدر</h2>


<?PHP
if ($action !== null && ($action == 'add' || $action == 'edit')){
?>
<div class="help-block">Use This Form To Add Cats  </div>
<form action="" method="post" enctype="multipart/form-data" >
    <div id="form-group">
        <table>
            <tr>
                <td><label for="stitle">العنوان</label></td>
                <td>
                    <select name="stitle">
                        <option value="<?php  if(isset($slider)){  echo $slider->stitle;  }?>">
                        <?php  if(isset($slider)){  echo $slider->stitle;  }  else {echo 'لم يتم إختيار تصنيف بعد';}?>
                        </option>
                        <?php
                        $pag = Page::read("SELECT * FROM pages",PDO::FETCH_CLASS, 'Page');
                        foreach ($pag as $pg){ ?>
                        <option value="<?php echo $pg->title ?>"><?php echo $pg->title ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="slink">رابط السلايد</label></td>
                <td>
                    <select name="slink">
                        <option value="<?php  if(isset($slider)){  echo $slider->slink;  }?>">
                        <?php  if(isset($slider)){  echo $slider->slink;  }  else {echo 'لم يتم إختيار تصنيف بعد';}?>
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
                <td><label for="simg">الصورة</label></td>
                <td><input type="file" name="simg" class="form-control" placeholder="صوره"></td>
            </tr>
            <tr>
                <td><label for="orderq">الترتيب</label></td>
                <td><input class="form-control" required type="text" name="orderq" value="<?php if(isset($slider)){    echo $slider->order; }?>"></td>
            </tr>


            
            <tr>
                <td><input class="btn" type="submit" name="save" value="Done"></td>
            </tr>
        </table>
    </div>
    

    

    
</form>
<?PHP }  else {
     Slider::control();
}


?>
