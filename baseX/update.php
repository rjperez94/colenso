<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="../favicon.ico"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Letters of Colenso - Update</title>
<link href="../css/boilerplate.css" rel="stylesheet" type="text/css">
<link href="../css/styles.css" rel="stylesheet" type="text/css">
<link href="../css/nav-styles.css" rel="stylesheet" type="text/css">

<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="../js/respond.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/nav-script.js"></script>
</head>
<body>
<div class="gridContainer clearfix">
    <div id='cssmenu'>
    <ul>
       <li><a href='../index.php'>Home</a></li>
       <li><a href='../index.php#about'>About</a></li>
       <li><a href='../index.php#add'>Add Letter</a></li>
       <li><a href='../TEIBP/content/.index.php'>View Letters</a></li>
       <li><a href='../index.php#logical'>Logical Search</a></li>
       <li><a href='../index.php#xquery'>xQuery Search</a></li>
       <li class="active"><a href='#'>Update Result</a></li>
    </ul>
    </div>

<?php
include("BaseXClient.php");
$fileName = basename($_GET['target']);

file_put_contents($fileName, $_POST['text']);

try {
  // create session
  $session = new Session("localhost", 1984, "admin", "admin");
  $query = $session->query("validate:xsd('".$fileName."', 'http://www.tei-c.org/ns/1.0')");
  if ($query->info() == "") {
	  $session->execute("OPEN Colenso");
	  
	  //baseX scripts files dir
	  $baseXDir = realpath(dirname('self')."/");
	  $baseXDir = str_replace(DIRECTORY_SEPARATOR, "/", $baseXDir)."/";
	  //where to put files
	  $targetDir = "../TEIBP/content/";
	  $session->execute("REPLACE /".$_GET['target']." ".$baseXDir.$fileName);
	  
	  rename($fileName, $targetDir.$fileName);
	  
	  print "Update of ".$_GET['target']." successful";
	  $session->execute("CREATE INDEX FULLTEXT");
	  $session->execute("OPTIMIZE");
	  
	  sleep(3);
  } else {
  	unlink($fileName);
	print "This page will go back to home page automatically in the next 10 seconds";
	sleep(10);
  }
  // close session
  $session->close();
  
  $url='http://localhost/colenso/';
  print '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
} catch (Exception $e) {
  // print exception
  print $e->getMessage();
}
?>
</div>
</body>
</html>