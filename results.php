<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Letters of Colenso</title>
<link href="css/boilerplate.css" rel="stylesheet" type="text/css">
<link href="css/styles.css" rel="stylesheet" type="text/css">

<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="js/respond.min.js"></script>
</head>
<body>
<div class="gridContainer clearfix">

<?php
include("baseX/BaseXClient.php");

try {
  // create session
  $session = new Session("localhost", 1984, "admin", "admin");
  
  try {
	$session->execute("OPEN Colenso");
	
	$reading = fopen("results/.dirs.dat", "r");
	while (!feof($reading)) {
	  $line = fgets($reading);
	  // create query instance	
	  $query = $session->query("doc ('".$line."')");
	  // print results
	  print $query->execute()."\n";
	  // close query instance
      $query->close();
	}
  } catch (Exception $e) {
    // print exception
    print $e->getMessage();
  }

  // close session
  $session->close();

} catch (Exception $e) {
  // print exception
  print $e->getMessage();
}
?>
</div>
</body>
</html>