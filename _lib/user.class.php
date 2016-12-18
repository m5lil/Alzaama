<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class User extends DBModel{
    public $id;
    public $name;
    public $username;
    public $password;
    public $email;
    public $privilage;
    public $tablename = 'users';
    public $dbfeilds = array(
        'name',
        'username',
        'password',
        'email',
        'privilage',

    );
    
    public static function chkUser($username){
        $sql = "SELECT * FROM users WHERE username = '" . $username . "'";
        $foundUser = User::read($sql, PDO::FETCH_CLASS, __CLASS__);
        return ($foundUser) ? true : FALSE;
    }
    
    public static function chkEmail($email){
        $sql = "SELECT * FROM users WHERE email = '" . $email . "'";
        $foundUser = User::read($sql, PDO::FETCH_CLASS, __CLASS__);
        return ($foundUser) ? true : FALSE;
    }
    
    public static function authenticate($username, $password){
         global $dbh;
        $encpassword = md5($username . $password . SAULT);
        $sql = "SELECT * FROM users WHERE username = '" . $username . "' AND password = '" . $encpassword . "'";
        $foundUser = self::read($sql, PDO::FETCH_CLASS, __CLASS__);
        if ($foundUser) {
            $_SESSION['loggedIn'] = TRUE;
            $_SESSION['user'] = $foundUser;
           
        }  else {
            return FALSE;
        }
    }

    
    public static function adminAuthenticate($username, $password){
        $encpassword = md5($username . $password . SAULT);
        $sql = "SELECT * FROM users WHERE username = '" . $username . "' AND password = '" . $encpassword . "'";
        $foundUser = self::read($sql, PDO::FETCH_CLASS, __CLASS__);
        if ($foundUser) {
            $_SESSION['loggedIn'] = TRUE;
            $_SESSION['user'] = $foundUser;
            echo '<script>window.location.href="'. HOST_NAME . 'admin' .'"</script>';
//            header('Location: ' . HOST_NAME . 'admin');
        }  else {
            return FALSE;
        }
    }

    public static function control(){
        $view = $_GET['view'];
        
        $addUrl = 'admin/?view=' . $view . '&action=add';
        $editUrl = 'admin/?view=' . $view . '&action=edit&item=';
        $deleteUrl = 'admin/?view=' . $view . '&action=delete&item=';
        $deleteWarning = 'onClick="if(!confirm(\'Sure ?:)\')) return false;"';
        
        $allUsers = self::read("SELECT * FROM users WHERE id != ". User::theUser()->id, PDO::FETCH_CLASS, __CLASS__);
        $table = '<a class="pull-left btn" href="' . $addUrl . '"> + إضافة عضو جديد</a>'
                . '<table class="table table-striped">';
        $table .= '<tr>'
                . '<th>#</th>'
                . '<th>الإسم</th>'
                . '<th>الصلاحية</th>'
                . '<th>الخيارات</th></tr>';
        if ($allUsers != FALSE) {
            if (is_object($allUsers)) {
                $table .= '<tr>'
                        . '<td>1</td>'
                        . '<td>'. $allUsers->username .'</td>'
                        . '<td>'. $allUsers->privilage .'</td>'
                        . '<td><a href="'. $editUrl . $allUsers->id .'">Edit </a> | <a href="'. $deleteUrl . $allUsers->id .'" ' . $deleteWarning . '>Delete</a></td></tr>';
            }  else {
                $i = 1;
                foreach ($allUsers as $users){
                    $table .= '<tr>'
                        . '<td>'. $i++ .'</td>'
                        . '<td>'. $users->username .'</td>'
                        . '<td>'. $users->privilage .'</td>'
                        . '<td><a href="'. $editUrl . $users->id .'">Edit</a> | <a href="'. $deleteUrl . $users->id .'" ' . $deleteWarning . '>Delete</a></td></tr>';
                }
            }
        }  else {
            $table .= '<tr><td colspan="3">No Entery Data </td></tr>';
        }
        $table .= '</table>';
        echo $table;
    }
    
    public static function isLoggedIn(){
        return isset($_SESSION['loggedIn']) ? TRUE : FALSE;
    }
    
    public function logout(){
        unset($_SESSION['loggedIn']);
        unset($_SESSION['user']);
        unset($_SESSION['CREATED']);
        echo'<script>window.location.href="'. HOST_NAME .'index.php"</script>';
    }
    
    public function isAdmin(){
        return $this->privilage == 1 ? true : false;
    }
    
    public static function theUser(){
        return ($_SESSION['user']);
    }

}