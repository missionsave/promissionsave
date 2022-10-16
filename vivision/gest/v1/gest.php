<?php
require_once('connect.php');
if(@$_POST['action']=='update'){ 
	$stmt = $db -> prepare('UPDATE tabreads SET cfi=? ,qtreadjpag=?,qtreadper=?,date=NOW()  WHERE idread=?;');
	$stmt -> execute(array($_POST['cfi'],$_POST['qtreadjpag'],$_POST['qtreadper'],$_POST['idread']));
	exit;
}
if(@$_POST['action']=='insert'){ 
	$stmt = $db -> prepare('INSERT INTO tabreads (column1, column2, column3, ...) VALUES (value1, value2, value3, ...);');
	$stmt -> execute(array($_POST['cfi'],$_POST['qtreadjpag'],$_POST['qtreadper'],$_POST['idread']));
	exit;
}
if(@$_POST['action']=='select'){ 
	$vsearch="pla";
	$stmt = $db -> prepare("select *,author as vauthor,title as vtitle from tabbooks where file like ? limit 100");
	$stmt -> execute(array("%".$vsearch."%") );
	if($stmt->rowCount()>0){ 
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$recheio="";
		foreach($res as $row){
			extract($row);
			// $
			$recheio.="<div  class='module' style='cursor:pointer;' onClick='gobook(\"".$file."\")' >
			<a href='?b=".$file."'  onClick='gobook(\"".$file."\"); return 1;' title='test\nteste'>
			<img style='cursor:pointer;' width=100 height=150 src='"."epubs/".$file.".jpg'/>
			</a>
			<div style='position:relative; text-align:left; font-size:10pt;   width:100px;
  overflow:hidden;";
			echo $row;
		}
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

function delete_row(no)
{
 document.getElementById("row"+no+"").outerHTML="";
}
function genbuttons(id){
	return "<td><input type='button' id='edit_button"+id+"' value='Edit' class='edit' onclick='edit_row("+id+
 ")'> <input type='button' id='save_button"+id+"' value='Save' class='save' onclick='save_row("+id+
 ")'> <input type='button' value='Delete' class='delete' onclick='delete_row("+id+")'></td>"

}
// function genrow(
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


var xhttp = new XMLHttpRequest();
xhttp.open("POST", "gest.php", true); 
var params = 'action=selectshema&query='+'select * from tabGest'; 
xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');  
xhttp.onreadystatechange = function () { 
	if (this.readyState == 4 && this.status == 200) {
		var obj = JSON.parse(xhttp.responseText); 
		console.log('obj',obj);
		for(var i=0;i<obj.length;i++)
		console.log('obj',obj[i]['name']);
	}
}
xhttp.send(params);


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
	width:50px;
	text-align:center;
}
input[type="button"]
{
	margin-top:5px;
}
.save
{
	display:none;
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
if(0){
		require_once('connect.php');	 
		$stmt = $db -> prepare("select *, link as hlink from tabGest   limit 1");
		// $stmt = $db -> prepare("describe tabGest;");
		$stmt -> execute();//array($_POST['email']));
		// if($stmt->rowCount()>=1)
		{ 
			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
			// clog($res); 
		} 
$cnt_columns = $stmt->columnCount();
$mo=array();
for($i = 0; $i < $cnt_columns; $i++) {
  $metadata = $stmt->getColumnMeta($i);
  array_push($mo,$metadata);
}
// clog($mo);
// for($i = 0; $i < $cnt_columns; $i++)clog($mo[$i]['name']);
}

function genbuttons($id){
	return '<input type="button" id="edit_button1" value="Edit" class="edit" onclick="edit_row('.$id.')">
	<input type="button" id="save_button1" value="Save" class="save" onclick="save_row('.$id.')">
	<input type="button" value="Delete" class="delete" onclick="delete_row('.$id.')">';
}
function genhead(){
	$head='
	<table align=´center´ cellspacing=2 cellpadding=5 id="data_table" border=1>
	<tr>
	<th>Name</th>
	<th>Country</th>
	<th>Age</th>
	</tr>
	';
	return $head;
}
function genrow($id){
	$row='
	<tr id="row'.$id.'">
	';
	$row.='<td id="name_row1">Ankit</td>
	<td id="country_row1">India</td>
	<td id="age_row1">20</td>
	<td>
	'.genbuttons($id).'
	</td>
	</tr>
	';
	$row=str_replace("row1", "row".$id, $row);
	return $row;
}
?>
<body>
<div id="wrapper">

 
<?php
	echo genhead();
	
	echo genrow(1);
	echo genrow(2);
	echo genrow(3);
	echo genrow(4);
?>
 

 

<tr>
<td><input type="text" id="new_name"></td>
<td><input type="text" id="new_country"></td>
<td><input type="text" id="new_age"></td>
<td><input type="button" class="add" onclick="add_row();" value="Add Row"></td>
</tr>

</table>
</div>

</body>
</html>






