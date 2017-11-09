<?php
ob_start();
 include ('header.php');

	$recept_id = $_GET['id'];
	$odobren = $_GET['val'];
	$moderator = $_GET['mod'];

	if ($_SESSION['aktivni_korisnik_tip'] == 0 || $_SESSION['korisnik_id'] == $moderator) {
		echo "<br /> <center><a href='uredenje.php?recept=$recept_id&moder=$moderator' >Uredi recept</a></center>";  }


	//odabir informacija o receptu, zajedno sa prikazom sastojaka, kolicina, i autora recepta
	$sql = "SELECT r.naslov, r.slika, GROUP_CONCAT(sr.kolicina SEPARATOR '<br>'),
			GROUP_CONCAT(s.naziv SEPARATOR '<br>'), r.tekst, k.korisnicko_ime, k.slika
			FROM recept r , sastojak s, sastojak_recepta sr, korisnik k
			WHERE s.sastojak_id=sr.sastojak_id AND
			r.recept_id=sr.recept_id
			AND r.recept_id=$recept_id
			AND k.korisnik_id=r.korisnik_id
			AND r.odobren=$odobren
			GROUP BY r.recept_id";
	$rs = mysqli_query($link, $sql);

	//odabir komentara
	$sql2 = "SELECT k.korisnicko_ime, c.komentar_id, c.naslov, c.tekst, c.ocjena, c.datum
			FROM komentar c, korisnik k
			WHERE recept_id=$recept_id AND k.korisnik_id=c.korisnik_id";
	$res = mysqli_query($link, $sql2);

	//odobravanje recepta ako mu je vrijednost 0, kada se pritisne dugme za odobravanje
	if(isset($_POST['promjeni'])) {
		$odobri = "UPDATE `recept` SET
				`odobren`= 1
			WHERE `recept_id`= $recept_id";
		$odobreno = mysqli_query($link, $odobri);
		header("Location: index.php" );
		exit();
	}

	//slanje komentara recepta
	 if(isset($_POST['submit'])) {
	$sql3 = "INSERT INTO komentar (komentar_id, korisnik_id, recept_id, naslov, tekst, datum, ocjena)
			VALUES (NULL,'$_SESSION[korisnik_id]','$_POST[recept_id]','$_POST[cnaslov]','$_POST[komentar]','$_POST[time]','$_POST[ocjena]')";
	$res2 = mysqli_query($link, $sql3);
		 $recept_id = $_POST['recept_id'];

	header("Location: " . $_SERVER['REQUEST_URI']);
		exit();
	}
	else {$msg = "Komentirajte recept";}

	//prikaz recepta
	if (isset($_SESSION['aktivni_korisnik'])) {


			while(list($naslov, $slika, $kolicina, $sastojak, $tekst, $korisnik_id, $kslika)
			= mysqli_fetch_array($rs))

	{

		echo "<br><center><table cellspacing='2' cellpadding='2' border='1' width='80%'>
			<tr><td colspan='3'><img src='$kslika' width='50' height='70' />&nbsp;&nbsp;$korisnik_id</td></tr>
			<tr><td colspan='3'><h1>$naslov</h1></td></tr>
			<tr><td colspan='3'><img src='$slika' width='400' height='350' alt='slika jela $naslov'/></td></tr>
			<tr><td><h3>Priprema jela</h3></td><td colspan='2' width='20%' align='middle'><h3>Sastojci</h3></td></tr>
			<tr><td>$tekst</td><td align='right'>$kolicina</td> <td align='middle'>$sastojak</td></tr></table></center>";
						}

			//ako recept nije odobren omogu�i dugme sa njegovim odobravanjem, samo za administratora i moderatora kategorije
		if ($_SESSION['aktivni_korisnik_tip'] == 0 || $_SESSION['korisnik_id'] == $moderator) {
		if ($odobren == 0) {
		echo "<br /> <center><form method='post'>
		<input type='submit' class='green' id='vazno' name='promjeni' value='Odobri recept' /></form></center>"; } }

		//ukoliko je recept odobren prika�i komentare, ako nije nemoj prikazati formu za slanje komentara
if ($odobren == 0) {echo "<br />";}
else {
	echo "<center><h2>Komentari</h2></center>";

			while(list( $korisnik_id, $komentar_id, $naslov, $tekst, $ocjena, $datum)
			= mysqli_fetch_array($res))
			{

		echo "<br /><center><table cellspacing='2' cellpadding='1' border='0' width='70%' >";
		echo	"
			<tr><td colspan='2'><b>$naslov</b></td><td align='middle'>OCJENA: $ocjena</td></tr>
			<tr><td align='middle'>$tekst</td>
			<td align='middle' width='15%'>$korisnik_id</td>
			<td align='middle' width='30%'>$datum</td>";
			if ($_SESSION['aktivni_korisnik_tip'] == 0 || $_SESSION['korisnik_id'] == $moderator){
				echo "<form method='post' >
				<input type='submit' name='ukloni' value='Delete' onclick='return obrisi();' /></form>";
						}
			echo "</tr></table><hr width='80%' /></center>";

		//brisanje komentara
		if(isset($_POST['ukloni'])) {
		$brisanje = "DELETE FROM `komentar` WHERE `komentar_id` = $komentar_id";
		$obrisi = mysqli_query($link, $brisanje);
		exit(header("Location: " . $_SERVER['REQUEST_URI']));
	}

		}
?>
		<br><br><center><h3>Ostavite komentar</h3><br />
		<form action= "<?php 'recept.php?id=$_POST[recept_id]' ?>" method="post" >
		<table border="1" cellspacing="2">
		<input type="hidden" value="<?php echo $recept_id; ?>" name="recept_id" />
		<input type="hidden" value="<?php echo date("Y.m.d")." ".date("H:i:s"); ?>" name="time" />
		<tr>
			<td><label for="cnaslov"> Naslov komentara: </label></td>
			<td><input name="cnaslov" type="text" /></td></tr>
		<tr>
			<td><label for="komentar"> Komentar: </label></td>
			<td><input name="komentar" type="text" size="40" /></td></tr>
		<tr>
		<tr>
			<td><label for="ocjena"> Ocjena jela: </label></td>
			<td><select name="ocjena" >
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3" selected>3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			</select></td></tr>
		<tr>
		<td align="middle" colspan="2"><input id="dugme" name="submit" type="submit" value="Posalji komentar" /></td></tr>
  </table></form><b><?php echo $msg  ?></b></center>


<?php	}
}

zatvoriBP();
include ('footer.php');
ob_end_flush();
?>
