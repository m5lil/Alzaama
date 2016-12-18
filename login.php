<?PHP
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = trim($password);
    $username = trim($username);
    if (!User::authenticate($username, $password)){
        $message = 'أنت غير مسجل أو لم تقم بتفعيل حسابك بعد';
    }


}
?>

<div style="width: 300px; margin: 30px auto;" class="well">
    
    <h3>تسجيل  دخول</h3>
    <hr />

    <form method="post" role="form" enctype="multipart/form-data">
        <div class="row">
                <div class="form-group">
                        <label for="name">إسم المستخدم</label>
                        <input type="text" name="username" class="form-control" placeholder="إسم المستخدم" required>
                        <label for="name">كلمة المرور</label>
                        <input type="password" name="password" class="form-control" placeholder="كلمة المرور" required>
                        <input type="submit" name="submit" class="btn btn-primary btn-block" value="تسجيل">

                </div><center><div class="alert-warning"><?php            echo $message; ?></div></center>
         </div>
       </div> 
    </form>
   
</div>



</body>
</html>