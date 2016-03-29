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
  <div id='cssmenu'>
  <ul>
     <li><a href='index.php'>Home</a></li>
     <li><a href='#about'>About</a></li>
     <li><a href='#add'>Add Letter</a></li>
     <li><a href='TEIBP/content/.index.php'>View Letters</a></li>
     <li><a href='#logical'>Logical Search</a></li>
     <li><a href='#xquery'>xQuery Search</a></li>
  </ul>
  </div>
  
  <div class="LayoutDiv">
  <h1>Who is William Colenso?</h1>
  <p><img src="img/CocNewZ020a.jpg" alt="william colenso" width="209" height="290"></p>

  <h2>William Colenso (1811-1899) arrived at the Bay of Islands as the Church Mission printer in December 1834. Among his notable printing achievements were the <a href="http://www.nzhistory.net.nz/node/3716">Declaration of Independence of New Zealand</a> (printed in 1836), a complete New Testament in Māori (1838) and Hobson’s proclamations and the <a href="http://www.nzhistory.net.nz//node/2641">Treaty of Waitangi in Māori</a> (all in 1840).</h2>
  
  <p>He was present at the 6 February signing and many years later published his eyewitness account of the event as <em><span class="italic">The authentic and genuine history of the signing of the Treaty of Waitangi</span></em> (1890), the best account of the event, drawn from his notes made at the time. He also acted as a part-time translator for the officials and printed not only the proclamations of sovereignty in May 1840 but also the first Government <em>Gazette</em>.</p><p>He had long wanted to be ordained and was ordained as a deacon in 1844, before being sent to Ahuriri (Napier). But his career was ruined when his extramarital affair with a Māori female servant in 1852 resulted in the birth of a child. A notable traveller and botanist, he also went into politics as the Member for Napier and outlived most of his contemporaries. At the end of his life, in 1894, he was readmitted to the Anglican clergy.</p>
  
  <p><em>Adapted from the DNZB biography by David Mackay</em>. You can <a href="http://www.teara.govt.nz/en/biographies/1c23/1">read the full biography in Te Ara Biographies</a></p>
  <p>Source: <a href="http://www.nzhistory.net.nz" target="_blank">New Zealand History</a></p>
  </div>

  <div class="LayoutDiv">
  <h1 id = "about">About This Page</h1>
	<p>The <a title="View details of the Colenso Society" href="http://www.williamcolenso.co.nz/about-william-colenso/the-colenso-society/#Colenso Society" target="_blank">Colenso Society</a>, <a title="Go to Victoria University of Wellington website" href="http://www.victoria.ac.nz/wtapress/" target="_blank">Victoria University of Wellington </a>and <a title="View Hawke's Bay Musuem &amp; Art Gallery website" href="http://www.hbmag.co.nz/" target="_blank">MTG Hawke's Bay </a>are delighted to announce the establishment of the Colenso Project. This exciting new initiative seeks to build on the blossoming national and international interest in William Colenso’s life and ideas as the result of the William Colenso Bicentenary Celebrations in Hawke’s Bay in 2011, and a body of new publications and research.</p>
<p>The intent of the Project is to ignite public and academic interest in Colenso’s words – published, unpublished, private letters, journals - both in Maori and English, by sharing them with the world in digital form. We envisage a hub for all things Colenso: a place to read documents in the original, explore his writing through transcriptions, and as a place to experiment with new research and interpretation methods.</p>
<p>The first priority for the Project is the creation of a comprehensive bibliography of all William Colenso holdings. This is currently being compiled and is now available on <a title="View bibliography" href="http://www.williamcolenso.co.nz/the-colenso-project/william-colenso-bibliography/#Bibliography page">bibliography</a> page. Bringing our collective knowledge to bear on Colenso material, wherever it lies, will determine the strength of this <a title="View bibliography" href="http://www.williamcolenso.co.nz/the-colenso-project/william-colenso-bibliography/#Bibliography page">bibliography</a>, and to this end contributions and information are welcomed from individuals and institutions.</p>
<p>Source: <a href="http://www.williamcolenso.co.nz/" target="_blank">The Colenso Project</a></p>
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