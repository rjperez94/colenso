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
<title>Letters of Colenso - Search Results</title>
<link href="css/boilerplate.css" rel="stylesheet" type="text/css">
<link href="css/styles.css" rel="stylesheet" type="text/css">

<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="js/jquery.min.js"></script>
<script src="js/respond.min.js"></script>
<script type='text/javascript'>
// <![CDATA[
jQuery(document).ready(function(){
$('input:radio[name="range1"]').change(
    function(){
        if ($(this).is(':checked') && $(this).val() == 'custom1') {
             $('div.options1').show();
        } else {
			$('div.options1').hide();
		}
    }).change();
});
// ]]>
</script>
<script type='text/javascript'>
// <![CDATA[
jQuery(document).ready(function(){
$('input:radio[name="range2"]').change(
    function(){
        if ($(this).is(':checked') && $(this).val() == 'custom2') {
             $('div.options2').show();
        } else {
			$('div.options2').hide();
		}
    }).change();
});
// ]]>
</script>
</head>
<body>
<div class="gridContainer clearfix">

<div class="LayoutDiv">
  <h1>Filter using Logical Operators</h1>
  <form method ="get" action="baseX/logical_search.php">
  Logical Search: <input type="search" name="logical" placeholder="Seach letters using text strings">
  <input type="submit"> <br>
  <input type="radio" checked = "checked" name="range1" value="all"> Show all results
  <input type="radio" name="range1" value="custom1"> Select range
  
  <div class = "options1">
  <input type="number" name="lower" placeholder="From result"/>
  <input type="number" name="upper" placeholder="To result"/>
  </div>
  
	</form>
  </div>
    
  <div class="LayoutDiv">
  <h1>Filter using xQuery</h1>
    <form method ="get" action="baseX/markup_search.php">
  Markup Search: <input type="search" name="xquery" placeholder="Seach letters using xQuery">
  <input type="submit"> <br>
  <input type="radio" checked = "checked" name="range2" value="all"> Show all results
  <input type="radio" name="range2" value="custom2"> Select range
  
  <div class = "options2">
  <input type="number" name="lower" placeholder="From result"/>
  <input type="number" name="upper" placeholder="To result"/>
  </div>
  
	</form>
</div>

<div class="LayoutDiv">
<h1>Search Results</h1>
<h3>Right-Click/Long-Tap FileName --> Save Link As to save individual files</h3>
<h3>To save ALL files that matched this search, click <a href="download.php" title="Download all files" target="_blank">here</a> to download as ZIP</h3>
</div>

<?php
include("baseX/BaseXClient.php");

try {
  // create session
  $session = new Session("localhost", 1984, "admin", "admin");
  
  try {
	$reading = fopen("results/.dirs.dat", "r");
	$contentDir = "TEIBP/content/";
	$i = 0;
	while (!feof($reading)) {
	  $i++;
	  $line = fgets($reading);
	  $name = basename($line);
	  if ($name != "") {
		  if(basename($_SERVER['HTTP_REFERER']) !== "results.php" || (exec('grep '.escapeshellarg($line).'baseX/.dirs.dat') && basename($_SERVER['HTTP_REFERER']) === "results.php")) {
			print "<div class='LayoutDiv'>";
			print "<h2>Result from <a href='".($contentDir.$name)."'>".$name."</a></h2> <h3>[<a href='edit.php?name=".$name."'>Edit $name</a>]</h3>";
			$file = file_get_contents('results/search'.$i.'.xml');
			print $file;
			print "</div>";
		  } else {
		  	unlink('results/search'.$i.'.xml');
		  }
		  
		}
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