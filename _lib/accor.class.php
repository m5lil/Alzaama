<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Accor extends DBModel{
    public $id;
    public $idd;
    public $url;
    public $title;
    public $head;
    public $tablename = 'accor';
    public $dbfeilds = array(
        'idd',
        'url',
        'title',
        'head'
    );
    public static function control(){
        $view = $_GET['view'];
        $addUrl = 'admin/?view=' . $view . '&action=add';
        $editUrl = 'admin/?view=' . $view . '&action=edit&item=';
        $deleteUrl = 'admin/?view=' . $view . '&action=delete&item=';
        $deleteWarning = 'onClick="if(!confirm(\'Sure ?\')) return false;"';
        
        $allAccor = self::read("SELECT * FROM accor",PDO::FETCH_CLASS, __CLASS__);
        $table = '<a class="pull-left btn" href="' . $addUrl . '"> +أضف لينك </a>'
                . '<table class="table table-striped">';
        $table .= '<tr>'
                . '<th>#</th>'
                . '<th>العنوان</th>'
                . '<th>الترتيب</th>'
                . '<th>Options</th></tr>';
        if ($allAccor != FALSE) {
            if (is_object($allAccor)) {
                $table .= '<tr>'
                        . '<td>1</td>'
                        . '<td>'. $allAccor->title .'</td>'
                        . '<td>'. $allAccor->idd .' - '. $allAccor->head .'</td>'
                        . '<td><a href="'. $editUrl . $allAccor->id .'">تعديل</a> | <a href="'. $deleteUrl . $allAccor->id .'" ' . $deleteWarning . '>حذف</a></td></tr>';
            }  else {
                $i = 1;
                
                foreach ($allAccor as $accor){
                    $table .= '<tr>'
                        . '<td>'. $i++ .'</td>'
                        . '<td>'. $accor->title .'</td>'
                        . '<td>'. $accor->idd .' - '. $accor->head .'</td>'
                        . '<td><a href="'. $editUrl . $accor->id .'">تعديل</a> | <a href="'. $deleteUrl . $accor->id .'" ' . $deleteWarning . '>حذف</a></td></tr>';
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


