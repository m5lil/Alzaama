<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Email extends DBModel{
    public $id;
    public $etitle;
    public $econtent;
    public $eemail;
    public $ename;
    public $ephone;
    public $tablename = 'email';
    public $dbfeilds = array(
        'etitle',
        'econtent',
        'eemail',
        'ename',
        'ephone'
        
    );
    public static function control(){
        $view = $_GET['view'];
        $addUrl = 'admin/?view=' . $view . '&action=add';
        $editUrl = 'admin/?view=' . $view . '&action=edit&item=';
        $deleteUrl = 'admin/?view=' . $view . '&action=delete&item=';
        $deleteWarning = 'onClick="if(!confirm(\'Sure ?\')) return false;"';
        
        $allMenu = self::read("SELECT * FROM email",PDO::FETCH_CLASS, __CLASS__);
        $table = '<a class="pull-left btn" href="' . $addUrl . '"> +أضف صفحة </a>'
                . '<table class="table table-striped">';
        $table .= '<tr>'
                . '<th>#</th>'
                . '<th>Title</th>'
                . '<th>Options</th></tr>';
        if ($allMenu != FALSE) {
            if (is_object($allMenu)) {
                $table .= '<tr>'
                        . '<td>1</td>'
                        . '<td>'. $allMenu->etitle .'</td>'
                        . '<td><a href="'. $editUrl . $allMenu->id .'">تعديل</a> | <a href="'. $deleteUrl . $allMenu->id .'" ' . $deleteWarning . '>حذف</a></td></tr>';
            }  else {
                $i = 1;
                
                foreach ($allMenu as $email){
                    if($email->position == 1){
                            $posi = "<strong>top<?strong>";
                        }  else {
                            $posi = "Left";
                        }
                    $table .= '<tr>'
                        . '<td>'. $i++ .'</td>'
                        . '<td>'. $email->etitle .'</td>'
                        . '<td><a href="'. $editUrl . $email->id .'">تعديل</a> | <a href="'. $deleteUrl . $email->id .'" ' . $deleteWarning . '>حذف</a></td></tr>';
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