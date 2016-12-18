<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DB {
    /*
     * save DB connection handler
     */
    private static $dbh;
    /*
     * to prevent instantations
     */
    private function __construct() {
        
    }
    
    
    public static function getinstance(){
        if(self::$dbh === NULL){
            self::$dbh = new PDO('mysql://hostname=' . DB_HOST . ';dbname=' . DB_NAME,DB_USER,DB_PASS);
        }
        return self::$dbh;
    }
}