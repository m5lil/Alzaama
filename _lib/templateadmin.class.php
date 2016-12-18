<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class TemplateAdmin extends Template{
    
    public function __construct(){
        $output = '<!doctype html>';
        $output .= '<html lang="en"';
        $output .= '<head>';
        $output .= $this->setTitle('لوحة التحكم - الزعامة المحمدية');
        $output .= $this->setEncoding();
        $output .= $this->setBase();
        $output .= $this->addFavIcon();
        $output .= $this->setCSS();
        $output .= $this->setJS();
        $output .= $this->callCDN();
        $output .= $this->addscript();
        
        $output .= '</head><body>';
        echo $output;
        if(User::isLoggedIn()){
            $this->callTemplate();
//        $this->callTemplate();  // With Left sideBar
            }  else {
                require_once APP_PATH . 'admin/login.php';
            }
        }
    
    private $template = array(
        'header.tpl',
        'content.tpl',
    );

    
    public function callTemplate() {
        foreach ($this->template as $template){
            if(file_exists(ADMIN_TEMPLATE_PATH . $template)){
                require_once (ADMIN_TEMPLATE_PATH . $template);
            }  else {
                echo '<!-- NO TEMPLATE WITH NAME '. $template .' -->';
            }
        }
    }
    
    public function renderView() {
        $view = (isset($_GET['view'])) ? $_GET['view'] : 'index';
        if(file_exists(ADMIN_VIEWS_PATH . $view . '.view.php')){
            require_once ADMIN_VIEWS_PATH . $view . '.view.php';
        }  else {
            require_once ADMIN_VIEWS_PATH . '404.view.php';
        }
    }
    
}