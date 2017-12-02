<?php include ('header.php');	?>

<div class="container-fluid" >
	<div class="row">
		<div class="col-md-10 index">

		<h2> IWA_2013_VZ_PROJEKT </h2>

<p>Sustav treba omoguciti upravljanje bazom recepata. <br/>

Korisnici sustava su administratori, moderatori, prijavljeni korisnici i anonimni/neprijavljeni korisnici.
U sustavu postoji jedan ugradeni administrator (korisnicko ime: admin, lozinka: foi). Administrator je prijavljeni korisnik koji ima vrstu = 0. <br/>

Administrator unosi korisnike i kategorije te definira moderatore za kategorije izmedu unesenih korisnika,
administrator moze vidjeti sve preglede kao moderator i prijavljeni korisnik. <br/>

<form>
	Unesite dva broja: <input type="number" id="num1" ></input>
	<input type="number" id="num2" ></input>
</form>
<button class="btn" onclick="document.getElementById('javaScript').innerHTML =
wordGame();">Izracunaj</button>
<p id="javaScript"></p>

<p><b>Generator akorda:</b></p>
<form>
Koliko akorda zelis: <input type="number" onkeyup="document.getElementById('akordi').innerHTML = brojevi(this.value)">
</form>
<p>Akordi: <span id="akordi"></span></p>

Moderator upravlja kategorijom: odobrava nove recepte i moze uredivati kategoriju i mijenjati naziv i sliku.
Takoder moze uredivati komentare i recepte u svojoj kategoriji. <br/> <br/>

Prijavljeni korisnik moze pregledavati i pretrazivati sve recepte i dodavati vlastite, prije objave je potrebno da moderator kategorije odobri recept.
Moguce je komentirati i ocjenjivati objavljene recepte. Prilikom kreiranja recepta potrebno je napisati tekst te odabrati sastojke jela zajedno sa kolicinama,
ukoliko neki sastojak ne postoji potrebno ga je dodati. <br/>
Kreirani recept ima polje odobren 0, nakon sto ga moderator grupe odobri to polje se postavlja na 1 i recept se prikazuje.
<br/><br/>
Anonimni/neprijavljeni korisnik moze samo vidjeti naslove i slike recepata po kategorijama, za pregled tekstova potrebno je se prijaviti. <br/>

Svi korisnici mogu uredivati vlastite podatke (slika, ime, lozinka itd.)<br/><br/>

Baza podataka naziva se IWA_2013_VZ_PROJEKT<br/>
Korisnik za pristup do baze podataka naziva se iwa_2011 a lozinka je FOI <br/><br/>

Svaka kategorija mora imati jednog moderatora (polje korisnik_id u tablici kategorija),
administrator pri kreiranju kategorije odreduje korisnika koji ce biti moderator te kategorije
(prije toga treba toga korisnika promovirati u moderatora,
tj. postaviti njegov tip na moderator jer samo takvi korisnici mogu biti moderatori kategorije),
takoder je moguce smijeniti moderatora - postaviti nekog drugog za moderatora kategorije
(naravno uz uvjet da je taj drugi korisnik tipa moderator).
<br/><br/>
Administrator moze SVE sto mogu ostali tipovi korisnika - znaci moze dodavati i uredivati sve recepte, korisnike, kategorije,
promijeniti moderatora kategorije, sastojke recepta, uredivati postavljene komentare, dodavati nove itd.
</p> <br/>
<p><a href="http://jigsaw.w3.org/css-validator/check/referer">
        <img style="border:0;width:88px;height:31px"
            src="http://jigsaw.w3.org/css-validator/images/vcss"
            alt="Valid CSS!" /> </a></p>
<p><a href="http://jigsaw.w3.org/css-validator/check/referer">
    <img style="border:0;width:88px;height:31px"
        src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
        alt="Valid CSS!" /></a></p><br/>
</div>

	<div class="col-md-2"><b>Login <a href="login.php">here</a></b><br>
	<img src="http://localhost/iwa2017/slike/login_pic.jpg" width="180px" /></div>

	</div>

</div>


<?php include ('footer.php');  ?>
