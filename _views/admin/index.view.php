<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$option = Options::read("SELECT * FROM options WHERE id = 1",PDO::FETCH_CLASS, 'Options');
        if ($option !== FALSE) {
            if (isset($_POST['save'])) {
                $option->site_title = $_POST['site_title'];
                $option->email_page = $_POST['email_page'];
                $option->fb_url = $_POST['fb_url'];
                $option->tw_url = $_POST['tw_url'];
                $option->yt_url = $_POST['yt_url'];
                $option->bnr_url = $_POST['bnr_url'];
                $option->bnr2_url = $_POST['bnr2_url'];
                $option->bnr3_url = $_POST['bnr3_url'];
                $option->bnr3_img = $_POST['bnr3_img'];
                if(!empty($_FILES['bnr_img']['name'])){
                    $path_img = $_FILES['bnr_img']['tmp_name'];
                    $name_img = $_FILES['bnr_img']['name'];
                    $type_img = $_FILES['bnr_img']['type'];
                    $destination = IMG_PATH . 'upload' . DS;
                    move_uploaded_file($path_img, $destination . $name_img);
                    $option->bnr_img = IMG_HOST . 'upload/' . $name_img;
                }
                if(!empty($_FILES['bnr2_img']['name'])){
                    $path2_img = $_FILES['bnr2_img']['tmp_name'];
                    $name2_img = $_FILES['bnr2_img']['name'];
                    $type2_img = $_FILES['bnr2_img']['type'];
                    $destination2 = IMG_PATH . 'upload' . DS;
                    move_uploaded_file($path2_img, $destination2 . $name2_img);
                    $option->bnr2_img = IMG_HOST . 'upload/' . $name2_img;
                }
                $option->side_1 = $_POST['side_1'];
                $option->side_2 = $_POST['side_2'];
                $option->side_3 = $_POST['side_3'];
                if ($option->save()) {
                    echo "Done ";
                }  else {
                    echo '؛Problem ';
                }
            }

        }
        
        
        
        ?>


<form action="" method="post" enctype="multipart/form-data" >
    <div id="form-group">
        <table>
            <tr>
                <td><label for="site_title">عنوان الموقع : </label></td>
                <td><input class="form-control" required type="text" name="site_title" value="<?php if(isset($option)){    echo $option->site_title; }?>"></td>
            </tr>
            <tr>
                <td colspan="2"><hr /></td>
            </tr>
            <tr>
                <td><label for="fb_url">عنوان صفحة الفيس : </label></td>
                <td><input class="form-control" required type="text" name="fb_url" value="<?php if(isset($option)){    echo $option->fb_url; }?>"></td>
            </tr>
            <tr>
                <td><label for="tw_url">عنوان صفحة تويتر : </label></td>
                <td><input class="form-control" required type="text" name="tw_url" value="<?php if(isset($option)){    echo $option->tw_url; }?>"></td>
            </tr>
            <tr>
                <td><label for="yt_url">عنوان صفحة يوتيوب : </label></td>
                <td><input class="form-control" required type="text" name="yt_url" value="<?php if(isset($option)){    echo $option->yt_url; }?>"></td>
            </tr>
            <tr>
                <td colspan="2"><hr /></td>
            </tr>
            <tr>
                <td><label for="email_page">محتوى صفحة إتصل بنا : </label></td>
                <td><textarea id="nic" cols="90" class="form-control"name="email_page" ><?php  if(isset($option)){  echo $option->email_page;  }?></textarea></td>
            </tr>
            <tr>
                <td colspan="2"><hr /></td>
            </tr>
            <tr>
                <td><label for="bnr_img">النر الإعلانى </label></td>
                <td><input type="file" name="bnr_img" class="form-control" value="<?php if(isset($option)){    echo $option->bnr_img; }?>"></td>
            </tr>
            <tr>
                <td><label for="bnr_url">رابط  البنر</label></td>
                <td><input class="form-control"  type="text" name="bnr_url" value="<?php if(isset($option)){    echo $option->bnr_url; }?>"></td>
            </tr>
            <tr>
                <td><label for="bnr3_url">ععنوان الرابط العلوى</label></td>
                <td><input class="form-control"  type="text" name="bnr3_url" value="<?php if(isset($option)){    echo $option->bnr3_url; }?>"></td>
            </tr>
            <tr>
                <td><label for="bnr3_img">را/بط العلوى </label></td>
                <td><input class="form-control"  type="text" name="bnr3_img" value="<?php if(isset($option)){    echo $option->bnr3_img; }?>"></td>
            </tr>

            <tr>
                <td colspan="2"><hr /></td>
            </tr>
            <tr>
                <td><label for="side_1">عنوان القائمة 1</label></td>
                <td><input class="form-control"  type="text" name="side_1" value="<?php if(isset($option)){    echo $option->side_1; }?>"></td>
            </tr>

            <tr>
                <td><label for="side_2">عنوان القائمة 2</label></td>
                <td><input class="form-control"  type="text" name="side_2" value="<?php if(isset($option)){    echo $option->side_2; }?>"></td>
            </tr>

            <tr>
                <td><label for="side_3">عنوان القائمة 3</label></td>
                <td><input class="form-control"  type="text" name="side_3" value="<?php if(isset($option)){    echo $option->side_3; }?>"></td>
            </tr>

            <tr>
                <td colspan="2"><input class="btn-block" type="submit" name="save" value="حفظ"></td>
            </tr>
        </table>
    </div>
    

    

    
</form>
