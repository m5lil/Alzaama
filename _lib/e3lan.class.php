<?php
/**
 * Created by PhpStorm.
 * User: codzin
 * Date: 5/15/15
 * Time: 17:43
 */


class E3lan extends DBModel{
    public $id;
    public $img;
    public $link;
    public $bnr;
    public $tablename = 'e3lan';
    public $dbfeilds = array(
        'img',
        'link',
        'bnr'
    );
    public static function control(){
        $view = $_GET['view'];
        $addUrl = 'admin/?view=' . $view . '&action=add';
        $editUrl = 'admin/?view=' . $view . '&action=edit&item=';
        $deleteUrl = 'admin/?view=' . $view . '&action=delete&item=';
        $deleteWarning = 'onClick="if(!confirm(\'Sure ?\')) return false;"';

        $allMenu = self::read("SELECT * FROM e3lan",PDO::FETCH_CLASS, __CLASS__);
        $table = '<a class="pull-left btn" href="' . $addUrl . '"> +أضف بنر </a>'
            . '<table class="table table-striped">';
        $table .= '<tr>'
            . '<th>#</th>'
            . '<th>الصورة</th>'
            . '<th>Options</th></tr>';
        if ($allMenu != FALSE) {
            if (is_object($allMenu)) {
                $table .= '<tr>'
                    . '<td>1</td>'
                    . '<td><img src="'. $allMenu->img .'" width="40" /></td>'
                    . '<td><a href="'. $editUrl . $allMenu->id .'">تعديل</a> | <a href="'. $deleteUrl . $allMenu->id .'" ' . $deleteWarning . '>حذف</a></td></tr>';
            }  else {
                $i = 1;

                foreach ($allMenu as $e3lan){
                    $table .= '<tr>'
                        . '<td>'. $i++ .'</td>'
                        . '<td><img src="'. $e3lan->img .'" width="40" /></td>'
                        . '<td>'. $e3lan->bnr .'</td>'
                        . '<td><a href="'. $editUrl . $e3lan->id .'">تعديل</a> | <a href="'. $deleteUrl . $e3lan->id .'" ' . $deleteWarning . '>حذف</a></td></tr>';
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