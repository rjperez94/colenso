<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="favicon.ico"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Letters of Colenso - Edit XML</title>
<link href="css/boilerplate.css" rel="stylesheet" type="text/css">
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link href="css/nav-styles.css" rel="stylesheet" type="text/css">
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="js/respond.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/nav-script.js"></script>
<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
<script>
  $(document).ready(function () {
    $('#ta').keyup(function(){
      $('#target').html('<code class="prettyprint">'+$(this).val()+'</code>');
    });
  });
</script>

</head>
<body>
<div class="gridContainer clearfix">
	<div id='cssmenu'>
    <ul>
       <li><a href='index.php'>Home</a></li>
       <li><a href='index.php#about'>About</a></li>
       <li><a href='index.php#add'>Add Letter</a></li>
       <li><a href='TEIBP/content/.index.php'>View Letters</a></li>
       <li><a href='index.php#logical'>Logical Search</a></li>
       <li><a href='index.php#xquery'>xQuery Search</a></li>
       <li class="active"><a href='#'>Edit XML</a></li>
    </ul>
    </div>
    
    <?php
	include("baseX/BaseXClient.php");
	$name = $_GET["name"];
	//file extension
	$fileType = pathinfo($name,PATHINFO_EXTENSION);
	//check file ext
	if ($fileType != "xml") {
		echo "Sorry, ". $name ." is not in XML format.\n";
	} else {
		try {
		  // create session
		  $session = new Session("localhost", 1984, "admin", "admin");
		  try {
			$path = $session->execute('XQUERY for $doc in collection("Colenso") where matches(document-uri($doc), "'.$name.'") return db:path($doc)');
		  } catch (Exception $e) {
			print $e->getMessage();
		  }
		  // close session
		  $session->close();
		
		}catch (Exception $e) {
		  // print exception
		  print $e->getMessage();
		}
		
		print "<div class='LayoutDiv'>";
		print 
		"<h1>Edit ".$name."</h1>"
		."<form method ='post' action='baseX/update.php?&target=".$path."'>"
		."<textarea style='width:100%; height:100%;' name='text' id='ta'>".file_get_contents('TEIBP/content/'.$name)."</textarea><br>"
		."<input type='submit'>"
		."</form>";
		print "</div>";
		
		print "<div class='LayoutDiv'>
		<h1>Preview Text (Without Tags)</h1>
		<div id='target'></div>
		</div>";
	}
	?>
</div>

<body>
</body>
</html>