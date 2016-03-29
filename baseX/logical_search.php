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
<title>Letters of Colenso - Logical Search</title>
<link href="../css/styles.css" rel="stylesheet" type="text/css">
<link href="../css/nav-styles.css" rel="stylesheet" type="text/css">
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="../js/respond.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/nav-script.js"></script>
<script>
function noResult($string ) {
    alert($string);
}
</script>
</head>
<body>
<div class="gridContainer clearfix">
    <div id='cssmenu'>
    <ul>
       <li><a href='../index.php'>Home</a></li>
       <li><a href='../index.php#about'>About</a></li>
       <li><a href='../index.php#add'>Add Letter</a></li>
       <li><a href='../TEIBP/content/.index.php'>View Letters</a></li>
       <li class="active"><a href='../index.php#logical'>Logical Search</a></li>
       <li><a href='../index.php#xquery'>xQuery Search</a></li>
    </ul>
    </div>
    
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
	if (file_exists("../results/.dirs.dat") && basename($_SERVER['HTTP_REFERER']) !== "results.php") {
		unlink("../results/.dirs.dat");
	}
	$session->execute("OPEN Colenso");
	//clear folder
	$files = glob("../results/*"); // get all file names
	foreach($files as $file){ // iterate files
		if(is_file($file)) {
			unlink($file); // delete file
		}
	}
	
    $input = filter_input(INPUT_GET,"logical",FILTER_SANITIZE_STRING);
	$range = $_GET["range1"];
	$lower = intval($_GET["lower"]);
	$upper = intval($_GET["upper"]);
	if ($lower > $upper ) {
		$query = "";
		print '<script type="text/javascript"> noResult("Illegal results range") </script>';
		$url='http://localhost/colenso/';
  		print '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
	} else {
	  //  create query instance
	  $query = $session->query("ft:search('Colenso','".$input."')");
	  
	  // loop through all results
	  $i = 0;
	  $iter = 0;
	  while($query->more()) {
		$iter++;
		if ((strcmp($range, "custom1") == 0 && ($iter < $lower || $iter > $upper))) {
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
	  
	  if (file_exists("../results/.dirs.dat") && basename($_SERVER['HTTP_REFERER']) === "results.php") {
		copy("../results/.dirs.dat", ".dirs.dat");
	  } 
	  if (file_exists(".dirs.dat") && basename($_SERVER['HTTP_REFERER']) !== "results.php") {
	  	unlink(".dirs.dat");
	  }
	  	
	  
	}
  } catch (Exception $e) {
    // print exception
    print $e->getMessage();
  }
  
  //makes origins file and redirect to results page
  if (count(glob("../results/*")) > 0) {
	fopen("../results/.dirs.dat", "w") or die("Unable to open file!");
	
	$loc = 'declare namespace tei="http://www.tei-c.org/ns/1.0"; for $i in (ft:search("Colenso","'.$input.'")) return db:path($i)';
    $locQuery = $session->query($loc);
	
	// loop through all results and write origins to file
	$i = 0;
	$iter = 0;
	while($locQuery->more()) {
	  $iter++;
	  if ((strcmp($range, "custom1") == 0 && ($iter < $lower || $iter > $upper))) {
		  //skip
		$locQuery->next();
	  } else {
		file_put_contents("../results/.dirs.dat", $locQuery->next()."\n", FILE_APPEND | LOCK_EX);
	  }
	  
	  
	}
	$locQuery->info();
	// close query instance
	$locQuery->close();
	
	// close session
    $session->close();
	
  	$url='http://localhost/colenso/results.php';
  	echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
  } else if ($query === "") {	//redirect to home page
  	// close session
    $session->close();
	
	$url='http://localhost/colenso/';
  	print '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
  } else {	//redirect to home page
  	// close session
    $session->close();
  	
	print '<script type="text/javascript"> noResult("Your search did not match any letters") </script>';
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