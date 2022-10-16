
<!DOCTYPE html>



<html  >
<meta http-equiv="cache-control" content="no-cache, must-revalidate, post-check=0, pre-check=0" />
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<link rel="shortcut icon" href="logo.png">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta charset="UTF-8">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<?php
//require_once('connect.php');
function fillkeysall(){ 
	$filestr = file_get_contents( 'https://nunofcguerreiro.com/api-euromillions-json?result=all');
	$arr = json_decode($filestr, true)["drawns"];
	//echo '<script> var keysall=[';
	$vardate='<script> var vardate=[';
	$varball='<script> var varball=[';
	$varstars='<script> var varstars=[';
	for($i=count($arr)-1;$i>=0;$i--){
		$vardate.='[';
		$vardate.=$arr[$i]["date"];
		if($i!=0)$vardate.='],'; else $vardate.=']';
		
		$varball.='[';		
		$varball.=str_ireplace(' ',',',$arr[$i]["balls"]);		 
		if($i!=0)$varball.='],'; else $varball.=']';
		
		$varstars.='[';		
		$varstars.=str_ireplace(' ',',',$arr[$i]["stars"]);		 
		if($i!=0)$varstars.='],'; else $varstars.=']';
		
		
		//echo $arr[$i]["date"].$arr[$i]["balls"].'<br>'; // etc.
	}
	$vardate.='];</script>';
	$varball.='];</script>';
	$varstars.='];</script>';
	// echo $vardate.$varball;
	echo $varball;
	echo $varstars;
	//echo "fs".date("Y m d").$filestr;
}
fillkeysall();
?>
<script src="https://accounts.google.com/gsi/client" async defer></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>

</script>
 
<script src="https://cdn.jsdelivr.net/npm/chart.js@2/dist/Chart.min.js"></script>
<script> //chart
class chartc{
	constructor(idx, data,x,y ) {
		this.data = data; 
		var labels=new Array(data.length);
		for(var i=0;i<labels.length;i++)labels[i]="";
		var divc=document.createElement('div');
		divc.id="div"+x+y;
		divc.style.cssText ="width:300px; height:325px;";
		var button = document.createElement('button');
		button.innerHTML = 'click me';
		button.onclick = function(){
			getn();return false;
		};
		document.body.appendChild(divc);
		var canv = document.createElement('canvas');
		canv.id = 'myChart'+x+y;
		canv.style="display: block; width:100%; height:300px; border:solid;";
		document.getElementById('div'+x+y).appendChild(button);
		document.getElementById('div'+x+y).appendChild(canv);
		var ctx = document.getElementById('myChart'+x+y).getContext('2d');
		this.myChart = new Chart(ctx, {
			type: "line",
			data: {
			  labels: labels,
			  datasets: [{
				label: 'My First Dataset',
				data: this.data,
				fill: false,
				borderColor: 'rgb(75, 192, 192)',
				tension: 0.1
			  }]
			},
			options: {
				title: {
					display: true,
					text: ''
				},
				legend: {
					display: false
				}, 
				tooltips: {
					mode: 'index',
					intersect: true,
					enabled: false,				
					callbacks: {
					   label: function(tooltipItem) {
							  return tooltipItem.yLabel;
					   }
					}
				},responsive: true,
				maintainAspectRatio: true,
				scales: {
					xAxes: [{
						gridLines: {
							display:false
						} ,
						stacked: 1 
					}],
					yAxes: [{
						stacked: 0
						
					}]
				},                
				elements: {
                    point:{
                        radius: 0
                    }
                }
			}
		});
	}
	upd(data){  
		this.myChart.data.datasets[0].data=data;
		var labels=new Array(data.length);
		for(var i=0;i<labels.length;i++)labels[i]="";
		this.myChart.data.labels=labels;
		this.myChart.update();
	}
}	
// var arr=new Array(5);
// arr[0]=new chartc(0, [ 819, -590, 985, 400,900] ,1,0 );
// arr[1]=new chartc(0, [ 819, 200, 985, 400,900] ,2,0 );
// arr[1].upd([900,100]);
</script>

<script> //comb
class combC{
	constructor(n,k,startfrom){
		this.n=n;
		this.k=k;
		this.startfrom=startfrom;
		this.range = this.numCombin(n,k);
	}
	tocsn(combi){
	    var lbound = 0;
		var r = 0;
		for (var i = 1; i <= this.k; i++) {
			r = this.n - combi[this.k - i]+this.startfrom-1;
			if (r >= i)
				lbound += this.numCombin(r, i);
		}
		return (this.numCombin(this.n,this.k) - lbound - 1);
	}
	tocomb(csn){
		var toFill=new Array(this.k);
		csn += 1;
		var lbound = 0;
		var r = 0;
		for (var i = 0; i < (this.k - 1); i++) {
			toFill[i] = 0;
			if (i != 0) toFill[i] = toFill[i - 1];
			do{
				toFill[i]++;
				r = this.numCombin(this.n - toFill[i], (this.k - 1) - i); 
				lbound += r;
			} while (lbound < csn);
			lbound -= r;
		}
		toFill[this.k - 1] = toFill[this.k - 2] + csn - lbound;
		return toFill;
	}
	numCombin(n,k){
		var dif = n - k;
		if (k < dif){
			dif = k;
			k = n - dif;
		}
		var combs = k + 1;
		if (dif == 0) combs = 1;
		else if (dif >= 2)
			for (var i = 2; i <= dif; i++) {
				combs = (combs * (k + i)) / i;
				if (combs < 0)return 0;
			}
		return combs;
	}
}
// var co=new combC(50,5,1);
// console.log(co.range);
// var con=co.tocsn([1,6,7,28,39]);
// console.log("c",con);
// var cob=co.tocomb(con);
// console.log("cob",cob);

class combR{
	constructor(ranges){
	    this.ranges=ranges;
		this.k=ranges.length;
		this.range = 1;
		for(var i=0;i<ranges.length;i++)this.range*=ranges[i];
		this.restoR=[].concat(ranges);
		for(var i=this.k-2;i>=0;i--)this.restoR[i]=ranges[i]*this.restoR[i+1];
	}
	tocsn(comb){
	    var pos = 0;
		var rangeval = this.range;
		for (var l = 0; l < this.k; l++) { 
			var figura = comb[l];
			var sector = ( rangeval / this.ranges[l] ); 
			rangeval = sector;
			pos += sector * figura;
		}
		return pos;
	}
	tocomb(csn){
		var res=new Array(this.k);		
		res[this.k-1]=Math.floor(csn%this.restoR[this.k-1]);
		for(var i=0;i<this.k-1;i++)res[i]=Math.floor(csn/this.restoR[i+1]);
		for(var i=1;i<this.k-1;i++)res[i]%=this.ranges[i];
		return res;
	}
}
// var a=new combR([9,9]);
// console.log(a.range);
// console.log(a.tocsn([7,4]));
// console.log(a.tocomb(65));

class combT{
	constructor(n1,k1,n2,k2,ranges){
		this.n1=n1;
		this.k1=k1;
		this.n2=n2;
		this.k2=k2;
		this.balls=new combC(n1,k1,1);
		this.stars=new combC(n2,k2,1);
		this.cr=new combR(ranges);
		this.range=this.cr.range;
		this.ranges=ranges;
	}
	tocombc(vec){	
		var csntr=this.cr.tocsn(vec);
		var csnbr=Math.floor(csntr/this.stars.range);
		var csnsr=csntr%this.stars.range;
		var vb=this.balls.tocomb(csnbr);
		var vs=this.stars.tocomb(csnsr);
		var res=[vb,vs];
		return res;
	}
	tocombr(vec1,vec2){
		var csnb=this.balls.tocsn(vec1);
		var csns=this.stars.tocsn(vec2);
		var csnt=csnb*this.stars.range+csns;
		var res=this.cr.tocomb(csnt);
		return res;
	}
}
// var ct=new combT(50,5,11,2,[  35, 35, 44, 46, 47 ]);
// var ctr=[17,17,22,23,23];
// var ctr=ct.tocombr([2,6,12,24,30],[2,4]);
// console.log(ctr);
// var ctc=ct.tocombc([34, 34, 43, 45, 46]);
// console.log(ctc);
// console.log(ct.range);
// console.log(ct.tocombc(ctr));
</script>

<script> //shuffle
function shuffle( array ){
 var count = array.length,
     randomnumber,
     temp;
 while( count ){
  randomnumber = Math.random() * count-- | 0;
  temp = array[count];
  array[count] = array[randomnumber];
  array[randomnumber] = temp
 }
}
</script>

<body>
	
</body>

<script>
var ct=new combT(50,5,12,2,[  35, 42, 44, 46, 47 ]);
var ctr=[18,21,22,23,24];
console.log(ct.range);

var arr=new Array(5);
arr[0]=new chartc(0, [ ] ,1,0 );
arr[1]=new chartc(0, [  ] ,2,0 );
// arr[1].upd([900,100]);

//fill array with vals
var vart=new Array(varball.length);
for(var i=0;i<vart.length;i++){
	vart[i]=ct.tocombr(varball[i],varstars[i]);
	// console.log(vart[i]);
}

var ctx=new Array(ct.ranges.length);

function getn(){
	var ctidx=1;

	var mvbin=new Array(ct.ranges[ctidx]);
	var graph=new Array(vart.length);
	var mv;
	for(var j=0;j<100000;j++){
		mv=new Array(ct.ranges[ctidx]);
		for(var i=0;i<mv.length;i++) mv[i]=i;
		// console.log(mv);
		shuffle(mv);
		// console.log(mv);
		mv=mv.slice(0,ctr[ctidx]);
		// mv.sort();
		// console.log(mv);
		for(var i=0;i<mvbin.length;i++) mvbin[i]=0;
		for(var i=0;i<mv.length;i++) mvbin[ mv[i] ]=1;
		// console.log(mvbin);
		graph[0]=0;
		for(var i=1;i<vart.length;i++){
			graph[i]=graph[i-1];
			if( mvbin[ vart[i][ctidx] ]==1 )graph[i]+=1; else graph[i]-=1;
		}
		if(graph[graph.length-50]<-60&&graph[graph.length-1]>graph[graph.length-50]+5)break;
	}
	mv.sort();
	console.log("mv",ctidx,mv);
	ctx[ctidx]=mv;
	var graphsl=graph.slice(-50);
	arr[0].upd(graphsl);
	arr[1].upd(graph);
	// console.log(graph);
}

</script>

</html>