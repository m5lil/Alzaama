<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Monasba extends DBModel{
    public $id;
    public $img;
    public $link;
    public $tablename = 'monasba';
    public $dbfeilds = array(
        'img',
        'link'
    );
    public static function control(){
        $view = $_GET['view'];
        $addUrl = 'admin/?view=' . $view . '&action=add';
        $editUrl = 'admin/?view=' . $view . '&action=edit&item=';
        $deleteUrl = 'admin/?view=' . $view . '&action=delete&item=';
        $deleteWarning = 'onClick="if(!confirm(\'Sure ?\')) return false;"';
        
        $allMenu = self::read("SELECT * FROM monasba",PDO::FETCH_CLASS, __CLASS__);
        $table = '<a class="pull-left btn" href="' . $addUrl . '"> +أضف مناسبة </a>'
                . '<table class="table table-striped">';
        $table .= '<tr>'
                . '<th>#</th>'
                . '<th>الصورة</th>'
                . '<th>Options</th></tr>';
        if ($allMenu != FALSE) {
            if (is_object($allMenu)) {
                $table .= '<tr>'
                        . '<td>1</td>'
                        . '<td><img src='. $allMenu->img .' width="40" /></td>'
                        . '<td><a href="'. $editUrl . $allMenu->id .'">تعديل</a> | <a href="'. $deleteUrl . $allMenu->id .'" ' . $deleteWarning . '>حذف</a></td></tr>';
            }  else {
                $i = 1;
                
                foreach ($allMenu as $monasba){
                    $table .= '<tr>'
                        . '<td>'. $i++ .'</td>'
                        . '<td><img src='. $monasba->img .' width="40" /></td>'
                        . '<td><a href="'. $editUrl . $monasba->id .'">تعديل</a> | <a href="'. $deleteUrl . $monasba->id .'" ' . $deleteWarning . '>حذف</a></td></tr>';
                }
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