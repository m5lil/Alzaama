<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DBModel{
        private function attributes(){
        $string = array();
        foreach ($this->dbfeilds as $feild) {
            if(is_int($this->$feild)){
                $string[] = $feild . " = " . $this->$feild ;
            }  else {
                $string[] = $feild . " = '" . $this->$feild ."'";
            }
        }
        return implode(", ", $string);
    }
    
    public static function read($sql, $type = PDO::FETCH_ASSOC, $class = null){
        global $dbh;
        $resault = $dbh->query($sql);
        if ($resault) {
            if (null !== $class && $type == PDO::FETCH_CLASS) {
                $data = $resault->fetchAll($type, $class);
            }  else {
                $data = $resault->fetchAll($type);
            }
            if (count($data) == 1) {
                $data = array_shift($data);
            }
            return $data;
        }else{
            return FALSE;
        }
        
    }

//    public function Adde($tablenamee,$attr1,$attr2,$post1,$post2){
//        global $dbh;
//        $sql = "INSERT INTO " . $tablenamee . "(" . $attr1 . ", " . $attr2 . ")VALUES('" . $post1 . "', '" . $post2 . "')";
//        $affectedRows = $dbh->exec($sql);
//        if ($affectedRows != FALSE) {
//            $this->id = $dbh->LastInsertId();
//        }  else {
//            return FALSE;
//        }
//        return TRUE;
//
//    }
    
    private function Add(){
        global $dbh;
        $sql = "INSERT INTO " . $this->tablename . " SET " . $this->attributes();
        $affectedRows = $dbh->exec($sql);
        if ($affectedRows != FALSE) {
            $this->id = $dbh->LastInsertId();
        }  else {
            return FALSE;
        }
        return TRUE;
    }
    
    private function update(){
        global $dbh;
        $sql = "UPDATE " . $this->tablename . " SET " . $this->attributes(). " WHERE id = " . $this->id;
        $affectedRows = $dbh->exec($sql);
        return $affectedRows != FALSE ? TRUE : FALSE;
    }
    
    public function delete(){
        global $dbh;
        $sql = "DELETE FROM " . $this->tablename . " WHERE id = " . $this->id;
        $affectedRows = $dbh->exec($sql);
        return $affectedRows != FALSE ? TRUE : FALSE;
    }
    
    
    public function save(){
        return ($this->id === null) ? $this->Add() : $this->update();
    }
    
    
    

}