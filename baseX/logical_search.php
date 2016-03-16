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
<link href="../css/boilerplate.css" rel="stylesheet" type="text/css">
<link href="../css/styles.css" rel="stylesheet" type="text/css">
<link href="../css/dark.css" rel="stylesheet" type="text/css">
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="../js/respond.min.js"></script>
<script src="../js/highlight.pack.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
<script>
function noResult() {
    alert("Your search did not match any letters");
}
</script>
</head>
<body>
<div class="gridContainer clearfix">

<?php
/*
 *
 * (C) BaseX Team 2005-12, BSD License
 */
include("BaseXClient.php");
try {
  // create session
  $session = new Session("localhost", 1984, "admin", "admin");
  
  try {
	$session->execute("OPEN Colenso");
    // create query instance
    $input = filter_input(INPUT_GET,"logical",FILTER_SANITIZE_STRING);
	//  create query instance
    $result = $session->execute("FIND ".$input);
	
    // print all results
	if ($result === "" || strcmp ($result , "Stopped at , 1/5: Syntax: FIND [keywords] Run a keyword query. Finds keywords in a database.") === "") {
		print '<script type="text/javascript"> noResult() </script>';
		$url='http://localhost/colenso/';
  		print '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
	}
	print '<div id="LayoutDiv">';
	print $result."\n";
	print '</div>';
	/*$i = 0;
	$arr = explode("<p xmlns='http://www.tei-c.org/ns/1.0'>", $result);
	foreach ($arr as &$value) {
    	//put it one in a xml file
	  	$myfile = fopen("../results/search".($i+=1).".xml", "w") or die("Unable to open file!");
	  	fwrite($myfile, "<p xmlns='http://www.tei-c.org/ns/1.0'>".$value);
	  	fclose($myfile);
	}*/
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