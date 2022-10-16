<html>

<script>
	
const dataw=encodeURIComponent ("Cerca de 2 batatas doces assadas por dia para cada pessoa.");
const data = null;

const xhr = new XMLHttpRequest();
// xhr.withCredentials = true;

xhr.addEventListener("readystatechange", function () {
	if (this.readyState === this.DONE) {
		// console.log(this.responseText);
		const obj = JSON.parse(this.responseText);
		console.log("res",obj.responseData.translatedText);
	}
});

xhr.open("GET", "https://translated-mymemory---translation-memory.p.rapidapi.com/api/get?q="+dataw+"&langpair=pt%7Cen&de=a%40b.c&onlyprivate=0&mt=1");

xhr.setRequestHeader("x-rapidapi-host", "translated-mymemory---translation-memory.p.rapidapi.com");
xhr.setRequestHeader("x-rapidapi-key", "d415a74093msha089bfe51bdf121p14a6ecjsnb979b818a109");

xhr.send(data);

</script>






</html>