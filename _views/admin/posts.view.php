<?php
$time = time();
$Ar = new I18N_Arabic('Date'); 
$fix = $Ar->dateCorrection ($time); 
$Ar->setMode(3);
$timee .= $Ar->date('dS F Y م', $time);
$action = isset($_GET['action']) ? $_GET['action'] : null;
if ($action !== null && $action == 'add') {
    if (isset($_POST['save'])) {
        $pages = new Page();
        $pages->title = $_POST['title'];
        $pages->content = $_POST['content'];
        $pages->idp = 1;
        $pages->idc = $_POST['idc'];
        $pages->qerw = $_POST['qerw'];
        $pages->postauthor = User::theUser()->name;
        $pages->postdate = $timee;
        $pages->shown = $_POST['shown'];
        $path_img = $_FILES['imgurl']['tmp_name'];
        $name_img = $_FILES['imgurl']['name'];
        $type_img = $_FILES['imgurl']['type'];
        $destination = IMG_PATH . 'upload' . DS;
        move_uploaded_file($path_img, $destination . $name_img);
        $pages->imgurl = IMG_HOST . 'upload/' . $name_img;
        
        if ($pages->save()) {
                    echo '<script>window.location.href="'. HOST_NAME . 'admin/?view='.$_GET['view'].'"</script>';
        }  else {
            echo 'Error';
        }
    }
}elseif ($action !== null && $action == 'edit') {
    $item = isset($_GET['item']) ? intval($_GET['item']) : null;
    if($item){
        $pages = Page::read("SELECT * FROM pages WHERE id = $item",PDO::FETCH_CLASS, 'Page');
        if ($pages !== FALSE) {
            if (isset($_POST['save'])) {
                $pages->title = $_POST['title'];
                $pages->content = $_POST['content'];
                $pages->idp = 1;
                $pages->idc = $_POST['idc'];
                $pages->qerw = $_POST['qerw'];
                $pages->postauthor = User::theUser()->name;
                $pages->postdate = $timee;
                $pages->shown = $_POST['shown'];
                $path_img = $_FILES['imgurl']['tmp_name'];
                $name_img = $_FILES['imgurl']['name'];
                $type_img = $_FILES['imgurl']['type'];
                $destination = IMG_PATH . 'upload' . DS;
                move_uploaded_file($path_img, $destination . $name_img);
                $pages->imgurl = IMG_HOST . 'upload/' . $name_img;
                
                if ($pages->save()) {
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
        $pages = Page::read("SELECT * FROM pages WHERE id = $item",PDO::FETCH_CLASS, 'Page');
        if ($pages !== FALSE) {
                if ($pages->delete()) {
                    echo '<script>window.location.href="'. HOST_NAME . 'admin/?view='.$_GET['view'].'"</script>';
                }  else {
                    echo 'Error';
                }

        }
    }

}

?>


<h2>المقالات</h2>

<small>أسفل الجدول يوجد ID كل قسم</small>
<?PHP

if ($action !== null && ($action == 'add' || $action == 'edit')){
?>
<div class="help-block">Use This Form To Add Pages  </div>
<form action="" method="post" enctype="multipart/form-data" >
    <div id="form-group">
        <table>
            <tr>
                <td><label for="title">العنوان</label></td>
                <td><input class="form-control"  type="text" name="title" value="<?php if(isset($pages)){    echo $pages->title; }?>"></td>
            </tr>
            <tr>
                <td><label for="content">محتوى الصفحة</label></td>
                <td><textarea id="nic" cols="90" class="form-control"name="content" ><?php  if(isset($pages)){  echo $pages->content;  }?></textarea></td>
            </tr>
            <tr>
                <td><label for="idc">التصنيف الرئيسي</label></td>
                <td>
                    <select name="idc" required>
                        <option value="<?php  if(isset($pages)){  echo $pages->idc;  }?>">
                        <?php  if(isset($pages)){  echo 'تم الإختيار مسبقا';  }  else {echo 'لم يتم إختيار تصنيف بعد';}?>
                        </option>
                        <?php
                        $pag = Cat::read("SELECT * FROM cat WHERE kind = 0",PDO::FETCH_CLASS, 'Cat');
                        foreach ($pag as $pg){ ?>
                        <option value="<?php echo $pg->id ?>"><?php echo $pg->title ?></option>
                        <?php } ?>
                    </select>
                </td>   
            </tr>
            <tr>
                <td><label for="imgurl">الصورة</label></td>
                <td><input type="file" name="imgurl" class="form-control" placeholder="صورتك"></td>
            </tr>
            <tr>
                <td><label for="shown">الظهور</label></td>
                <td>
                    <select name="shown">
                        <option value="<?php echo $page->shown; ?>" selected='selected'>Already Chosen</option>
                        <option value="1">مفعلة</option>
                        <option value="0">غير مفعلة</option>
                    </select>
                </td>
            </tr>
                        <tr>
                <td><label for="qerw">الترتيب</label></td>
                <td><input class="form-control" type="text" name="qerw" value="<?php if(isset($pages)){    echo $pages->qerw; }?>"></td>
            </tr>

            <tr>
                <td><input class="btn" type="submit" name="save" value="Done"></td>
            </tr>
        </table>
    </div>
    

    

    
</form>

<?PHP }  else {
     Page::control(1);
}
$cats = Cat::read("SELECT * FROM cat",PDO::FETCH_CLASS, 'Cat');
echo '<h4>ID Categories</h4>';
foreach ($cats as $ct){
echo  $ct->id . ' -> ' . $ct->title . '</br>';
}

?>
