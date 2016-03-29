<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="../../favicon.ico"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Colenso XMLs</title>
<link href="../../css/boilerplate.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href=".style.css">
<link href="../../css/nav-styles.css" rel="stylesheet" type="text/css">
<script src=".sorttable.js"></script>
<script src="../../js/respond.min.js"></script>
<script src="../../js/jquery.min.js"></script>
<script src="../../js/nav-script.js"></script>
</head>

<body>
<div class="gridContainer clearfix">
    <div id='cssmenu'>
    <ul>
       <li><a href='../../index.php'>Home</a></li>
       <li><a href='../../index.php#about'>About</a></li>
       <li><a href='../../index.php#add'>Add Letter</a></li>
       <li class="active"><a href='#'>View Letters</a></li>
       <li><a href='../../index.php#logical'>Logical Search</a></li>
       <li><a href='../../index.php#xquery'>xQuery Search</a></li>
    </ul>
    </div>
    
    
      <h1>Colenso XMLs</h1>
  
      <table class="sortable">
          <thead>
          <tr>
              <th>Filename</th>
              <th>Type</th>
              <th>Size</th>
              <th>Date Modified</th>
              <th>Edit File</th>
          </tr>
          </thead>
          <tbody><?php
  
      // Adds pretty filesizes
      function pretty_filesize($file) {
          $size=filesize($file);
          if($size<1024){$size=$size." Bytes";}
          elseif(($size<1048576)&&($size>1023)){$size=round($size/1024, 1)." KB";}
          elseif(($size<1073741824)&&($size>1048575)){$size=round($size/1048576, 1)." MB";}
          else{$size=round($size/1073741824, 1)." GB";}
          return $size;
      }
  
       //hide files starting with .
       $hide=".";
       $ahref="./?hidden";
       $atext="Show";
  
       // Opens directory
       $myDirectory=opendir(".");
  
      // Gets each entry
      while($entryName=readdir($myDirectory)) {
         $dirArray[]=$entryName;
      }
  
      // Closes directory
      closedir($myDirectory);
  
      // Counts elements in array
      $indexCount=count($dirArray);
  
      // Sorts files
      sort($dirArray);
  
      // Loops through the array of files
      for($index=0; $index < $indexCount; $index++) {
  
      // Decides if hidden files should be displayed, based on query above.
          if(substr("$dirArray[$index]", 0, 1)!=$hide) {
  
      // Resets Variables
          $favicon="";
          $class="file";
  
      // Gets File Names
          $name=$dirArray[$index];
          $namehref=$dirArray[$index];
  
      // Gets Date Modified
          $modtime=date("M j Y g:i A", filemtime($dirArray[$index]));
          $timekey=date("YmdHis", filemtime($dirArray[$index]));
  
  
      // Separates directories, and performs operations on those directories
          if(is_dir($dirArray[$index]))
          {
                  $extn="&lt;Directory&gt;";
                  $size="&lt;Directory&gt;";
                  $sizekey="0";
                  $class="dir";
  
              // Gets favicon.ico, and displays it, only if it exists.
                  if(file_exists("$namehref/favicon.ico"))
                      {
                          $favicon=" style='background-image:url($namehref/favicon.ico);'";
                          $extn="&lt;Website&gt;";
                      }
  
              // Cleans up . and .. directories
                  if($name=="."){$name=". (Current Directory)"; $extn="&lt;System Dir&gt;"; $favicon=" style='background-image:url($namehref/.favicon.ico);'";}
                  if($name==".."){$name=".. (Parent Directory)"; $extn="&lt;System Dir&gt;";}
          }
  
      // File-only operations
          else{
              // Gets file extension
              $extn=pathinfo($dirArray[$index], PATHINFO_EXTENSION);
  
              // Prettifies file type
              switch ($extn){
  
                  case "txt": $extn="Text File"; break;
                  case "log": $extn="Log File"; break;
                  case "htm": $extn="HTML File"; break;
                  case "html": $extn="HTML File"; break;
                  case "php": $extn="PHP Script"; break;
                  case "js": $extn="Javascript File"; break;
                  case "css": $extn="Stylesheet"; break;
  
                  case "zip": $extn="ZIP Archive"; break;
                  case "htaccess": $extn="Apache Config File"; break;
  
                  default: if($extn!=""){$extn=strtoupper($extn)." File";} else{$extn="Unknown";} break;
              }
  
              // Gets and cleans up file size
                  $size=pretty_filesize($dirArray[$index]);
                  $sizekey=filesize($dirArray[$index]);
          }
  
      // Output
       print("
	   <div class='LayoutDiv'>
          <tr class='$class'>
              <td><a href='./$namehref'$favicon class='name'>$name</a></td>
              <td><a href='./$namehref'>$extn</a></td>
              <td sorttable_customkey='$sizekey'><a href='./$namehref'>$size</a></td>
              <td sorttable_customkey='$timekey'><a href='./$namehref'>$modtime</a></td>
              
              <td><a href='../../edit.php?name=$name'>Edit</a></td>
          </tr>
		  </div>");
         }
      }
      ?>
  
          </tbody>
      </table>
</div>
</body>
</html>
