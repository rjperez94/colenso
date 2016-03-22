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