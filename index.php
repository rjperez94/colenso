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
<link href="css/boilerplate.css" rel="stylesheet" type="text/css">
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link href="css/nav-styles.css" rel="stylesheet" type="text/css">

<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="js/respond.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/nav-script.js"></script>
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
  <nav class="fixed-nav-bar">
    <div id='cssmenu'>
    <ul>
       <li class='active'><a href='index.php'>Home</a></li>
       <li><a href='#about'>About</a></li>
       <li><a href='#add'>Add Letter</a></li>
       <li><a href='#browse'>View Letters</a></li>
       <li><a href='#logical'>Logical Search</a></li>
       <li><a href='#xquery'>xQuery Search</a></li>
    </ul>
    </div>
  </nav>

  <div class="LayoutDiv">
  <h1 id = "about">About This Page</h1>
	<p>The <a title="View details of the Colenso Society" href="/about-william-colenso/the-colenso-society/#Colenso Society" target="_blank">Colenso Society</a>, <a title="Go to Victoria University of Wellington website" href="http://www.victoria.ac.nz/wtapress/" target="_blank">Victoria University of Wellington </a>and <a title="View Hawke's Bay Musuem &amp; Art Gallery website" href="http://www.hbmag.co.nz/" target="_blank">MTG Hawke's Bay </a>are delighted to announce the establishment of the Colenso Project. This exciting new initiative seeks to build on the blossoming national and international interest in William Colenso’s life and ideas as the result of the William Colenso Bicentenary Celebrations in Hawke’s Bay in 2011, and a body of new publications and research.</p>
<p>The intent of the Project is to ignite public and academic interest in Colenso’s words – published, unpublished, private letters, journals - both in Maori and English, by sharing them with the world in digital form. We envisage a hub for all things Colenso: a place to read documents in the original, explore his writing through transcriptions, and as a place to experiment with new research and interpretation methods.</p>
<p>The first priority for the Project is the creation of a comprehensive bibliography of all William Colenso holdings. This is currently being compiled and is now available on <a title="View bibliography" href="/the-colenso-project/william-colenso-bibliography/#Bibliography page">bibliography</a> page. Bringing our collective knowledge to bear on Colenso material, wherever it lies, will determine the strength of this <a title="View bibliography" href="/the-colenso-project/william-colenso-bibliography/#Bibliography page">bibliography</a>, and to this end contributions and information are welcomed from individuals and institutions.</p>
  </div>
  
  <div class="LayoutDiv">
  <h1 id = "add">Add New Letter</h1>
  <form action="baseX/upload.php" method="post" enctype="multipart/form-data">
  Select a file: <input name="upload[]" type="file" multiple ="multiple">
  <input type="submit">
</form>
  </div>
  
  <div class="LayoutDiv">
  <h1 id = "browse">The Letters Database</h1>
    <p>To view all the letters, click <a href="TEIBP/content/.index.php" target="_blank">here</a></p>
    </div>
    
  <div class="LayoutDiv">
  <h1 id = "logical">Search using Logical Operators</h1>
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
  <h1 id = "xquery">Search using xQuery</h1>
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

</div>
</body>
</html>