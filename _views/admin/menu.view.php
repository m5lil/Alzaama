<?php
$action = isset($_GET['action']) ? $_GET['action'] : null;
if ($action !== null && $action == 'add') {
    if (isset($_POST['save'])) {
        $menu = new Menu();
        $hrefq = explode('|', $_POST['title']);
        $menu->title = $hrefq[1];
        $menu->orderq = $_POST['orderq'];
        $menu->href = $hrefq[0];
        if ($menu->save()) {
                    echo '<script>window.location.href="'. HOST_NAME . 'admin/?view='.$_GET['view'].'"</script>';
        }  else {
            echo 'Error';
        }
    }
}elseif ($action !== null && $action == 'edit') {
    $item = isset($_GET['item']) ? intval($_GET['item']) : null;
    if($item){
        $menu = Menu::read("SELECT * FROM menu WHERE id = $item",PDO::FETCH_CLASS, 'Menu');
        if ($menu !== FALSE) {
            if (isset($_POST['save'])) {
                $hrefq = explode('|', $_POST['title']);
                $menu->title = $hrefq[1];
                $menu->orderq = $_POST['orderq'];
                $menu->href = $hrefq[0];
                if ($menu->save()) {
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
        $menu = Menu::read("SELECT * FROM menu WHERE id = $item",PDO::FETCH_CLASS, 'Menu');
        if ($menu !== FALSE) {
                if ($menu->delete()) {
                    echo '<script>window.location.href="'. HOST_NAME . 'admin/?view='.$_GET['view'].'"</script>';
                }  else {
                    echo 'Error';
                }

        }
    }

}

?>


<h2>القائمة العلوية</h2>


<?PHP
if ($action !== null && ($action == 'add' || $action == 'edit')){
?>
<div class="help-block">Use This Form To Add Cats  </div>
<form action="" method="post" enctype="application/x-www-form-urlencode" >
    <div id="form-group">
        <table>
            <tr>
                <td><label for="title">العنوان</label></td>
                <td>
                    <select name="title">
                        <option value="<?php  if(isset($menu)){  echo $menu->title;  }?>">
                        <?php  if(isset($menu)){  echo 'تم الإختيار مسبقا';  }  else {echo 'لم يتم إختيار تصنيف بعد';}?>
                        </option>
                        <?php
                        $pag = Page::read("SELECT * FROM pages",PDO::FETCH_CLASS, 'Page');
                        $pag1 = Cat::read("SELECT * FROM cat",PDO::FETCH_CLASS, 'Cat');
                        foreach ($pag as $pg){ ?>
                        <option value="?view=page&pid=<?php echo $pg->id ?>|<?php echo $pg->title ?>"><?php echo $pg->title ?></option>
                        <?php } ?>
                        <?php foreach ($pag1 as $pg1){ ?>
                        <option value="?view=post&cid=<?php echo $pg1->id ?>|<?php echo $pg1->title ?>"><?php echo $pg1->title ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="orderq">الترتيب</label></td>
                <td><input class="form-control" required type="text" name="orderq" value="<?php if(isset($menu)){    echo $menu->order; }?>"></td>
            </tr>
            
            
            
            <tr>
                <td><input class="btn" type="submit" name="save" value="Done"></td>
            </tr>
        </table>
    </div>
    

    

    
</form>
<?PHP }  else {
     Menu::control();
}


?>
