<?php
$action = isset($_GET['action']) ? $_GET['action'] : null;
if ($action !== null && $action == 'add') {
    if (isset($_POST['save'])) {
        $cat = new Cat();
        $cat->title = $_POST['title'];
        $cat->kind = $_POST['kind'];
        if ($cat->save()) {
                    echo '<script>window.location.href="'. HOST_NAME . 'admin/?view='.$_GET['view'].'"</script>';
        }  else {
            echo 'Error';
        }
    }
}elseif ($action !== null && $action == 'edit') {
    $item = isset($_GET['item']) ? intval($_GET['item']) : null;
    if($item){
        $cat = Cat::read("SELECT * FROM cat WHERE id = $item",PDO::FETCH_CLASS, 'Cat');
        if ($cat !== FALSE) {
            if (isset($_POST['save'])) {
                $cat->title = $_POST['title'];
                $cat->kind = $_POST['kind'];
                if ($cat->save()) {
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
        $cat = Cat::read("SELECT * FROM cat WHERE id = $item",PDO::FETCH_CLASS, 'Cat');
        if ($cat !== FALSE) {
                if ($cat->delete()) {
                    echo '<script>window.location.href="'. HOST_NAME . 'admin/?view='.$_GET['view'].'"</script>';
                }  else {
                    echo 'Error';
                }

        }
    }

}

?>


<h2>الأقسام</h2>


<?PHP
if ($action !== null && ($action == 'add' || $action == 'edit')){
?>
<div class="help-block">Use This Form To Add Cats  </div>
<form action="" method="post" enctype="application/x-www-form-urlencode" >
    <div id="form-group">
        <table>
            <tr>
                <td><label for="title">العنوان</label></td>
                <td><input class="form-control" required type="text" name="title" value="<?php if(isset($cat)){    echo $cat->title; }?>"></td>
            </tr>
            <tr>
                <td><label for="title">نوع القسم</label></td>
                <td>
                    <select name="kind">
                        <option value="<?php echo $page->kind; ?>" selected='selected'>-</option>
                        <option value="0">تصنيف مقالات</option>
                        <option value="1">ألبوم صور</option>
                        <option value="2">ألبوم فيديو</option>
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
     Cat::control();
}


?>
