<script type="text/javascript">
function openWindowWithPost(url, data) {
    var dataForm = document.createElement("form");
    dataForm.style.display = "none";
    dataForm.target = "TargetWindow";//Make sure the window name is same as this value
    dataForm.method = "POST";
    dataForm.action = url;
    for (var key in data) {
        var postData = document.createElement("input");
        postData.type = "hidden";
        postData.name = key;
        postData.value = data[key];
        dataForm.appendChild(postData);
    }
    document.body.appendChild(dataForm);
    var postWindow = window.open("", "TargetWindow", "status=0,title=0,height=600,width=800,scrollbars=1");
    if (postWindow) {
        dataForm.submit();
    } else {
        alert('You must allow popups for this map to work.');
    }
}
    //For testing invoking this function
    // openWindowWithPost("http://www.vivision.org", {action: 'test', from: 'custom'});





</script>
<form action="https://www.vivision.org" method="post" target="_top" id="frm">
   <input type="hidden" name="action" value="test">
</form>



<script>
	document.getElementById("frm").submit();
	
</script>