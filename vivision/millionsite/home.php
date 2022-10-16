<?php
//require_once('connect.php');
function fillkeysall(){ 
	$filestr = file_get_contents( 'https://nunofcguerreiro.com/api-euromillions-json?result=all');
	$arr = json_decode($filestr, true)["drawns"];
	//echo '<script> var keysall=[';
	$vardate='<script> var vardate=[';
	$varball='<script> var varball=[';
	for($i=count($arr)-1;$i>=450;$i--){
		$vardate.='[';
		$vardate.=$arr[$i]["date"];
		if($i!=0)$vardate.='],'; else $vardate.=']';
		
		$varball.='[';
		
		$varball.=str_ireplace(' ',',',$arr[$i]["balls"]);		 
		if($i!=0)$varball.='],'; else $varball.=']';
		//echo $arr[$i]["date"].$arr[$i]["balls"].'<br>'; // etc.
	}
	$vardate.='];</script>';
	$varball.='];</script>';
	echo $vardate.$varball;
	//echo "fs".date("Y m d").$filestr;
}
fillkeysall();
?>

<button onclick="vote()" >Vote</button>

<!-- variaveis -->
<script>
var n=50;
var k=5;
var histsize=varball.length;
var histrb;
var qtdi;
var qtdisum=new Array(k+1); 
var keys=new Array();
var keysqt=new Array();
var keysde=new Array();
var allkeys=new Array(0);
var loading=1;
</script>

<script>


// createArray(3, 2); // [new Array(2), new Array(2), new Array(2)]
function createArray(length) {
    var arr = new Array(length || 0),
        i = length;
    if (arguments.length > 1) {
        var args = Array.prototype.slice.call(arguments, 1);
        while(i--) arr[length-1 - i] = createArray.apply(this, args);
    }
    return arr;
}
String.prototype.replaceAll = function(f,r){return this.split(f).join(r);}



function numCombin(n,k){
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
var ncomb;
function fillNcomb(n,k){
	ncomb=new Array(n); 
	for(var nx=0;nx<n;nx++)ncomb[nx]=new Array(k); 
	for(var nx=0;nx<n;nx++)for(var kx=0;kx<k;kx++){ncomb[nx][kx]=numCombin(nx,kx);}
}
// var toFill=new Array(5);	
function toComb(csn,n,k){
	var toFill=new Array(k);
	csn += 1;
	var lbound = 0;
	var r = 0;
	for (var i = 0; i < (k - 1); i++) {
		toFill[i] = 0;
		if (i != 0) toFill[i] = toFill[i - 1];
		do{
			toFill[i]++;
			// r = numCombin(n - toFill[i], (k - 1) - i);
			r = ncomb[n - toFill[i]][ (k - 1) - i]; //now is cache :)
			lbound += r;
		} while (lbound < csn);
		lbound -= r;
	}
	toFill[k - 1] = toFill[k - 2] + csn - lbound;
	return toFill;
}
//startfrom=1
function toCsn(combi,startfrom){
    var lbound = 0;
    var r = 0;
    for (var i = 1; i <= k; i++) {
        r = n - combi[k - i]+startfrom-1;
        if (r >= i)
            lbound += numCombin(r, i);
    }
    return (numCombin(n, k) - lbound - 1);
}
function combNextFastest(vector,n,k) {
	if(vector[k - 1] < n - 1) {
		vector[k - 1]++;
	}else{
		var j;
		for(j = k - 1; j--;)		
			if(vector[j] < n - k + j)		
				break;
			vector[j]++;
			while(j < k - 1){
				vector[j + 1] = vector[j] + 1;
				j++;
			}
		}
	return vector;
}
function en(c){var x='charCodeAt',b,e={},f=c.split(""),d=[],a=f[0],g=256;for(b=1;b<f.length;b++)c=f[b],null!=e[a+c]?a+=c:(d.push(1<a.length?e[a]:a[x](0)),e[a+c]=g,g++,a=c);d.push(1<a.length?e[a]:a[x](0));for(b=0;b<d.length;b++)d[b]=String.fromCharCode(d[b]);return d.join("")}

function de(b){var a,e={},d=b.split(""),c=f=d[0],g=[c],h=o=256;for(b=1;b<d.length;b++)a=d[b].charCodeAt(0),a=h>a?d[b]:e[a]?e[a]:f+c,g.push(a),c=a.charAt(0),e[o]=f+c,o++,f=a;return g.join("")}

function mathDiffPer(baseone,confront,ratio){
	var _b=(baseone)*ratio;
	return (_b-(confront))/((_b+(confront))/2.0);
}


function fillcache(){
	//allkeys = JSON.parse(de(localStorage.getItem("allkeys")));
	// allkeys=de(localStorage.getItem("allkeys"));
	//allkeys=JSON.parse(allkeys);
	// console.log("ak"+localStorage.getItem("allkeys"));
	// return;
	console.time("p");
	var t0 = performance.now();
	allkeys=new Array(numCombin(50,5));
	// allkeys=createArray (numCombin(n,k),k);
	fillNcomb(n,k);
	// allkeys[0]=[1,2,3,4,5];
	var ki=0;
	var tof;
	//for(var i=1;i<numCombin(50,5);i++)
	for (var i = 0, len = numCombin(n,k); i < len; i++){
		allkeys[i]=toComb(i,n,k);
		  // tof=toComb(i,n,k);
		// var tof=combNextFastest(allkeys[i-1],n,k);
		// allkeys[i]=new Array(5);
		// for (var ki = 0, len1 = k; ki < len1; ki++)allkeys[i][ki]=tof[ki];
	}
	var t1 = performance.now();
	document.getElementById("dummy").innerHTML ="Call to <span style='font-size:10px;vertical-align: super;'>7</span> took " + (t1 - t0) + " milliseconds";
	console.log("Call to doSomething took " + (t1 - t0) + " milliseconds.");
	console.timeEnd("p");
	// var comp=en(JSON.stringify(allkeys));
	// localStorage.setItem("allkeys", comp );
}

function fillhistbin(){
// histrb=vvbool(histsize,vbool(n+1));
	// lop(i,0,histsize)lop(ki,0,k)histrb[i][  varball[i][ki]  ]=1;
	
	histrb=createArray(histsize,n+1);
	for(var i=0;i<histsize;i++)
		for(var ki=0;ki<k;ki++)
			histrb[i][  varball[i][ki]  ]=1;
}
//vbool m, vint b
function qtdmatchbool(m,b){
    var qt=0; 
	for(var i=0;i<b.length;i++)
		if(m[ b[i] ])qt++;
    return qt;
}

function seek(bet){
	var betp=bet.slice();;
	betp.pop();
	
	qtdi=new Array(histsize);
	for(var i=0;i<histsize;i++)
        qtdi[i]=qtdmatchbool(histrb[i],betp);
	
	// console.log("qtdi.len"+qtdi.length+"histsize"+histsize);
	
	for(var ji=0;ji<qtdisum.length;ji++)qtdisum[ ji ]=0;
	for(var ji=0;ji<histsize;ji++)
		qtdisum[ qtdi[ji]  ] +=1;
}

function mustMatchDirect(keys){
		var kes=createArray(keys.length,n+1);	
		for(var v=0;v<keys.length;v++){ 
			for(var xi=0;xi<n+1;xi++)kes[v][xi]=0;
			for(var i=0;i<keys[v].length-1;i++){ 
				kes[v][ keys[v][i] ]=1;
			} 
		}
	 
		var add;
		var ru=0;
		var res=new Array();
		var toFill =[1,2,3,4,5];
		var v;
		fillNcomb(50,5);
		for (var i = 0, len = numCombin(n,k); i < len; i++){
			// toFill=toComb(i,n,k); 
			toFill=allkeys[i];
			 // console.log(toFill);
			add=true;
			for(  v=0;v<keys.length;v++){
				
				ru=0;
				for(var vi=0;vi<k;vi++)ru+=kes[v][ toFill[vi] ];
				if(ru!=keys[v][keys[v].length - 1]){add=false; break;}
				//console.log("yaya"+ru);
			}
			if(add){
				res.push(toFill); 
				// res.push(new Array(k)); 
				// for(var ci=0;ci<k;ci++)res[res.length-1][ci] =toFill[ci];//toFill[ci];
				// console.log(toFill[ci]);
			} 
			// toFill=combNextFastest(toFill,n,k);
		}	
		return res;
}

async function mustMatch(keys,response){  
	setTimeout(function(){
	
console.time('Function #1');
		if(allkeys.length==0)fillcache();

		//limpa keys de arrays vazios
		// for(var i=0;i<keys.length;i++){
		// if(keys[i]==0){ keys.splice(i,1); i--;}
		// }
				
		var kes=createArray(keys.length,n+1);	
		for(var v=0;v<keys.length;v++){ 
			for(var xi=0;xi<n+1;xi++)kes[v][xi]=0;
			for(var i=0;i<keys[v].length-1;i++){ 
				kes[v][ keys[v][i] ]=1;
			} 
		}
	 
		var add;
		var ru=0;
		var res=new Array();
		var toFill =[1,2,3,4,5];
		var v;
		fillNcomb(50,5);
		for (var i = 0, len = numCombin(n,k); i < len; i++){
			// toFill=toComb(i,n,k); 
			toFill=allkeys[i];
			 // console.log(toFill);
			add=true;
			for(  v=0;v<keys.length;v++){
				
				ru=0;
				for(var vi=0;vi<k;vi++)ru+=kes[v][ toFill[vi] ];
				if(ru!=keys[v][keys[v].length - 1]){add=false; break;}
				//console.log("yaya"+ru);
			}
			if(add){
				res.push(toFill); 
				// res.push(new Array(k)); 
				// for(var ci=0;ci<k;ci++)res[res.length-1][ci] =toFill[ci];//toFill[ci];
				// console.log(toFill[ci]);
			} 
			// toFill=combNextFastest(toFill,n,k);
		}
		
console.timeEnd('Function #1');
// console.log(res);
		response(res);
	},30);
}


function shuffle(a) {
    var j, x, i;
    for (i = a.length - 1; i > 0; i--) {
        j = Math.floor(Math.random() * (i + 1));
        x = a[i];
        a[i] = a[j];
        a[j] = x;
    }
    return a;
}

function randomIntFromInterval(min, max) { // min and max included 
  return Math.floor(Math.random() * (max - min + 1) + min);
}
function existsOnArray(arr,exist){ 
	for(var i=0;i<arr.length;i++){
		if(arr[i]==exist)return true;
	}
	return false;
}
//ignore last
function existsOnArrayIl(arr,exist){ 
	for(var i=0;i<arr.length-1;i++){
		if(arr[i]==exist)return true;
	}
	return false;
}
function genrand(qt,min,max){
	var res=new Array();
	while(res.length<qt){
		var mr=randomIntFromInterval(min,max);
		if(!existsOnArray(res,mr)){
			res.push(mr);
		}
	}
	return res;
}
function randomize(idkey){
	// var idkey=keys.length-1;
	var keysize=keys[idkey].length-1;
	var sel=keys[idkey][keysize];
	var kes=genrand(keysize,1,n);
	console.log("ks"+kes.length+"kp"+keysize);
	kes.push(sel);
	keys[idkey]=kes;
	fillv(idkey);
	test();
};
function gerarmax(idkey){
	console.log(idkey);
	var qtkeys=keys[idkey].length-1;
var count=0;	
	var mindiff=2;
	var kesdiff;
	for(let it=0;it<50000;it++){
		var keysize=keys[idkey].length-1;
		var sel=keys[idkey][keysize];
		var kes=genrand(keysize,1,n);
		kes.push(sel);
		keys[idkey]=kes;
		seek(keys[idkey]);	
		for(var i=1;i<2;i++){ //for(var i=0;i<k+1;i++)
			var sel=keys[idkey][keys[idkey].length-1];
			var totalchavesper=(keysProbt[qtkeys][i]*100/keysProbt[0][0]);
			var persaidas=(qtdisum[i]*100/histsize);
			var diff=mathDiffPer(persaidas,totalchavesper,1);
			if(diff==-2.0 || isNaN(diff))diff=0;
		if(diff<-0.07)count++;	
			// if(diff>mindiff){
			if(diff<mindiff){
				mindiff=diff;
				kesdiff=kes;
				createStatTable(idkey,qtkeys);
				console.log("mindiff",mindiff);
			}
		}
	}
	keys[idkey]=kesdiff;
	createStatTable(idkey,qtkeys);
	fillv(idkey);
	test();
console.log("diffcount",count);	
};
function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}
async function vote(){
	console.log("startvote");
	fillhistbin();
	var votar=new Array(keysProbt[0][0]);
	for(let i=0;i<votar.length;i++)votar[i]=0;
	keys=new Array(0);
	var idkey=0;  
	var keysize=10;
	var sel=1;
	var totalchavesper=(keysProbt[keysize][sel]*100/keysProbt[0][0]);
	var kes;
	// console.log("ks"+kes.length+"kp"+keysize);
	for(let it=0;it<5000000*4;it++){  
		if(it==2500000*4){
			console.log("it",it);
			await sleep(30000);
		}
		kes=genrand(keysize,1,n);
		kes.push(sel);
		keys[idkey]=kes;
		seek(keys[idkey]); 
		var persaidas=(qtdisum[sel]*100/histsize);
		var diff=mathDiffPer(persaidas,totalchavesper,1);
		// if(diff<0.01 && diff>-0.01){
		// if(diff<-0.11 || diff>0.10){
		if(diff<-0.145){
			var res=mustMatchDirect(keys);
			for(let i=0;i<res.length;i++){
				votar[ toCsn( res[i] ,1) ]++;
			}
		}
	}
	console.log("votar",votar[0]);
	var minv=0;
	var idxv=0;
	for(let i=0;i<votar.length;i++){
		if(minv<votar[i]){
			minv=votar[i];
			idxv=i;
		}
	}
	var votecomb=toComb(idxv,n,k);
	for(var i=0;i<votecomb.length;i++)	console.log("tocomb "+votecomb[i]);
	console.log("votar",votar[idxv],idxv);
	var counti=0;
	for(let i=0;i<votar.length;i++){
		if(minv==votar[i])counti++;
	
	}
	console.log("counti",counti);
}
function testcomb(){
	var a=[8,12,13,17,24];
	var b= toCsn(a,1);
	console.log("tocsn", b );
	var c=toComb(b,n,k);
	for(var i=0;i<c.length;i++)	console.log("tocomb "+c[i]);
}

function addonebt(){
	var idkey=keys.length; //new 
	var keysize=10;
	var sel=1;
	var kes=genrand(keysize,1,n);
	// console.log("ks"+kes.length+"kp"+keysize);
	kes.push(sel);
	keys[idkey]=kes;
	init();
};
var  keysProbt=[[2118760,0,0,0,0,0],[1906884,211876,0,0,0,0],[1712304,389160,17296,0,0,0],[1533939,535095,48645,1081,0,0],[1370754,652740,91080,4140,46,0],[1221759,744975,141900,9900,225,1],[1086008,814506,198660,18920,660,6],[962598,863870,259161,31605,1505,21],[850668,895440,321440,48216,2940,56],[749398,911430,383760,68880,5166,126],[658008,913900,444600,93600,8400,252],[575757,904761,502645,122265,12870,462],[501942,885780,556776,154660,18810,792],[435897,858585,606060,190476,26455,1287],[376992,824670,649740,229320,36036,2002],[324632,785400,687225,270725,47775,3003],[278256,742016,718080,314160,61880,4368],[237336,695640,742016,359040,78540,6188],[201376,647280,758880,404736,97920,8568],[169911,597835,768645,450585,120156,11628],[142506,548100,771400,495900,145350,15504],[118755,498771,767340,539980,173565,20349],[98280,450450,756756,582120,204820,26334],[80730,403650,740025,621621,239085,33649],[65780,358800,717600,657800,276276,42504],[53130,316250,690000,690000,316250,53130],[42504,276276,657800,717600,358800,65780],[33649,239085,621621,740025,403650,80730],[26334,204820,582120,756756,450450,98280],[20349,173565,539980,767340,498771,118755],[15504,145350,495900,771400,548100,142506],[11628,120156,450585,768645,597835,169911],[8568,97920,404736,758880,647280,201376],[6188,78540,359040,742016,695640,237336],[4368,61880,314160,718080,742016,278256],[3003,47775,270725,687225,785400,324632],[2002,36036,229320,649740,824670,376992],[1287,26455,190476,606060,858585,435897],[792,18810,154660,556776,885780,501942],[462,12870,122265,502645,904761,575757],[252,8400,93600,444600,913900,658008],[126,5166,68880,383760,911430,749398],[56,2940,48216,321440,895440,850668],[21,1505,31605,259161,863870,962598],[6,660,18920,198660,814506,1086008],[1,225,9900,141900,744975,1221759],[0,46,4140,91080,652740,1370754],[0,0,1081,48645,535095,1533939],[0,0,0,17296,389160,1712304],[0,0,0,0,211876,1906884],[0,0,0,0,0,2118760]];

// keys[2]=[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,5];
// keys[0]=[1,1];
// keys[1]=[1, 3, 5, 7, 9, 11, 13,15, 17, 19, 21, 23, 25,27,29,31,33,35,37,39,41,43,45,47,49,1];
//keys[2]=[1, 3, 5, 7, 9, 11, 13,15, 17, 19, 21, 23, 25,27,29,31,33,35,37,39,41,43,45,47,49,5];

// keys[3]=[0];

function test(){
	if(loading==1)return;
	document.getElementById("totais").innerHTML = "A calcular";
	//var keys=new Array();//=[[1,2,5,6,20,3],[12,22,33,44,2]];
	
	 
	// keys[2]=genrand(25,1,50);
	// keys[2].sort((a, b) => a - b);
	// keys[2].push(4);
	// keys[2]=0; 
	
	
	// keys[3]=genrand(25,1,50);
	// keys[3].sort((a, b) => a - b);
	// keys[3].push(1);
	
	// keys[4]=genrand(25,1,50);
	// keys[4].sort((a, b) => a - b);
	// keys[4].push(1);
	
	//keys[5]=[17,1];
	
	mustMatch(keys,function (x) {
		var addone='<button onclick="addonebt()" >Add one</button>';
		var xl=x.length;
		var xlm="";
		if(xl>100){
			xl=100;
			xlm='<br><div class="tooltip"><b>A mostrar 100.</b><span class="tooltiptext">Tente adicionar filtro ou escolha nos filtros que tem, outro valor de 0 a 5 bolas por conjunto que visualize ter melhor probabilidade.</span></div><br>';
		}
		if(document.getElementById("shuffle").checked==true) shuffle(x);
		
		var inner=addone+"<br>"+x.length+xlm+"<br>As suas chaves prováveis<br>";//="<div> ";
		for(var i=0;i<xl;i++){
			inner+=String(x[i]).replaceAll(',',' ')+"<br>";
		}
		// console.log(x);
		
		var ht=x.length+" chaves ";
		ht+=(x.length/keysProbt[0][0]*100).toFixed(0)+"% do total.";
		console.log("ht"+ht);
		document.getElementById("totais").innerHTML = ht;
		
		
		document.getElementById("demo").innerHTML = inner; 
	});
}


console.log(navigator.hardwareConcurrency);

window.onload = function(e){ 
	document.getElementById("totais").innerHTML="Um momento por favor, a carregar a cache dos algoritmos.";
    setTimeout(function(){
		fillcache();
		loading=0;
		test();
		document.getElementById("totais").innerHTML="";
	},30);
}
</script>
<style>
.alinea { font-size:10px;vertical-align: super; }
</style>
<!-- tabela stat -->
<script>
function setkeykel(cs){
	var idkey=cs.split(",")[0];
	var nsel=cs.split(",")[1];
	var sel=keys[idkey][keys[idkey].length-1];
	keys[idkey][keys[idkey].length-1]=nsel;
	fillv(idkey);
	test();
	console.log("sel"+nsel);
}
function createStatTable(idkey,qtkeys){
	var s='<div><table><tr><th>Escolha<span class="alinea">1</span></th><th>Total Chaves</th><th>% Chaves</th><th>Qtd Saídas</th><th>diff</th> ';
	for(var i=0;i<k+1;i++){ 
		var sel=keys[idkey][keys[idkey].length-1];
		var totalchavesper=(keysProbt[qtkeys][i]*100/keysProbt[0][0]);
		var persaidas=(qtdisum[i]*100/histsize);
		var diff=mathDiffPer(persaidas,totalchavesper,1);
		if(diff==-2.0 || isNaN(diff))diff=0;
		var button='<button style="   " onclick="setkeykel(`'+idkey+','+i+'`)">'+i+'</button>';
		if(i==sel)button=button.split("   ").join("background-color:#4CA; ");
		s+='<tr><td>'+button+'</td><td>'+keysProbt[qtkeys][i]+'</td><td>'+totalchavesper.toFixed(2)+'</td><td>'+qtdisum[i]+'</td><td>'+diff.toFixed(2)+'</td></tr>';
	}
	s+='</table><span style="font-size:10px"><span class="alinea">1</span>Quantos acerta nos selecionados de 1 a 50</span></div>';
	document.getElementById("tabstat"+idkey).innerHTML=s;
	console.log("createStatTable");
	return s;
	
}
</script>


<div id="placar" style="position: fixed;
  top: 0;
  right: 0;
  width: 100%;
  height: 40px; 
  color: White;
  background-color: #444;
  border-top: 4px   yellow;
  z-index: 1;
  box-shadow: 10px 10px grey; background-color:#4CAF50; color: white;  text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;
  ">
 <div id="totais"></div> <div id="dummy"></div>
  </div>
<div id="tabstat" ></div>
<div id="nums" ></div>
<div id="rad1" style="visibility: hidden">hello world</div>
<p id="demo"></p>
<br><br><br><br>
<!-- tabela butoes -->
<script>
	
	
	
function strippxtonum(num){
	return Number(num.split("px").join(""));
}
document.getElementsByTagName("BODY")[0].onresize = function(){  onresizeFunction(function(padd){
	document.getElementById("placar").style.top=(padd-2)+'px'; 
	var nttp=strippxtonum(document.getElementById('nexttotop').style.paddingTop);
	console.log("am"+nttp);
	document.getElementById('nexttotop').style.paddingTop=(nttp+document.getElementById("placar").clientHeight)+"px";//document.getElementById("placar").clientHeight;
	console.log("padd"+padd);
	})};
document.getElementsByTagName("BODY")[0].onresize();

function tabbuttons(idkey){
	var tabela='<div id="tab">';
	var but='<button id="$n#" style="   width:30px; height:30px;" onclick="klikaj(`$,#`)">#</button>';
	but=but.split("$").join(idkey);
	for(var i=1;i<50+1;i++){
		if(existsOnArray(varball[histsize-1],i))
			tabela+=but.split('#').join(i).split("   ").join("border-style: solid; border-color: coral;");
		else
			tabela+=but.split('#').join(i);
		if(i%8==0)tabela+='<br>';
	}
	tabela+="</div>";
	return tabela;
	// document.getElementById("nums").innerHTML=tabela;
}

function arrayAddOrRemoveIfExistsIl(arr,num){
	if(existsOnArrayIl(arr,num)){
		//remove
		for(var i=0;i<arr.length-1;i++)if(arr[i]==num){arr.splice(i,1);break;}
		return arr;
	}
	//add
	return arr.splice(0, 0, num);
} 
function fillSelected(idkey){ 
	for(var i=1;i<50+1;i++)document.getElementById(idkey+"n"+i).style.backgroundColor="";
	var ke=keys[idkey];
	for(var i=0;i<ke.length-1;i++){
		document.getElementById(idkey+"n"+ke[i]).style.backgroundColor="gray";
	}
}
function fillv(idkey){
	fillSelected(idkey);
	var selkey=keys[idkey][keys[idkey].length-1];
	var qtkeys=keys[idkey].length-1;
	seek(keys[idkey]);
	createStatTable(idkey,qtkeys);
	// test();
	for(var i=0;i<keys.length;i++)	console.log("k"+keys[i]);
	
}
function klikaj(cs) { 
	// console.log("cs"+cs.split(",")[0]);
	var i=cs.split(",")[1];
	var idkey=cs.split(",")[0];
	arrayAddOrRemoveIfExistsIl(keys[idkey],i);
	// console.log("k"+keys[idkey]);
	// console.log("qtdisum"+qtdisum);
	fillv(idkey);
	test();
	// console.log("nv"+qtdi);
	//console.log('kk'+qtkeys);
	
    // document.getElementById("rad1").style.visibility='visible';
    // document.getElementById("rad1").innerHTML=i;
    
	
	//test();
	
}
function createsection(idkey){
	
	
}
function init(){
	var ht="";
	for(var idkey=0;idkey<keys.length;idkey++){
		// ht+=createStatTable(idkey);
		ht+='<div id="tabstat'+idkey+'" ></div>';
		ht+='<button onclick="randomize('+idkey+')" >Randomizar</button>';
		ht+='<button onclick="gerarmax('+idkey+')" >Encontrar máxima<br> probabilidade</button>';
		ht+=tabbuttons(idkey);
	}
	// document.getElementById("tabstat").innerHTML=s;
	document.getElementById("nums").innerHTML=ht;
	
	fillhistbin();
	for(var i=0;i<keys.length;i++)fillv(i);
}
function addfilter(){
	var para = document.createElement("div"); 
	var node = document.createTextNode("This is new....");
	para.appendChild(node);
	
	
}

init();

var arr=[0];
console.log("arr"+arr.length);
</script>

<script>
function testt(){
	var stop=0;
	setTimeout(function(){
		stop=1;
		// document.getElementById("totais").innerHTML="";
	},2000);

	for (var  timeout=Date.now()+2000;   Date.now()<timeout; ) {
		//performance.now()<timeout;
		// console.log("wait"+timeout+" "+Date.now());
		if(stop==1)break;
	}
	console.log("ok");
};
</script>

<!-- speedtest -->
<script>
function speedtest(){
	var _speedconstant = 1.15600e-8; //if speed=(c*a)/t, then constant=(s*t)/a and time=(a*c)/s
	var d = new Date();
	var amount = 150000000;
	var estprocessor = 1.7; //average processor speed, in GHZ
	console.log("JSBenchmark by Aaron Becker, running loop " + amount + " times.     Estimated time (for " + estprocessor + "ghz processor) is " + (Math.round(((_speedconstant * amount) / estprocessor) * 100) / 100) + "s");
	for (var i = amount; i > 0; i--) {}
	var newd = new Date();
	var accnewd = Number(String(newd.getSeconds()) + "." + String(newd.getMilliseconds()));
	var accd = Number(String(d.getSeconds()) + "." + String(d.getMilliseconds()));
	var di = accnewd - accd;
	//console.log(accnewd,accd,di);
	if (d.getMinutes() != newd.getMinutes()) {
	  di = (60 * (newd.getMinutes() - d.getMinutes())) + di
	}
	spd = ((_speedconstant * amount) / di);
	var log=("Time: " + Math.round(di * 1000) / 1000 + "s, estimated speed: " + Math.round(spd * 1000) / 1000 + "GHZ");
	 console.log(log);
	// document.getElementById("demo").innerHTML=log;
} 
</script> 
<label class="switch">
  <input id="shuffle" onclick="test()" type="checkbox" checked>
  <span class="slider round"></span>
</label>
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 53px;
  height: 30px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
  border-radius: 30px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 22px;
  width: 22px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
  border-radius: 50%;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(22px);
  -ms-transform: translateX(22px);
  transform: translateX(22px);
}

 
</style>
<style>
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -60px;
  opacity: 0;
  transition: opacity 0.3s;
}

.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}
</style>
<style>
	table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 0px;
	font-size:14px;
}
th{
	font-size:12px;
}
tr:nth-child(even) {
  background-color: #dddddd;
}

input[type=text], input[type=password], select {  
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

</style>
