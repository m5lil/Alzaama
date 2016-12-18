<?php
$action = isset($_GET['action']) ? $_GET['action'] : null;
if ($action !== null && $action == 'add') {
    if (isset($_POST['save'])) {
        $e3lan = new E3lan();
        $e3lan->link = $_POST['link'];
        $path_img = $_FILES['img']['tmp_name'];
        $name_img = $_FILES['img']['name'];
        $type_img = $_FILES['img']['type'];
        $destination = IMG_PATH . 'upload' . DS;
        move_uploaded_file($path_img, $destination . $name_img);
        $e3lan->img = IMG_HOST . 'upload/' . $name_img;
        $e3lan->bnr = $_POST['bnr'];
        if ($e3lan->save()) {
            echo '<script>window.location.href="'. HOST_NAME . 'admin/?view='.$_GET['view'].'"</script>';
        }  else {
            echo 'Error';
            echo $e3lan->img;
        }
    }
}elseif ($action !== null && $action == 'edit') {
    $item = isset($_GET['item']) ? intval($_GET['item']) : null;
    if($item){
        $e3lan = E3lan::read("SELECT * FROM e3lan WHERE id = $item",PDO::FETCH_CLASS, 'E3lan');
        if ($e3lan !== FALSE) {
            if (isset($_POST['save'])) {
                $e3lan->link = $_POST['link'];
                $path_img = $_FILES['img']['tmp_name'];
                $name_img = $_FILES['img']['name'];
                $type_img = $_FILES['img']['type'];
                $destination = IMG_PATH . 'upload' . DS;
                move_uploaded_file($path_img, $destination . $name_img);
                $e3lan->img = IMG_HOST . 'upload/' . $name_img;
                $e3lan->bnr = $_POST['bnr'];
                if ($e3lan->save()) {
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
        $e3lan = E3lan::read("SELECT * FROM e3lan WHERE id = $item",PDO::FETCH_CLASS, 'E3lan');
        if ($e3lan !== FALSE) {
            if ($e3lan->delete()) {
                echo '<script>window.location.href="'. HOST_NAME . 'admin/?view='.$_GET['view'].'"</script>';
            }  else {
                echo 'Error';
            }

        }
    }

}

?>


<h2>البنرات</h2>


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
                            <option value="<?php  if(isset($e3lan)){  echo $e3lan->link;  }?>">
                                <?php  if(isset($e3lan)){  echo $e3lan->link;  }  else {echo 'لم يتم إختيار تصنيف بعد';}?>
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
                    <td><label for="bnr">البنر</label></td>
                    <td>
                        <select name="bnr">
                            <option value="<?php  if(isset($e3lan)){  echo $e3lan->bnr;  }?>">
                                <?php  if(isset($e3lan)){  echo $e3lan->bnr;  }  else {echo 'لم يتم إختيار تصنيف بعد';}?>
                            </option>
                            <option value="1">الأول</option>
                            <option value="2">الثانى</option>
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
    E3lan::control();
}


?>
