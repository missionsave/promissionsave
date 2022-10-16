
<?php //Global vars
	// header('Location: youtube://blahblahblah');
	// $site="vivision.org";
	// $site="www.".$site;
	// $site="https://".$site;
	$site="https://".$_SERVER['SERVER_NAME'];
	$location="";
	$location="../../htdocs/";  
	// $location="/home/vol11_7/epizy.com/epiz_29317381/htdocs/";  
	// $location="../../../../../vol11_7/epizy.com/epiz_29317381/htdocs/";  
	$id=0;
	$name="nome";
	$email="email";
	$lat=39.3273571;
	$long=-8.937850;
	$balance=10;
	
	$composer ='vendor/autoload.php';
	
	// echo $location;
	$lang=1;
	// require_once($location."connect.php");
	// require_once("dict.php");
	function d($val){return $val;}
	// require_once("token.php");
	// require_once($location."vendor/autoload.php");
	require_once($location."vendor/autoload.php");
	// require_once("google_login.php");
	// require_once("facebook_login.php");
	require_once("parser.php");
	// $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	// echo $url;
	// echo $_SERVER['SERVER_NAME'];
	// echo $site;
	// return;
?>
<!DOCTYPE html>
<html  >
<meta http-equiv="cache-control" content="no-cache, must-revalidate, post-check=0, pre-check=0" />
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<link rel="shortcut icon" href="-logo.png?1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta charset="UTF-8">
<title>Fxwin Promissionsave</title>

<link rel="manifest" href="manifest.webmanifest">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="https://accounts.google.com/gsi/client"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<head>
	 
</head>
<body>
<div style="box-shadow: 0 0 0.5cm rgba(0,0,0,0.1);  margin: auto; left: 0; right: 0; max-width: 690px; position: absolute; overflow-x:hidden; padding:0; left:0px; top:55px;  width: 100%;   background-color:white;   ">
<?php 
// require("fxwin.html");   
echo parcegoogledoc("fxwin.html",array(
'"><img alt="" src="images/image3.png"' => ' float:right;"><img alt="" src="$addpathimages/image3.png?1"',
'"><img alt="" src="images/image2.png" style="' => '  padding-top:20px;"><img alt="" src="$addpathimages/image2.png?1" style="width: 100% !important; height: auto !important; ',
'"><img alt="" src="images/image1.png" style="' => ' width: 130px !important; height: auto !important;"><img alt="" src="$addpathimages/image1.png?1" style="width: 100% !important; height: auto !important; ',
'&lt;t video1&gt;' => '<div class="video-container"><iframe style="width:100%; "    src="https://www.youtube.com/embed/_EygIwvFI0Y" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>',
'&lt;passo1&gt;' => '<div id="id1">
	1º passo
	Instale a nossa app
<div id="btnAdd" style="text-align: center; margin:auto;  box-sizing: border-box; cursor: pointer; border-radius: 4px;  max-width: 35px; max-height: 35px;  " >
			<img src="install-software-download.png" style="height: auto; width: auto; max-width: 35px; max-height: 35px;" >
		</div>

</div>',
),"./");
?>

<script>
 // https://developer.mozilla.org/en-US/docs/Web/API/Window/onbeforeinstallprompt
 // https://stackoverflow.com/questions/50762626/pwa-beforeinstallprompt-not-called
 // https://mdn.github.io/pwa-examples/a2hs/
 // https://www.simicart.com/blog/pwa-app-stores/
 
 function pos_install(){
 Swal.fire("App instalada no ambiente de trabalho. Por favor confirme.");
 // https://stackoverflow.com/questions/11773958/open-android-application-from-a-web-page
 window.location = "FX.Promissionsave://fx.promissionsave/";
 
 window.setTimeout(function() {
	// window.location.replace("chrome-extension://com.fx.promissionsave.android/index.php"); 
                    }, 250);
	
}
// pos_install();

 var addBtn=document.getElementById("btnAdd");
 if ('serviceWorker' in navigator) {
  navigator.serviceWorker
    .register('/sw.js')
    .then(() => { console.log('Service Worker Registered'); });
}
let deferredPrompt;
 
 //ve se está instalado
(async function () {
	const relatedApps = await navigator.getInstalledRelatedApps();
	// alert(relatedApps);
	// console.log(relatedApps);
	relatedApps.forEach((app) => {
		// alert(app.id,app.name);
		// console.log(app.id, app.platform, app.url);
		addBtn.style.display = 'none';
	});
})(); 
// if (window.matchMedia('(display-mode: standalone)').matches) {
	// addBtn.style.display = 'none';
// } 
var listener = function (event) {
	
// window.open("googlechrome://navigate?url=https://fx.promissionsave.com");
// window.location="googlechrome://navigate?url=fx.promissionsave.com";
// window.location="https://fx.promissionsave.com?install=1";

// window.location="intent:https://fx.promissionsave.com#Intent;end";

// https://stephenradford.me/link-to-url-scheme-or-not-and-force-out-of-the-app-youre-in/
	if( /Android|iPhone|iPad|iPod/i.test(navigator.userAgent) ) {
		window.location="intent:googlechrome://navigate?url=fx.promissionsave.com?i=1#Intent;end";
	} else {
		Swal.fire("De momento, para instalar tem que ser por via do chrome. Abra no chrome o link https://fx.promissionsave.com e tente novamente.");
	}
	
	
	// navigator.clipboard.writeText("https://fx.promissionsave.com");
	// Swal.fire(document.queryCommandSupported('copy'));
  // 
};
addBtn.addEventListener('click', listener,false);




window.addEventListener('beforeinstallprompt', (e) => {
	console.log("before");
  addBtn.removeEventListener('click', listener,false);
  // Prevent Chrome 67 and earlier from automatically showing the prompt
  e.preventDefault();
  // Stash the event so it can be triggered later.
  deferredPrompt = e;
  // Update UI to notify the user they can add to home screen
  addBtn.style.display = 'block';

  addBtn.addEventListener('click', () => {
    // hide our user interface that shows our A2HS button
    addBtn.style.display = 'none';
    // Show the prompt
    deferredPrompt.prompt();
    // Wait for the user to respond to the prompt
    deferredPrompt.userChoice.then((choiceResult) => {
      if (choiceResult.outcome === 'accepted') {
        console.log('User accepted the A2HS prompt');
		pos_install();
      } else {
        console.log('User dismissed the A2HS prompt');
      }
      deferredPrompt = null;
    });
  });
});
function initinstall(){
	window.history.pushState({}, document.title, window.location.pathname);
	  Swal.fire({
    title: "Instalar",
    text: "Prosseguir com instalação?",
	showCancelButton: true,
    type: "success"
}).then(function(result) {
	if (!result.isConfirmed)return;
    deferredPrompt.prompt();
    // Wait for the user to respond to the prompt
    deferredPrompt.userChoice.then((choiceResult) => {
      if (choiceResult.outcome === 'accepted') {
        console.log('User accepted the A2HS prompt');
		pos_install();
      } else {
        console.log('User dismissed the A2HS prompt');
      }
      deferredPrompt = null;
    });
});
} 
<?php   if(@$_GET["i"]=="1")echo 'initinstall();';?>
    </script>

</body>
</html>