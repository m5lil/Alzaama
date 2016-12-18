<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Page extends DBModel{
    public $id;
    public $idp;
    public $idc;
    public $qerw;
    public $title;
    public $content;
    public $postdate;
    public $postauthor;
    public $imgurl;
    public $shown;
    public $tablename = 'pages';
    public $dbfeilds = array(
        'idp',
        'idc',
        'qerw',
        'title',
        'content',
        'postdate',
        'postauthor',
        'imgurl',
        'shown'
        
    );
    public static function control($idpage = 0){
        $view = $_GET['view'];
        $addUrl = 'admin/?view=' . $view . '&action=add';
        $editUrl = 'admin/?view=' . $view . '&action=edit&item=';
        $deleteUrl = 'admin/?view=' . $view . '&action=delete&item=';
        $deleteWarning = 'onClick="if(!confirm(\'Sure ?\')) return false;"';
        
        $allPage = self::read("SELECT * FROM pages WHERE idp = '". $idpage ."' ORDER BY idc, qerw",PDO::FETCH_CLASS, __CLASS__);
        $table = '<a class="pull-left btn" href="' . $addUrl . '"> +أضف صفحة </a>'
                . '<table class="table table-striped">';
        $table .= '<tr>'
                . '<th>#</th>'
                . '<th>Title</th>'
                . '<th>ID Category</th>'
                . '<th>Order</th>'
                . '<th>Options</th></tr><tbody id="sortable">';

        if ($allPage != FALSE) {
            if (is_object($allPage)) {
                $table .= '<tr>'
                        . '<td>1</td>'
                        . '<td>'. $allPage->title .'</td>'
                        . '<td><a href="'. $editUrl . $allPage->id .'">تعديل</a> | <a href="'. $deleteUrl . $allPage->id .'" ' . $deleteWarning . '>حذف</a></td></tr>';
            }  else {
                $e = 1;
                $i = 1;
                 
                foreach ($allPage as $page){
                    $table .= '<tr id="item-'. $e++ .'">'
                        . '<td>'. $i++ .'</td>'
                        . '<td>'. $page->title .'</td>'
                        . '<td>'. $page->idc .'</td>'
                        . '<td>'. $page->qerw .'</td>'
                        . '<td><a href="'. $editUrl . $page->id .'">تعديل</a> | <a href="'. $deleteUrl . $page->id .'" ' . $deleteWarning . '>حذف</a></td></tr>';
                }
                 $table .= '</div>';
            }
        }  else {
            $table .= '<tr><td colspan="3">No Data Entry </td></tr>';
        }
        $table .= '</table>';
        echo $table;
        
    }
}