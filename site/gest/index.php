
<?php
//http://talkerscode.com/webtricks/add-edit-and-delete-rows-from-table-dynamically-using-javascript.php

require_once('connect.php');



if(@$_POST['action']=='update'){ 
	$table=$_POST['table'];
	$id=$_POST['id'];
	$vals=$_POST['vals'];
	$stmt = $db -> prepare('UPDATE '.$table.' SET '.$vals.' WHERE '.$id.';');
	$stmt -> execute();
	exit;
}
if(@$_POST['action']=='insert'){ 
	$table=$_POST['table'];
	$names=$_POST['names'];
	$vals=$_POST['vals']; 
	clog(('INSERT INTO '.$table.' ('.$names.') VALUES ("'.$vals.'");'));
	$stmt = $db -> prepare( ('INSERT INTO '.$table.' ('.$names.') VALUES ("'.$vals.'");'));
	$stmt -> execute( );
	exit;
}
if(@$_POST['action']=='select'){ 
	$vsearch="pla";
	$stmt = $db -> prepare(@$_POST['query']);
	$stmt -> execute();//array("%".$vsearch."%") );
	if($stmt->rowCount()>0){ 
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC); 
		echo json_encode($res);
		exit;
	}
	echo "0";
	exit;
}

if(@$_POST['action']=='selectshema'){ 
	$stmt = $db -> prepare(@$_POST['query']);//."   limit 1");
	// $stmt -> execute(); 	 
	// $stmt = $db -> prepare("select *, link as hlink from tabGest   limit 1");
	// $stmt = $db -> prepare("describe tabGest;");
	$stmt -> execute();//array($_POST['email']));
	$cnt_columns = $stmt->columnCount();
	$mo=array();
	for($i = 0; $i < $cnt_columns; $i++) {
	  $metadata = $stmt->getColumnMeta($i);
	  array_push($mo,$metadata);
	}
	echo json_encode($mo);
	exit;
}

?>

<?php  
	/*xhttp.php cópia para meeting.promition.org de promition.org*/
	// $location="./";
	$location="../../../htdocs/"; 
	$site="https://".$_SERVER['SERVER_NAME'];
	$just_domain = "https://".preg_replace("/^(.*\.)?([^.]*\..*)$/", "$2", $_SERVER['HTTP_HOST']);
	$composer =$location.'vendor/autoload.php';	
	$id=0;
	$name="nome";
	$email="email";
	// $lat=39.3273571;
	$long=-8.937850;
	$lang=0;
	$idioms=array("en","pt","es","fr","it");
	$langbr="pt";
	// $_COOKIE['lang']='';
	$coin="USD";
	if(@$_SERVER['HTTP_ACCEPT_LANGUAGE'])$langbr = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	if( @$_COOKIE['lang'] )$langbr=$_COOKIE['lang'];
	clog($langbr);
	// $langbr="ar";
	// $langbr="pt";
	// if($langbr!="en")$coin="EUR";
	// $balance=0;
	require_once("connect.php");	
	require_once( "../token.php");	
	// require_once( "dict.php");	
	require_once($location."vendor/autoload.php");	
	require_once( "../google_login.php");	
	require_once("../facebook_login.php");
	require_once("../parser.php");

	clog($res[0]['email']);
?>








<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Gest</title>
<link rel="shortcut icon" href="../logo.png">


<script src="https://accounts.google.com/gsi/client" async defer></script>
<script>
    function gtElInit() {
        var lib = new google.translate.TranslateService();
        lib.translatePage('pt', '<?php echo $langbr;?>', function () {
        // div_loader.style.display="none"; div_all.style.display="block"; 
    });}
</script>
<?php if($langbr!="pt") 
     echo '<script src="https://translate.google.com/translate_a/element.js?cb=gtElInit&amp;hl=pt-PT&amp;client=wt" type="text/javascript"></script>'; 
?>

<style>
	#goog-gt-tt, .goog-te-balloon-frame{display: none !important;} 
	.goog-text-highlight { background: none !important; box-shadow: none !important;}
	.goog-te-glossary-tooltip {
	display: none !important;
	}
	#goog-gt-{
	display: none !important;
	}
</style>
<script>
var data_table="tabGest";
var tableobj;
var head;
var xhttp_name="index.php";

// var email="<?php echo $res[0]['email'];?>";
// var email_autorized=email=="superbem@gmail.com";

var email_autorized="<?php echo ($res[0]['email']=='superbem@gmail.com');?>";


function glogin(){
	// https://myaccount.google.com/u/2/permissions?continue=https%3A%2F%2Fmyaccount.google.com%2Fu%2F2%2Fsecurity
	google.accounts.id.initialize({
      client_id: '<?php echo $clientID; ?>',
      callback: handleCredentialResponse
    });
    google.accounts.id.prompt(); 
}
function handleCredentialResponse(response){
	// console.log(response);
	var credential=response["credential"];
	// console.log(credential);
	window.location='<?php echo $site."/gest"; ?>/?credential='+credential;
}
window.onload=function(){
	// glogin();
	// console.log(email);
}

function saverow(data_table,id){ 
	var bid=data_table+id; 
	var vals=[];
	for(var i=0;i<head.length;i++){
		var namefield=head[i]['name'];
		var bidn=bid+namefield;
		var v=document.getElementById("txtarea"+bidn).value; 
		v=v.split("'").join("\"");
		vals.push(head[i]['name']+"='"+v+"'");
		tableobj[id-1][ namefield]=v;
		document.getElementById("txtarea"+bidn).outerHTML=genlink(namefield,v);
	}
	vals=vals.join(",");  
	var idt=head[0]['name']+"="+tableobj[id-1]['id'];
	// console.log(idt);
	
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", xhttp_name, true); 
	params = 'action=update&table='+data_table+'&id='+idt+'&vals='+encodeURIComponent(vals);  
	xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');  
	xhttp.onreadystatechange = function () { if (this.readyState == 4 && this.status == 200) { 
		console.log('edit',xhttp.response); 
	}}
	xhttp.send(params);
	
	document.getElementById("edit_button"+bid).style.display="block";
	document.getElementById("save_button"+bid).style.display="none";
}

function editrow(data_table,id){ 
	var bid=data_table+id;
	// console.log(data_table,id);
	
	document.getElementById("edit_button"+bid).style.display="none";
	document.getElementById("save_button"+bid).style.display="block";
	
	for(var i=0;i<head.length;i++){
		var namefield=head[i]['name'];
		var reg=document.getElementById(data_table+namefield+id);
		var bidn=bid+namefield;
		var h="";
		h="<textarea autocomplete='on' id='txtarea$id' style='background-color:orange; resize:none; width:100%;' type='text' >";
		h+=tableobj[id-1][ namefield];
		h+="</textarea>";
		h=h.split("$id").join(bidn);
		reg.innerHTML=h;
		
	} 
}

function deleterow(data_table,id){ 
	var bid=data_table+id;
	document.getElementById("row"+bid+"").outerHTML="";
}

//dont send empty values (for predef mysql)
function insertrow(){ 
	var names=[];
	var vals=[];
	for(var i=0;i<head.length;i++){
		var v=document.getElementById("new"+head[i]['name']).value;
		v=v.split("'").join("`");
		v=v.split("\"").join("`");
		if(v!=""){
			names.push(head[i]['name']);
			vals.push(v);;
		}
	};
	names=names.join(",");
	vals=vals.join('","');
	if(names=="")return; 
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", xhttp_name, true); 
	params = 'action=insert&table='+data_table+'&names='+names+'&vals='+encodeURIComponent(vals);  
	xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');  
	xhttp.onreadystatechange = function () { if (this.readyState == 4 && this.status == 200) {
	
		console.log('xr',xhttp.response);
		runsql();
		// getdata('select * from tabGest');
	
	}}
	xhttp.send(params);
}
function geninsertrow(head,data_table){
	// var html="<tr>";
	// html+='<td><input type="button" class="add" onclick="insertrow();" value="Add Row"></td>';
	// for(var i=0;i<head.length;i++)
		// html+='<td><input style="width:100%;" type="text" id="new'+head[i]['name']+'"></td>';
	// html+="</tr>";
	var html="<tr>";
	html+='<td><input id="add_row" type="button" class="add" onclick="insertrow();" value="Add Row"></td>';
	for(var i=0;i<head.length;i++)
		html+='<td><input style="width:100%;" type="text" id="new'+head[i]['name']+'"></td>';
	html+="</tr>";
	

	var table=document.getElementById(data_table);
	var table_len=(table.rows.length)-0;
	var row = table.insertRow(table_len).outerHTML=html;

	if(!email_autorized){
		add_row.style.display="none";
		txtsql.style.display="none";
	}
}

function genbuttons(id){
	var bid=data_table+id;
	var h='<td style="width:150px;"><input style="float:left;" type="button" id="edit_button$bid" value="E" class="edit" onclick="editrow(`data_table`,$id)">';
	h+='<input style="float:left;" type="button" id="save_button$bid" value="S" class="save" onclick="saverow(`data_table`,$id)">'; 
	h+='<input style="float:left;" type="button" value="D" class="delete" onclick="deleterow(`data_table`,$id)">';
	h+='</td>';
	h=h.split("data_table").join(data_table);
	h=h.split("$id").join(id);
	h=h.split("$bid").join(bid);
	return h;
}

function genlink(field,vals){
	if(field=="link"){ 
		var val=vals.split("\n").join(" ");
		val=val.split(" ");
		var html="";
		for(var i=0;i<val.length;i++){
			var matches = val[i].match(/^https?\:\/\/([^\/?#]+)(?:[\/?#]|$)/i);
			// console.log(matches);
			var h = matches && matches[1];
			// h=val[i];
			if(h){ 
				h=h.split("www.").join("");
				h=h.split(".");
				if(h.length==3)h=h[0]+h[1]; else h=h[0];
				html+= "<a href="+val[i]+" target='_blank'>"+h+"</a> ";
			}
		}
		if(html=="")return vals;
		return html;
	}
	if(field=="data"){
		var date = new Date(vals); 
		if(date!="Invalid Date"){
			var fdate = date.toISOString().slice(0,10);
			return fdate;
		} 
	}
	return vals;
}

function genreg(data_table,field,id,val){ 
	var html="";
	html+="<td id='"+data_table+field+id+"'>";
	html+= genlink(field,val);
	html+="</td>";
	return html;
}

// getdata('select * from tabzall order by id desc');
getdata('select * from tabGest order by id desc');
// getdata('select * from tabPontos order by id desc');
function getdata(sql){
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", xhttp_name, true); 
	var params = 'action=selectshema&query='+sql; 
	xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');  
	xhttp.onreadystatechange = function () { if (this.readyState == 4 && this.status == 200) {
		console.log(xhttp.responseText); 
		head = JSON.parse(xhttp.responseText);  
		// contenteditable='true'
		var html="";
		html+="<table class='fixed' border='1' cellpadding = '0' cellspacing='0'  align=´center´ cellspacing=2 cellpadding=5 id="+data_table+" border=1>";
		html+="<col width=70 />";
		html+="<col width=50 />";
		html+="<tr>";
		html+='<td style="width:150px;"></td>';
		for(var i=0;i<head.length;i++)
			html+="<td>"+head[i]['name']+"</td>";
		html+="</tr>";
		html+="</table>";
		
		var wrapper=document.getElementById("wrapper");
		wrapper.innerHTML=html;
		if(data_table!="data_table")geninsertrow(head,data_table);
		
		xhttp = new XMLHttpRequest();
		xhttp.open("POST", xhttp_name, true); 
		params = 'action=select&query='+sql; 
		xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');  
		xhttp.onreadystatechange = function () { if (this.readyState == 4 && this.status == 200) {
			// console.log(xhttp.responseText); 
			if(xhttp.responseText.trim()!=""){
				var obj = JSON.parse(xhttp.responseText); 
				// console.log(obj);
				tableobj=obj;
				html=""; 
				for(var i=0;i<obj.length;i++){
				
					var id=i+1;//obj[i]['id'];
					var bid=data_table+id;
					html='<tr id="row'+bid+'">'; 
					html+=genbuttons(id);
					for(var j=0;j<head.length;j++){
						html+=genreg(data_table,head[j]['name'],id, obj[i][ head[j]['name'] ] );
					} 
					html+="</tr>";
					
					var table=document.getElementById(data_table);
					var table_len=(table.rows.length)-0;
					var row = table.insertRow(table_len).outerHTML=html;

				} 
				if(!email_autorized){ 
					var elements = document.getElementsByClassName("edit"); 
					for (var i = 0; i < elements.length; i++) {
						elements[i].style.display = "none";
					}
					elements = document.getElementsByClassName("delete"); 
					for (var i = 0; i < elements.length; i++) {
						elements[i].style.display = "none";
					}
				}
			}
			// geninsertrow(head,data_table); 
		
		}}
		xhttp.send(params);
	}}
	xhttp.send(params);
}
 


function addtables(){
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", xhttp_name, true); 
	var params = 'action=select&query='+"show tables"; 
	xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');  
	xhttp.onreadystatechange = function () { if (this.readyState == 4 && this.status == 200) {
		// console.log(xhttp.responseText);  
		var obj=JSON.parse(xhttp.responseText);
		var fname=Object.keys(obj[0])[0]; 
		// console.log(fname);
		var x = document.getElementById("tables");
		for(var i=0;i<obj.length;i++){
			var option = document.createElement("option");
			option.text = obj[i][fname];
			option.value=obj[i][fname];
			x.add(option);
		}
	}}
	xhttp.send(params);
}
function tablechange(val){
	console.log(val);
}

function addsqlt(){
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", xhttp_name, true); 
	var params = 'action=select&query='+"select * from tabSql order by descr asc"; 
	xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');  
	xhttp.onreadystatechange = function () { if (this.readyState == 4 && this.status == 200) {
		// console.log(xhttp.responseText); 
		var obj = JSON.parse(xhttp.responseText);
		console.log(obj);
		var x = document.getElementById("selsql");
		for(var i=0;i<obj.length;i++){
			var option = document.createElement("option");
			option.text = obj[i]['descr'];
			option.value=obj[i]['descr']+"$split"+obj[i]['sqlt']+"$split"+obj[i]['autorun'];
			x.add(option);
		}
	}}
	xhttp.send(params);
}
function changesql(val){
	var sql=val.split("$split")[1];
	var tsql=document.getElementById("txtsql");
	tsql.value=sql;
	var descr=val.split("$split")[0];
	var tdescrsql=document.getElementById("descrsql");
	tdescrsql.value=descr;
	var autorun=val.split("$split")[2];
	var tautorun=document.getElementById("autorun");
	tautorun.checked=Number(autorun); 
	if(autorun==1)runsql();
}

function runsql(){
	var tsql=document.getElementById("txtsql").value;
	var sql=tsql.split(";")[0];
	sql=sql.split("`").join('"');
	var dt=sql.split("from")[1];
	if(dt){
		dt=dt.trim();
		if(dt.split(" ").length>1)dt=dt.split(" ")[0].trim(); 
	}else dt="";
	data_table="data_table";
	if(dt!="")data_table=dt;
	getdata(sql);
	
	// addsqlt();
	// CREATE TABLE if not exists `tabSql` ( `id` int(11) NOT NULL AUTO_INCREMENT, `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, `descr` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT '', `sqlt` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
	
}
function savesql(){

}
</script>
<style>
body
{
margin:0px; auto;
padding:0px;
font-family:helvetica;
}
#wrapper
{
  width:995px;
  padding:0px;
  margin:0px auto;
  font-family:helvetica;
  text-align:center;
}
h1
{
  text-align:center;
  font-size:35px;
  color:#2E2E2E;
  padding:10px;
}
h1 p
{
	font-size:20px;
	margin:0px;
	color:#585858;
}
td
{
	// width:150px;
	text-align:center;
}
input[type="button"]
{
	// margin-top:5px;
}
.save
{
	float:left;
	display:none;
}
table.fixed {
      table-layout: fixed;
      width: 100%;
    }
    table.fixed td {
      overflow: hidden;
    }
tr:nth-child(even) {
  background-color: #f0f0f0;
}
.left_fixed {
	position: fixed;
	z-index:1;
	width: 16%;
	top: 0px;
	bottom: 0px;
	left: 0px;
	// background-color: #0412303f; 
	min-width: 170px;
}
.right_side {
	width: 100%; 
	height: 100vh;
	float: right;
	max-width: calc(100% - 170px);
}
.top_side {
	position: fixed;
	// grid-area: 1 / 1;
	z-index:1;
	width: 100%;
	top: 0px; 
	left: 175px;
	background-color: gray;
	min-height: 140px;
	display: flex;
  flex-flow: row wrap;
}
#wrapper{
	top:140px;
	position: relative; 
}
</style>
</head>
<?php //utils
function clog($output, $with_script_tags = true) {
    $js_code = 'console.log("php",' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
?>
<?php
 
?>
<body>

<div class="left_fixed" style=" border-style: solid; min-height:10px; width:100px;">
	<select id="tables" size="5" onchange="tablechange(value);" style="min-width:170px;">
	</select>
	<select id="selfields" size="8" onchange="tablechange(value);" style="min-width:170px;">
	</select>
	<select id="selsql" size="8" onchange="changesql(value);" style="min-width:170px; height:calc(100% - 220px); ">
	</select>
</div> 
<div class="right_side" > 
	<div class="top_side">
		<div style="float:left; width:140px;">
			<input id="descrsql" style="float:left; width:140px;" />
			<button style="  width:120px; height:20px;"  onclick="runsql();" >run</button>
			<input id="autorun" type="checkbox" style=" float:right; " title="autorun" />
			<button style="  width:150px; height:20px;"  onclick="savesql();" >save</button>
			<button style="  width:150px; height:20px;"  onclick="glogin();" >login</button>
		</div>
		<div style="position:relative; border:solid; left: 0px;   width:calc(100% - 177px - 155px); height:130px; background-color: red; ">
			<textarea id="txtsql" onkeypress="if(window.event.keyCode==13 && !window.event.shiftKey){runsql();return false;}" style="resize:none;  border:solid; width:calc(100% - 0px);  height:127px;" spellcheck="false"></textarea>
		</div>
	</div>
	<div id="wrapper">
	</div>
</div>

<script> 
addtables();
addsqlt();
</script>
</body>
</html>






