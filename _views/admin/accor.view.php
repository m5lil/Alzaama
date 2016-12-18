<?php
$action = isset($_GET['action']) ? $_GET['action'] : null;
if ($action !== null && $action == 'add') {
    if (isset($_POST['save'])) {
        $accor = new Accor();
        $accor->title = $_POST['title'];
        $accor->url = $_POST['url'];
        $accor->idd = $_POST['idd'];
        $accor->head = $_POST['head'];
        if ($accor->save()) {
                    echo '<script>window.location.href="'. HOST_NAME . 'admin/?view='.$_GET['view'].'"</script>';
        }  else {
            echo 'Error';
        }
    }
}elseif ($action !== null && $action == 'edit') {
    $item = isset($_GET['item']) ? intval($_GET['item']) : null;
    if($item){
        $accor = Accor::read("SELECT * FROM accor WHERE id = $item",PDO::FETCH_CLASS, 'Accor');
        if ($accor !== FALSE) {
            if (isset($_POST['save'])) {
                $accor->title = $_POST['title'];
                $accor->url = $_POST['url'];
                $accor->idd = $_POST['idd'];
                $accor->head = $_POST['head'];
                if ($accor->save()) {
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
        $accor = Accor::read("SELECT * FROM accor WHERE id = $item",PDO::FETCH_CLASS, 'Accor');
        if ($accor !== FALSE) {
                if ($accor->delete()) {
                    echo '<script>window.location.href="'. HOST_NAME . 'admin/?view='.$_GET['view'].'"</script>';
                }  else {
                    echo 'Error';
                }

        }
    }

}

?>


<h2>السلايدر الجانبى</h2>


<?PHP
if ($action !== null && ($action == 'add' || $action == 'edit')){
?>
<div class="help-block">Use This Form To Add Cats  </div>
<form action="" method="post" enctype="multipart/form-data" >
    <div id="form-group">
        <table>
            <tr>
                <td><label for="title">العنوان</label></td>
                <td>
                    <select name="title">
                        <option value="<?php  if(isset($accor)){  echo $accor->title;  }?>">
                        <?php  if(isset($accor)){  echo $accor->title;  }  else {echo 'لم يتم إختيار تصنيف بعد';}?>
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
                <td><label for="url">رابط السلايد</label></td>
                <td>
                    <select name="url">
                        <option value="<?php  if(isset($accor)){  echo $accor->url;  }?>">
                        <?php  if(isset($accor)){  echo $accor->url;  }  else {echo 'لم يتم إختيار تصنيف بعد';}?>
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
                <td><label for="head">القائمة</label></td>
                <td>
                    <select name="head">
                        <option value="<?php  if(isset($accor)){  echo $accor->head;  }?>">
                        <?php  if(isset($accor)){  echo $accor->head;  }  else {echo 'لم يتم إختيار تصنيف بعد';}?>
                        </option>
                        <?php $option = Options::read("SELECT * FROM options WHERE id = 1",PDO::FETCH_CLASS, 'Options'); ?>
                        <option value="1"><?php echo $option->side_1 ?></option>
                        <option value="2"><?php echo $option->side_2 ?></option>
                        <option value="3"><?php echo $option->side_3 ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="idd">الترتيب</label></td>
                <td><input class="form-control" required type="text" name="idd" value="<?php if(isset($accor)){    echo $accor->idd; }?>"></td>
            </tr>


            
            <tr>
                <td><input class="btn" type="submit" name="save" value="Done"></td>
            </tr>
        </table>
    </div>
    

    

    
</form>
<?PHP }  else {
     Accor::control();
}


?>
