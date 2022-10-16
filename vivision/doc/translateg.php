<html>

<script>
	var data = "q=";
	data+= encodeURIComponent ("Vislumbrei a minha missão cá na terra, acabei por ficar muito surpreendido com o que era, um método para erradicar a fome, que são 9 milhões por ano há data que escrevo isto. ");
	data+="&target=en&source=pt";

const xhr = new XMLHttpRequest();
xhr.withCredentials = true;

xhr.addEventListener("readystatechange", function () {
	if (this.readyState === this.DONE) {
		console.log(this.responseText);
	}
});

xhr.open("POST", "https://google-translate1.p.rapidapi.com/language/translate/v2");
xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
xhr.setRequestHeader("accept-encoding", "application/gzip");
xhr.setRequestHeader("x-rapidapi-host", "google-translate1.p.rapidapi.com");
xhr.setRequestHeader("x-rapidapi-key", "d415a74093msha089bfe51bdf121p14a6ecjsnb979b818a109");
xhr.send(data);

</script>






</html>