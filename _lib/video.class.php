<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Video extends DBModel{
    public $id;
    public $vtitle;
    public $vlink;
    public $cvid;
    public $tablename = 'video';
    public $dbfeilds = array(
        'vtitle',
        'vlink',
        'cvid',
       
    );
    public static function control(){
        $view = $_GET['view'];
        $addUrl = 'admin/?view=' . $view . '&action=add';
        $editUrl = 'admin/?view=' . $view . '&action=edit&item=';
        $deleteUrl = 'admin/?view=' . $view . '&action=delete&item=';
        $deleteWarning = 'onClick="if(!confirm(\'Sure ?\')) return false;"';
        
        $allMenu = self::read("SELECT * FROM video",PDO::FETCH_CLASS, __CLASS__);
        $table = '<a class="pull-left btn" href="' . $addUrl . '"> +أضف فديو </a>'
                . '<table class="table table-striped">';
        $table .= '<tr>'
                . '<th>#</th>'
                . '<th>Title</th>'
                . '<th>Options</th></tr>';
        if ($allMenu != FALSE) {
            if (is_object($allMenu)) {
                $table .= '<tr>'
                        . '<td>1</td>'
                        . '<td>'. $allMenu->vtitle .'</td>'
                        . '<td><a href="'. $editUrl . $allMenu->id .'">تعديل</a> | <a href="'. $deleteUrl . $allMenu->id .'" ' . $deleteWarning . '>حذف</a></td></tr>';
            }  else {
                $i = 1;
                
                foreach ($allMenu as $video){
                    $table .= '<tr>'
                        . '<td>'. $i++ .'</td>'
                        . '<td>'. $video->vtitle .'</td>'
                        . '<td><a href="'. $editUrl . $video->id .'">تعديل</a> | <a href="'. $deleteUrl . $video->id .'" ' . $deleteWarning . '>حذف</a></td></tr>';
                }
            }
        }  else {
            $table .= '<tr><td colspan="3">No Data Entry </td></tr>';
        }
        $table .= '</table>';
        echo $table;
    }
}