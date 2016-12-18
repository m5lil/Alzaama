<?php
$action = isset($_GET['action']) ? $_GET['action'] : null;
if ($action !== null && $action == 'add') {
    if (isset($_POST['save'])) {
        $users = new User();
        $users->name = $_POST['name'];
        $users->username = $_POST['username'];
        $users->password = $_POST['password'];
        $users->email = $_POST['email'];
        $users->privilage = $_POST['privilage'];
        $users->password = md5($users->username . $users->password . SAULT);
        if ($users->save()) {
                    echo '<script>window.location.href="'. HOST_NAME . 'admin/?view='.$_GET['view'].'"</script>';
        }  else {
            echo 'Error';
        }
    }
}elseif ($action !== null && $action == 'edit') {
    $item = isset($_GET['item']) ? intval($_GET['item']) : null;
    if($item){
        $users = User::read("SELECT * FROM users WHERE id = $item ", PDO::FETCH_CLASS, 'User');
        if ($users !== FALSE) {
            if (isset($_POST['save'])) {
                $users->name = $_POST['name'];
                $users->username = $_POST['username'];
                $users->password = $_POST['password'];
                $users->email = $_POST['email'];
                $users->privilage = $_POST['privilage'];
                $users->password = md5($users->username . $users->password . SAULT);
                $users->email = $_POST['email'];
                if ($users->save()) {
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
        $users = User::read("SELECT * FROM users WHERE id = $item",PDO::FETCH_CLASS, 'User');
        if ($users !== FALSE) {
                if ($users->delete()) {
                    echo '<script>window.location.href="'. HOST_NAME . 'admin/?view='.$_GET['view'].'"</script>';
                }  else {
                    echo 'Error';
                }

        }
    }

}

?>


<h2> الأعضاء </h2>


<?PHP
if ($action !== null && ($action == 'add' || $action == 'edit')){
?>
<div class="row">
    <div class="col-md-12">
<div class="help-block">إستخدم الفور التالى فى إضافة أو تعديل عضو</div>
<form action="" method="post" enctype="application/x-www-form-urlencode">
    <div id="form-group">
        <table>
            <tr>
                <td><label for="name"> إسم العضو</label></td>
                <td><input class="form-control" required type="text" name="name" value="<?php if(isset($users)){    echo $users->name; }?>"></td>
            </tr>
            <tr>
                <td><label for="username"> إسم المستخدم</label></td>
                <td><input class="form-control" required type="text" name="username" value="<?php if(isset($users)){    echo $users->username; }?>"></td>
            </tr>
            <tr>
                <td><label for="password">الباسوورد </label></td>
                <td><input class="form-control" required type="password" name="password" value="" ></td>
            </tr>
            <tr>
                <td><label for="email">الإيميل </label></td>
                <td><textarea class="form-control" required name="email" ><?php if(isset($users)){    echo $users->email; }?></textarea></td>
            </tr>
            <tr>
                <td><label for="privilage">الصلاحية</label></td>
                <td>
                    <select name="privilage">
                        <option value="<?php echo $users->privilage; ?>" selected='selected'>Already Chosen</option>
                        <option value="Admin">مدير</option>
                        <option value="User">عضو</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td><input class="btn" type="submit" name="save" value="Done"></td>
            </tr>
        </table>
    </div>
    </div>
 </div>   
    

    

    
</form>
<?PHP }  else {
     User::control();
}


?>


