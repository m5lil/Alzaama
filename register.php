<?php

if (isset($_POST['submit'])) {
    $user = new User();
    $user->name = $_POST['name'];
    $user->username = $_POST['username'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    $user->gender = $_POST['gender'];
    $rpassword = $_POST['rpassword'];
    if (User::chkUser($user->username)) {
        echo 'المستخدم موجود بالفعل';
    } elseif ($rpassword != $user->password) {
        echo 'الباسوورد ليست متطابقه';
} else {
    $user->password = md5($user->username . $user->password . SAULT);
    $user->status = 1;
    $user->privilage = 2;
    if ($user->save()) {
       // $email = mail($to, $subject, $message)
       $message =  'Activate Link'
               . '<br />'
        . HOST_NAME . '?view=activate&c=' . $user->activation
               . '<br /><a href=' . HOST_NAME . '?view=activate&c=' . $user->activation . '>Activate</a>';
    }
}
}



?>

<div style="width: 300px; margin: 30px auto;" class="well">
    
    <h3>تسجيل  طالب جديد</h3>
    <hr />

    <form method="post" role="form" enctype="multipart/form-data">
        <div class="row">
                <div class="form-group">
                        <label for="name">Yout Name</label>
                        <input type="text" name="name" class="form-control" placeholder="الإسم" required>
                        <label for="name">Email</label>
                        <input type="text" name="email" class="form-control" placeholder="البريد الإلكترونى" required>
                        <label for="name">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="إسم المستخدم" required>
                        <label for="name">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="الرقم السرى" required>
                        <label for="name">Retype Password</label>
                        <input type="password" name="rpassword" class="form-control" placeholder="كرر الرقم السرى" required>
                        <label class="pull-left " for="male">Male
                        <input type="radio" name="gender" class="form-control" value="1" required></label>
                        <label for="female">Female
                        <input type="radio" name="gender" class="form-control" value="2" required></label>
                        <input type="submit" name="submit" class="btn btn-primary btn-block" value="تسجيل">

                </div><?php    echo $message; ?>
         </div>
       </div> 
    </form>
   
</div>



</body>
</html>