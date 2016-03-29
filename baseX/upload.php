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
<title>Letters of Colenso - Upload</title>
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
       <li class="active"><a href='../index.php#add'>Add Letter</a></li>
       <li><a href='../TEIBP/content/.index.php'>View Letters</a></li>
       <li><a href='../index.php#logical'>Logical Search</a></li>
       <li><a href='../index.php#xquery'>xQuery Search</a></li>
    </ul>
    </div>
<?php
/*
 * (C) BaseX Team 2005-12, BSD License
 *
 */
include("BaseXClient.php");
try {
  //Colenso website files dir
  $siteDir = realpath("../TEIBP/content/");
  $siteDir = str_replace(DIRECTORY_SEPARATOR, "/", $siteDir."/");
  // create session
  $session = new Session("localhost", 1984, "admin", "admin");
  //open db
  $session->execute("OPEN Colenso");
  
  //number of files  
  $total = count($_FILES['upload']['name']);
  
  //where to put files
  $targetDir = "../TEIBP/content/";
  
  $noUpload= 0;	//if entry not file noUpload++
  //go through each file
  for($i=0; $i<$total; $i++) {
	  print '<div id="LayoutDiv">';
	  //origin name
	  $fileName = basename($_FILES['upload']['name'][$i]); 
	  if ($fileName === "") {
	  	$noUpload++;
	  }
	  //original location
	  $originPath = $_FILES['upload']['tmp_name'][$i];
	  //new location
	  $targetPath = $targetDir . $fileName; 
	  //file extension
	  $fileType = pathinfo($targetPath,PATHINFO_EXTENSION);
	  
	  $err = 0;
	  //check file duplicate
	  if (file_exists($targetPath) && $noUpload == 0) {
		  $err++;
		  print "Sorry, ".$targetPath." already exists.\n";
	  }
	  //check file ext
	  if ($fileType != "xml" && $noUpload == 0) {
		  $err++;
		  echo "Sorry, ". $fileName ." is not in XML format.\n";
	  }
	  
	  if ($err == 0) {		//no errors
	  	//move file
		if (move_uploaded_file($originPath, $targetPath)) {
		  //edit file for styling
		  $reading = fopen($targetPath, "r");
		  $writing = fopen($targetPath.".tmp", 'w');
		  
		  $lineNum = 0;
		  //recopy to tmp but...
		  while (!feof($reading)) {
			$lineNum++;
			$line = fgets($reading);
			//append stylesheet in line 2 of file
			if ($lineNum == 2) {
			  $line = "<?xml-stylesheet type='text/xsl' href='teibp.xsl'?>\n".$line;
			}
			fputs($writing, $line);
		  }
		  fclose($reading); 
		  fclose($writing);
		  //replace with termporary copy
		  rename($targetPath.".tmp", $targetPath);
		  
		  //add file to database
		  $session->execute("ADD ".$siteDir.$fileName);
  		  print $session->info();
		  
		  //optimize
		  $session->execute("CREATE INDEX FULLTEXT");
	  	  $session->execute("OPTIMIZE");
		  
		  echo "The file ". $fileName. " has been added to the database.";
		} else {
		  echo "Sorry, there was an error adding your file to the database.";
		}
	  }
	
	  print '</div>';
  }
  
  // check for file upload
  if ($noUpload > 0) {
  	print "Sorry, you have not selected any file";
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