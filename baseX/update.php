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