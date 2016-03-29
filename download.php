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
<title>Letters of Colenso - Download</title>
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link href="css/nav-styles.css" rel="stylesheet" type="text/css">

<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="js/respond.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/nav-script.js"></script>
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
     <li class="active"><a href='#'>Download XML</a></li>
  </ul>
  </div>
  
  <div class="LayoutDiv">
	<?php
    if (file_exists("./results/.dirs.dat")) {
      //generate zip, use date and time as filename
      $format = "Y-m-d h-i-s-a";
      $file = date($format).".zip";
      
      //open directory file to xml
      $reading = fopen("./results/.dirs.dat", "r");
      //create new file
      $zip = new ZipArchive;
      $res = $zip->open($file, ZipArchive::CREATE | ZIPARCHIVE::OVERWRITE);
      if ($res === TRUE) {	//success
          while (!feof($reading)) {
            $line = preg_replace('/\s+/', '', fgets($reading)); //remove space at end of string
            if (!empty($line)) { //don't read empty lines
              $zip->addFile("./TEIBP/content/".basename($line), $line);
            }
          }
          //close handles
          fclose($reading);
          $zip->close();
          
          //allow user to download file
          //do not display in the browser
          header('Content-Description: File Transfer');
          //file is a binary file
          header('Content-Type: application/octet-stream');
          //make the download dialog show the proper file name
          header('Content-Disposition: attachment; filename='.basename($file));
          
          header('Content-Transfer-Encoding: binary');
          //not cached
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          //send file size to browser
          header('Content-Length: ' . filesize($file));
          //send headers to browser before download starts
          ob_clean();
          flush();
          //send file to browser
          readfile($file);
          //delete from server
          unlink($file);
          //close window/tab
          exit;
      }
    }
    ?>
  </div>

</div>
</body>
</html>