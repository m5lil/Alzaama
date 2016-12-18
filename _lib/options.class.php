<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Options extends DBModel{
    public $id;
    public $site_title;
    public $email_page;
    public $fb_url;
    public $tw_url;
    public $yt_url;
    public $bnr_img;
    public $bnr_url;
    public $bnr2_img;
    public $bnr2_url;
    public $bnr3_img;
    public $bnr3_url;
    public $side_1;
    public $side_2;
    public $side_3;
    public $tablename = 'options';
    public $dbfeilds = array(
        'site_title',
        'email_page',
        'fb_url',
        'tw_url',
        'yt_url',
        'bnr_img',
        'bnr_url',
        'bnr2_img',
        'bnr2_url',
        'bnr3_img',
        'bnr3_url',
        'side_1',
        'side_2',
        'side_3'
    );
    public static function control(){
        $allMenu = self::read("SELECT * FROM options",PDO::FETCH_CLASS, __CLASS__);
        if ($allMenu != FALSE) {
            if (is_object($allMenu)) {
                $table .= '<tr>'
                        . '<td>1</td>'
                        . '<td>'. $allMenu->site_title .'</td>'
                        . '<tr>';
            }
        }  else {
            $table .= '<tr><td colspan="3">No Data Entry </td></tr>';
        }
        $table .= '</table>';
        if(User::theUser()->privilage == "Admin"){
            echo $table;
        }
    }
}


