<?php
//http://talkerscode.com/webtricks/add-edit-and-delete-rows-from-table-dynamically-using-javascript.php

require_once('connect.php');


if(@$_POST['action']=='update'){ 
	$stmt = $db -> prepare('UPDATE tabreads SET cfi=? ,qtreadjpag=?,qtreadper=?,date=NOW()  WHERE idread=?;');
	$stmt -> execute(array($_POST['cfi'],$_POST['qtreadjpag'],$_POST['qtreadper'],$_POST['idread']));
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


function edit_row(no)
{
 document.getElementById("edit_button"+no).style.display="none";
 document.getElementById("save_button"+no).style.display="block";


 var name=document.getElementById("name_row"+no);
 var country=document.getElementById("country_row"+no);
 var age=document.getElementById("age_row"+no);
	
 var name_data=name.innerHTML;
 var country_data=country.innerHTML;
 var age_data=age.innerHTML;
	
 name.innerHTML="<input type='text' id='name_text"+no+"' value='"+name_data+"'>";
 country.innerHTML="<input type='text' id='country_text"+no+"' value='"+country_data+"'>";
 age.innerHTML="<input type='text' id='age_text"+no+"' value='"+age_data+"'>";
}

function save_row(no)
{
 var name_val=document.getElementById("name_text"+no).value;
 var country_val=document.getElementById("country_text"+no).value;
 var age_val=document.getElementById("age_text"+no).value;

 document.getElementById("name_row"+no).innerHTML=name_val;
 document.getElementById("country_row"+no).innerHTML=country_val;
 document.getElementById("age_row"+no).innerHTML=age_val;

 document.getElementById("edit_button"+no).style.display="block";
 document.getElementById("save_button"+no).style.display="none";
}


function editrow(data_table,id){ 
	var bid=data_table+id;
	console.log(data_table,id);
	
	// document.getElementById("edit_button"+bid).style.display="none";
	// document.getElementById("save_button"+bid).style.display="block";
	
	for(var i=0;i<head.length;i++){
		var namefield=head[i]['name'];
		var reg=document.getElementById(data_table+namefield+id);
		var h="<textarea style='width:100%;' type='text' >";
		h+=tableobj[id-1][ namefield];
		h+="</textarea>";
		reg.innerHTML=h;
		
	}
	// document.getElementById("row"+bid+"").outerHTML="";
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
	params = 'action=insert&table='+data_table+'&names='+names+'&vals='+vals;  
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

 
function add_row()
{
 var new_name=document.getElementById("new_name").value;
 var new_country=document.getElementById("new_country").value;
 var new_age=document.getElementById("new_age").value;
	
 var table=document.getElementById("data_table");
 var table_len=(table.rows.length)-1;
 
 
 
 
 
 
 
 var row = table.insertRow(table_len).outerHTML=
 "<tr id='row"+table_len+"'><td id='name_row"+table_len+"'>"+
 new_name+"</td><td id='country_row"+table_len+"'>"+new_country+
 "</td><td id='age_row"+table_len+"'>"+new_age+
 "</td>"+genbuttons(table_len)+"</tr>";
 
 document.getElementById("new_name").value="";
 document.getElementById("new_country").value="";
 document.getElementById("new_age").value="";
}
function addrow(data_table,head,id){
	var table=document.getElementById(data_table);
	var table_len=(table.rows.length)-1;

	var html="";
	html='<tr id="row'+(i+1)+data_table+'">'; 
	// html+=genbuttons(id);
	html+="<td></td>";
	for(var i=0;i<head.length;i++)
		html+="<td>"+head[i]['name']+"</td>";
	
	html+="</tr>";
 
 
 
 
 // var row = table.insertRow(table_len).outerHTML=
 // "<tr id='row"+table_len+"'><td id='name_row"+table_len+"'>"+
 // new_name+"</td><td id='country_row"+table_len+"'>"+new_country+
 // "</td><td id='age_row"+table_len+"'>"+new_age+
 // "</td>"+genbuttons(table_len)+"</tr>";

}

function genbuttons(id){
	var bid=data_table+id;
	var h='<td style="width:150px;"><input type="button" id="edit_button$bid" value="E" class="edit" onclick="editrow(`data_table`,$id)">';
	// h+='<input type="button" id="save_button1" value="Save" class="save" onclick="save_row(`data_table`,$id)">';
	// h+='<input type="button" value="Delete" class="delete" onclick="delete_row(`'+bid+'`)">';
	h+='<input type="button" value="D" class="delete" onclick="deleterow(`data_table`,$id)">';
	h+='</td>';
	h=h.split("data_table").join(data_table);
	h=h.split("$id").join(id);
	h=h.split("$bid").join(bid);
	return h;
}

function genreg(data_table,field,id,val){
	var html="";
	html+="<td id='"+data_table+field+id+"'>";
	html+= val;
	html+="</td>";
	return html;
}

// getdata('select * from tabGest order by id desc');
getdata('select * from tabVisits order by id desc');
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
			console.log(obj);
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
			// addrow(data_table,head,obj.length);
		
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






