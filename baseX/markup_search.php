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
	
	//clear folder
	$files = glob("../results/*"); // get all file names
	foreach($files as $file){ // iterate files
		if(is_file($file)) {
			unlink($file); // delete file
		}
	}
	
    // create query instance
    $input = $_GET["xquery"];
	$range = $_GET["range"];
	$lower = intval($_GET["lower"]);
	$upper = intval($_GET["upper"]);
	if ($lower > $upper ) {
		print '<script type="text/javascript"> 
		function noResult() {
    		alert("Illegal results range");
		} </script>';
		$url='http://localhost/colenso/';
  		print '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
	}
	
	$query = $session->query("declare namespace tei= 'http://www.tei-c.org/ns/1.0'; ".$input);
		
    // loop through all results
	$i = 0;
	$iter = 0;
    while($query->more()) {
	  $iter++;
	  if ((strcmp($range, "custom") == 0 && ($iter < $lower || $iter > $upper))) {
		  //skip
		$query->next();
	  } else {
		//put it one in a xml file
	  	$myfile = fopen("../results/search".($i+=1).".xml", "w") or die("Unable to open file!");
	  	fwrite($myfile, $query->next());
	  	fclose($myfile);
	  }
	  
	  
    }
	$query->info();
    // close query instance
    $query->close();
  } catch (Exception $e) {
    // print exception
    print $e->getMessage();
  }
  // close session
  $session->close();
  
  //redirect to results page
  if (count(glob("../results/*")) > 0 ) {
  	$url='http://localhost/colenso/results.php';
  	echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
  } else {	//redirect to home page
  	print '<script type="text/javascript"> noResult() </script>';
	$url='http://localhost/colenso/';
  	print '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
  }
} catch (Exception $e) {
  // print exception
  print $e->getMessage();
}
?>

</div>

</body>
</html>