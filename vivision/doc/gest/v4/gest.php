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
	$stmt = $db -> prepare('INSERT INTO '.$table.' ('.$names.') VALUES ("'.$vals.'");');
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
	}
	exit;
}

if(@$_POST['action']=='selectshema')
{ 
	$stmt = $db -> prepare(@$_POST['query']."   limit 1");
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

<html>

<head>
<script>
var data_table="tabGest";
var tableobj;
var head;

function saverow(data_table,id){ 
	var bid=data_table+id; 
	var vals=[];
	for(var i=0;i<head.length;i++){
		var namefield=head[i]['name'];
		var bidn=bid+namefield;
		var v=document.getElementById("txtarea"+bidn).value; 
		vals.push(head[i]['name']+"='"+v+"'");
		tableobj[id-1][ namefield]=v;
		document.getElementById("txtarea"+bidn).outerHTML=genlink(namefield,v);
	}
	vals=vals.join(","); 
	var idt=head[0]['name']+"="+tableobj[id-1]['id'];
	// console.log(idt);
	
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "gest.php", true); 
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
		if(v!=""){
			names.push(head[i]['name']);
			vals.push(v);;
		}
	};
	names=names.join(",");
	vals=vals.join('","');
	if(names=="")return; 
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "gest.php", true); 
	params = 'action=insert&table='+data_table+'&names='+names+'&vals='+encodeURIComponent(vals);  
	xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');  
	xhttp.onreadystatechange = function () { if (this.readyState == 4 && this.status == 200) {
	
		console.log('xr',xhttp.response);
		getdata('select * from tabGest');
	
	}}
	xhttp.send(params);
}
function geninsertrow(head,data_table){
	var html="<tr>";
	html+='<td><input type="button" class="add" onclick="insertrow();" value="Add Row"></td>';
	for(var i=0;i<head.length;i++)
		html+='<td><input style="width:100%;" type="text" id="new'+head[i]['name']+'"></td>';
	html+="</tr>";
	
	var table=document.getElementById(data_table);
	var table_len=(table.rows.length)-0;
	var row = table.insertRow(table_len).outerHTML=html;
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
		// var vall=val.split(" ");
		// vall="<a href="+vall[1]+" target='_blank'>"+vall[0]+"</a>";
		// var h=new URL(val);
		// h=h.hostname.split("www.").join("");
		// h=h.split(".")[0];
		// var matches = val.match(/^https?\:\/\/([^\/?#]+)(?:[\/?#]|$)/i);
		// var h = matches && matches[1];
		// if(h){
			// h=h.split("www.").join("");
			// h=h.split(".")[0];
			// return "<a href="+val+" target='_blank'>"+h+"</a> ";
		// }
		var val=vals.split("\n").join(" ");
		val=val.split(" ");
		var html="";
		for(var i=0;i<val.length;i++){
			var matches = val[i].match(/^https?\:\/\/([^\/?#]+)(?:[\/?#]|$)/i);
			var h = matches && matches[1];
			if(h){
				h=h.split("www.").join("");
				h=h.split(".")[0];
				html+= "<a href="+val[i]+" target='_blank'>"+h+"</a> ";
			}
		}
		if(html=="")return vals;
		return html;
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

getdata('select * from tabGest order by id desc');
// getdata('select * from tabVisits order by id desc');
function getdata(sql){
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "gest.php", true); 
	var params = 'action=selectshema&query='+sql; 
	xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');  
	xhttp.onreadystatechange = function () { if (this.readyState == 4 && this.status == 200) {
		
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
		
		xhttp = new XMLHttpRequest();
		xhttp.open("POST", "gest.php", true); 
		params = 'action=select&query='+sql; 
		xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');  
		xhttp.onreadystatechange = function () { if (this.readyState == 4 && this.status == 200) {
			
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
			geninsertrow(head,data_table); 
		
		}}
		xhttp.send(params);
	}}
	xhttp.send(params);
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
</style>
</head>
<?php //utils
function clog($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
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
<div id="wrapper">

 
 

 


 
</div>

</body>
</html>






