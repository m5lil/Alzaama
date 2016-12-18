<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Cat extends DBModel{
    public $id;
    public $title;
    public $imgurl;
    public $kind;
    public $tablename = 'cat';
    public $dbfeilds = array(
        'title',
        'imgurl',
        'kind'
        
    );
    public static function control(){
        $view = $_GET['view'];
        $addUrl = 'admin/?view=' . $view . '&action=add';
        $editUrl = 'admin/?view=' . $view . '&action=edit&item=';
        $deleteUrl = 'admin/?view=' . $view . '&action=delete&item=';
        $deleteWarning = 'onClick="if(!confirm(\'Sure ?\')) return false;"';
        
        $allPage = self::read("SELECT * FROM cat WHERE NOT id = 2",PDO::FETCH_CLASS, __CLASS__);
        $table = '<a class="pull-left btn" href="' . $addUrl . '"> +أضف تصنيف </a>'
                . '<table class="table table-striped">';
        $table .= '<tr>'
                . '<th>#</th>'
                . '<th>Title</th>'
                . '<th>Options</th></tr>';
        if ($allPage != FALSE) {
            if (is_object($allPage)) {
                $table .= '<tr>'
                        . '<td>1</td>'
                        . '<td>'. $allPage->title .'</td>'
                        . '<td><a href="'. $editUrl . $allPage->id .'">تعديل</a> | <a href="'. $deleteUrl . $allPage->id .'" ' . $deleteWarning . '>حذف</a></td></tr>';
            }  else {
                $i = 1;
                
                foreach ($allPage as $page){
                    $table .= '<tr>'
                        . '<td>'. $i++ .'</td>'
                        . '<td>'. $page->title .'</td>'
                        . '<td><a href="'. $editUrl . $page->id .'">تعديل</a> | <a href="'. $deleteUrl . $page->id .'" ' . $deleteWarning . '>حذف</a></td></tr>';
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