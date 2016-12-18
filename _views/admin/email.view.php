<?php
$action = isset($_GET['action']) ? $_GET['action'] : null;
if ($action !== null && $action == 'add') {
    if (isset($_POST['save'])) {
        $email = new Email();
        $email->etitle = $_POST['etitle'];
        $email->econtent = $_POST['econtent'];
        $email->eemail = $_POST['eemail'];
        $email->ename = $_POST['ename'];
        $email->ephone = $_POST['ephone'];
        if ($email->save()) {
                    echo '<script>window.location.href="'. HOST_NAME . 'admin/?view='.$_GET['view'].'"</script>';
        }  else {
            echo 'Error';
        }
    }
}elseif ($action !== null && $action == 'edit') {
    $item = isset($_GET['item']) ? intval($_GET['item']) : null;
    if($item){
        $email = Email::read("SELECT * FROM email WHERE id = $item",PDO::FETCH_CLASS, 'Email');
        if ($email !== FALSE) {
            if (isset($_POST['save'])) {
                $email->etitle = $_POST['etitle'];
                $email->econtent = $_POST['econtent'];
                $email->eemail = $_POST['eemail'];
                $email->ename = $_POST['ename'];
                $email->ephone = $_POST['ephone'];
                if ($email->save()) {
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
        $email = Email::read("SELECT * FROM email WHERE id = $item",PDO::FETCH_CLASS, 'Email');
        if ($email !== FALSE) {
                if ($email->delete()) {
                    echo '<script>window.location.href="'. HOST_NAME . 'admin/?view='.$_GET['view'].'"</script>';
                }  else {
                    echo 'Error';
                }

        }
    }

}

?>


<h2>إستفسارات الزوار</h2>


<?PHP
if ($action !== null && ($action == 'add' || $action == 'edit')){
?>
<div class="help-block">Use This Form To Add Cats  </div>
<form action="" method="post" enctype="multipart/form-data" >
    <div id="form-group">
        <table>
            <tr>
                <td><label for="etitle">العنوان</label></td>
                <td><input class="form-control" required type="text" name="etitle" disabled value="<?php if(isset($email)){    echo $email->etitle; }?>"></td>
            </tr>
            <tr>
                <td><label for="econtent">محتوى الرسالة</label></td>
                <td><textarea id="nic" cols="90" class="form-control"name="econtent" disabled ><?php  if(isset($email)){  echo $email->econtent;  }?></textarea></td>
            </tr>
            <tr>
                <td><label for="eemail">الإيميل</label></td>
                <td><input class="form-control" required type="text" name="eemail" disabled value="<?php if(isset($email)){    echo $email->eemail; }?>"></td>
            </tr>
            <tr>
                <td><label for="ename">الإسم</label></td>
                <td><input class="form-control" required type="text" name="ename" disabled value="<?php if(isset($email)){    echo $email->ename; }?>"></td>
            </tr>
            <tr>
                <td><label for="ephone">رقم التلغوون</label></td>
                <td><input class="form-control" required type="text" name="ephone" disabled value="<?php if(isset($email)){    echo $email->ephone; }?>"></td>
            </tr>
            
            
            
            <tr>
                <td><input class="btn" type="submit" name="save" value="Done"></td>
            </tr>
        </table>
    </div>
    

    

    
</form>
<?PHP }  else {
     Email::control();
}


?>
