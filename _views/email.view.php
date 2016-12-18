<?php
$option = Options::read("SELECT * FROM options WHERE id = 1",PDO::FETCH_CLASS, 'Options');
if (isset($_POST['submit'])) {
    $email = new Email();
    $email->etitle = $_POST['etitle'];
    $email->econtent = $_POST['econtent'];
    $email->eemail = $_POST['eemail'];
    $email->ename = $_POST['ename'];
    $email->ephone = $_POST['ephone'];
    if ($email->save()) {
            $msg = ' <div class="alert alert-success">تم إرسال الرساله بنجاح</div>';
        }  else {
            echo 'Error';
        }
    }
    
    
    
    ?>
<center>
   
        <?php echo $msg; ?>
    
    
    <h3>إتصل بنا</h3>

</center>

<?php echo $option->email_page; ?>

<hr />

<h4>نموذج لسهولة الإتصال</h4>


<form action="" method="post" enctype="multipart/form-data" >
    <div id="form-group">
        <table>
            <tr>
                <td><label for="etitle">العنوان</label></td>
                <td><input class="form-control" required type="text" name="etitle" value="<?php if(isset($email)){    echo $email->etitle; }?>"></td>
            </tr>
            <tr>
                <td><label for="econtent">محتوى الرساله</label></td>
                <td><textarea id="nic" rows="12" cols="90" class="form-control"name="econtent" ><?php  if(isset($pages)){  echo $pages->econtent;  }?></textarea></td>
            </tr>
            <tr>
                <td><label for="eemail">البريد الالكترونى الخاص بك</label></td>
                <td><input class="form-control" required type="text" name="eemail" value="<?php if(isset($email)){    echo $email->eemail; }?>"></td>
            </tr>
            <tr>
                <td><label for="ename">اسمك</label></td>
                <td><input class="form-control" required type="text" name="ename" value="<?php if(isset($email)){    echo $email->ename; }?>"></td>
            </tr>
            <tr>
                <td><label for="ephone">رقم تلفونك</label></td>
                <td><input class="form-control" required type="text" name="ephone" value="<?php if(isset($email)){    echo $email->ephone; }?>"></td>
            </tr>
            
            
            
            <tr>
                <td><input class="btn" type="submit" name="submit" value="Done"></td>
            </tr>
        </table>
    </div>
    

    

    
</form>
