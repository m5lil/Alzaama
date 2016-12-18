<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Template{
    
    public function __construct(){
        
        $output = '<!doctype html>';
        $output .= '<html>';
        $output .= '<head>';
        $output .= $this->setTitle();
        $output .= $this->setEncoding();
        $output .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
        $output .= $this->addmeta('keywords', 'الزعامة المحمدية','التصوف','التصوف الاسلامي','مشروعية المديح',
                'قصائد صوتية',
                'احتفالات الزعامة المحمدية',
                'الصحابة',
                'ال البيت',
                'اهل البيت',
                'الامام علي',
                'السيدة الزهراء',
                'السيدة زينب',
                'سيدنا الحسين',
                'سيدنا الحسن',
                'الزهراء',
                'البتول',
                'فاطمة',
                'الصوفي'
                
                );
        $output .= $this->addmeta('viewport', 'width=device-width, initial-scale=1.0');
        $output .= $this->addmeta('description', 'THis is website for Abdelraood');
        $output .= $this->setBase();
        $output .= $this->addFavIcon();
        $output .= $this->setCSS();
        $output .= $this->callCDN();
        $output .= $this->setJS();
        $output .= $this->addscript();
        
        $output .= '</head><body>'
                . '<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, \'script\', \'facebook-jssdk\'));</script>';
        echo $output;
        $view = $this->getView();
        $pages = array('register', 'login', 'activate','reset','newpass');
        if(User::isLoggedIn()){
            $this->callTemplate();
//        $this->callTemplate();  // With Left sideBar
            }  elseif(in_array($view, $pages)) {
                require_once ( APP_PATH . $view . '.php');
            }
            else {
                 $this->callTemplate();
            }
        }
    
    private $template = array(
        'header.tpl',
        'lside.tpl',
        'content.tpl',
        'footer.tpl'
    );
//    private $template_1side = array(
//        'header.tpl',
//        'rside.tpl',
//        'content1.tpl',
//        'footer.tpl'
//    );

    private  $css = array(
        'bootstrap.css',
        'bootstrap-rtl.css',
        'jquery.bxslider.css',
        'style.css'
        );
    

    private  $js = array(
//        'jquery-1.10.1.min.js',
        'soundmanager2.js',
        'jquery.bxslider.min.js',
        'jquery.fitvids.js',
        'jquery.newsTicker.js',
        'html5lightbox.js',
        'html5gallery.js'
        );
    
    
    private $cdn = array (
        'http://code.jquery.com/jquery-1.10.2.js',
        'http://code.jquery.com/ui/1.10.4/jquery-ui.js',
    );
    
    
    public function setCSS(){
        $array = array();
        foreach ($this->css as $css){
            if(file_exists(CSS_DIR . $css)){
                $array[] = '<link type="text/css" href="'. CSS_PATH . $css .'" rel="stylesheet">';
            }
        }
        return implode('', $array);
    }
       
    public function setJS(){
        $array = array();
        foreach ($this->js as $js){
            if(file_exists(JS_DIR . $js)){
                $array[] = '<script type="text/javascript" src="'. JS_PATH . $js .'"></script>';
            }
        }
        return implode('', $array);
    }

    public function callCDN() {
        $array = array();
        foreach ($this->cdn as $cdn){
                $array[] = '<script type="text/javascript" src="'. $cdn .'"></script>';
        }
        return implode('', $array);
    }
    
    
    public function addmeta($name, $content){
        return '<meta name="'. $name .'" content="'. $content .'" />';
    }
    public function addscript(){
        return '
<script> 
(function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,\'script\',\'//www.google-analytics.com/analytics.js\',\'ga\');
ga(\'create\', \'UA-55832229-1\', \'auto\'); ga(\'send\', \'pageview\');
</script>
            

<script>

  $(function() {
    $( "#sortable" ).sortable({
    items  : "> tr",

});
  });

            $(function () {
                $("#accordion").accordion();

                $(\'.bxslider\').bxSlider({
                    mode: \'fade\',
                    auto: true,
                    captions: false,
                    pager: false,
                    responsive: true,
                    video: true
                });
                $(\'.monasba\').bxSlider({
                    mode: \'fade\',
                    auto: true,
                    pager: false,
                    responsive: true,
                    controls: false
                });
                $(\'.video\').bxSlider({
                      video: true
                });
                $(\'.gallary\').bxSlider({
                    mode: \'fade\',
                    pager: false,
                    infiniteLoop: false,
                    hideControlOnEnd: true,
                    adaptiveHeight: true,
                    responsive: true
                });

                $(\'.newsticker\').newsTicker({
                    max_rows: 4,
                    row_height: 65,
                    speed: 600,
                    direction: \'up\',
                    duration: 4000,
                    prevButton: $(\'#nt-prev\'),
                    nextButton: $(\'#nt-next\')
                });

                $(\'.newsticker1\').newsTicker({
                    max_rows: 4,
                    row_height: 65,
                    speed: 600,
                    direction: \'up\',
                    duration: 4000,
                    prevButton: $(\'#nt-prev1\'),
                    nextButton: $(\'#nt-next1\')
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                $(\'.videos\').bxSlider({
                    slideWidth: 5000,
                    minSlides: 4,
                    maxSlides: 5,
                    auto: true,
                    moveSlides: 3,
                    slideMargin: 10,
                    pager: false,
                    nextSelector: \'#slider-next\',
                    prevSelector: \'#slider-prev\',
                    responsive: true
                });
            });
        </script>
        <script>
            function tick() {
                $(\'#ticker li:first\').slideUp(function () {
                    $(this).appendTo($(\'#ticker\')).slideDown();
                });
            }
            setInterval(function () {
                tick()
            }, 5000);
        </script>
        </script>
<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() {
        new nicEditor({fullPanel : true}).panelInstance(\'nic\');
        
});
  //]]>
  </script> 
      <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : \'864317973588094\',
          xfbml      : true,
          version    : \'v2.1\'
        });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, \'script\', \'facebook-jssdk\'));
    </script>
    <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : \'864317973588094\',
      xfbml      : true,
      version    : \'v2.3\'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, \'script\', \'facebook-jssdk\'));
</script>

';
    }
    
    
    public function setTitle() {
                $option = Options::read("SELECT * FROM options WHERE id = 1",PDO::FETCH_CLASS, 'Options');
        return  '<title>' . $option->site_title . '</title>';
    }
    
    public function setEncoding($encoding = 'utf-8'){
        return '<meta charset="'. $encoding .'">';
    }
    
    public function addFavIcon() {
        return '<link rel="Shortcut Icon" href="favicon.ico" type="image/x-icon">'
        . '<link rel="Icon" href="favicon.ico" type="image/x-icon">';
    }
    
    
    public function setBase(){
        return '<base href="'. HOST_NAME .'">';
    }

        public function callTemplate() {
        foreach ($this->template as $template){
            if(file_exists(TEMPLATE_PATH . $template)){
                require_once (TEMPLATE_PATH . $template);
            }  else {
                echo '<!-- NO TEMPLATE WITH NAME '. $template .'      -->';
            }
        }
    }
//    public function callTemplateNoLeft() {
//        foreach ($this->template_1side as $template_1side){
//            if(file_exists(TEMPLATE_PATH . $template_1side)){
//                require_once (TEMPLATE_PATH . $template_1side);
//            }  else {
//                echo '<!-- NO TEMPLATE WITH NAME '. $template_1side .'      -->';
//            }
//        }
//    }
    
    public function getView(){
        $view = (isset($_GET['view'])) ? $_GET['view'] : 'index';
        return $view;
    }

    public function renderView() {
        $view = $this->getView();
        if(file_exists(VIEWS_PATH . $view . '.view.php')){
            require_once VIEWS_PATH . $view . '.view.php';
        }  else {
            require_once VIEWS_PATH . '404.view.php';
        }
    }

}