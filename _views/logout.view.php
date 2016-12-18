<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(User::isLoggedIn()){
    $user = $_SESSION['user'];
    $user->logout();
}  else {
    header('Location: ' . HOST_NAME . '?view=login');
}