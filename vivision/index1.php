
<?php 
	// $location="./";
	$location="../../htdocs/"; 
	require_once($location."vendor/autoload.php");
	require("parser.php");
// echo parcegoogledoc("wfp/WFP.html",array(
echo parsegooglehttp("https://docs.google.com/document/d/e/2PACX-1vSAox75sL1yTcN4gbYaycpQmS5McJ63H0wgvMc-c5I8qo_HSk15tUJrkLwM2FaLG3Yq6Wa4vHWKqDxz/pub",array(
'"><img alt="" src="images/image3.png"' => ' float:left;"><img alt="" src="$addpathimages/image3.png"',
'"><img alt="" src="images/image2.png" style="' => ' width: 100% !important; height: auto !important;"><img alt="" src="$addpathimages/image2.png" style="width: 100% !important; height: auto !important; ',
'"><img alt="" src="images/image1.png" style="' => ' width: 100% !important; height: auto !important;"><img alt="" src="$addpathimages/image1.png" style="width: 100% !important; height: auto !important; ',
'&lt;t video1&gt;' => '<div class="video-container"><iframe style="width:100%; "    src="https://www.youtube.com/embed/_EygIwvFI0Y" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>',
),"wfp/");     
?>
