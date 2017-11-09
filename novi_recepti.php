<?php

	include ('header.php');

	$sql = "SELECT r.recept_id, k.korisnik_id, r.naslov, r.slika, sr.kolicina, s.naziv, r.tekst, r.odobren
			FROM recept r , korisnik k, sastojak_recepta sr, sastojak s
			WHERE s.sastojak_id=sr.sastojak_id AND
			k.korisnik_id=r.korisnik_id	";

	//upis novog recepta
	$recept_id = NULL;
	if (!empty($_POST['naslov']) && !empty($_POST['recept'])) {

		if($_SESSION['aktivni_korisnik_tip']==0) {
				$odobren = 1; }
		else { $odobren = 0; }
	$sql = "INSERT INTO  recept (recept_id ,kategorija_id ,korisnik_id ,naslov ,slika ,tekst ,odobren)
		VALUES ('$recept_id','$_POST[kategorija_id]','$_SESSION[korisnik_id]','$_POST[naslov]','$_POST[slika_jela]','$_POST[recept]','$odobren')";
		$rs = mysqli_query($link, $sql);
		 $id_recepta = mysqli_insert_id($link);
		 $_SESSION['recept_id'] = $id_recepta;
	if(! $rs) {
		$msg = "Recept nije uspjesno poslan"; }
	else { $msg = "Recept uspjesno poslan"; }

	} else {$msg = "Unesite recept";}

	//odabir postojecih sastojaka
	$sql2 = "SELECT sastojak_id, naziv FROM sastojak";
	$res2 = mysqli_query($link, $sql2);

	//novi sastojak
	if (!empty($_POST['n_sastojak']) && !empty($_POST['slika_sastojak'])) {

	$sql4 = "INSERT INTO sastojak (sastojak_id, naziv, slika)
			VALUES (NULL,'$_POST[n_sastojak]','$_POST[slika_sastojak]')";
	$res4 = mysqli_query($link, $sql4);

		header("Location: " . $_SERVER['REQUEST_URI']);
		exit();
	}

	else { $msg4 = "Unesite sastojak (ukoliko ga nema pod ponudenima)";}

	//kolicine sa odabranim sastojcima
	if (!empty($_POST['kolicina'])) {
	@$recept_id = $_SESSION['recept_id'];
	if (empty($_SESSION['recept_id'])) {echo "<b>Napisite prvo recept, a zatim dodajte sastojke</b>";}
	$sastojak = $_POST['sastojak_recepta'];
	$kolicina = $_POST['kolicina'];

	$sql3 = "INSERT INTO sastojak_recepta (recept_id, sastojak_id, kolicina)
			VALUES ('$recept_id','$sastojak','$kolicina')";
	$res3= mysqli_query($link, $sql3);

	if (!$res3) {$msg3 = "Sastojak nije poslan"; }
		else {$msg3 = "Sastojak poslan";}
	} else {$msg3 = "Unesite kolicinu i odaberite sastojak";}

	$sql5 = "SELECT kategorija_id, naziv FROM kategorija";
	$res5 = mysqli_query($link, $sql5);

	//brisanje ID recepta, zavrsetak cjelokupnog recepta
	if(isset($_GET['reset']) && ($_GET['reset'] == "Reset")) {
	unset($_SESSION['recept_id']);
	header('location:index.php');
	}

	?>

	<center><h3>Napisite svoj recept</h3><br>
	<p>Unesite recept tako da prvo napisete i posaljete recept, a zatim dodate sve sastojke sa kolicinama<br>
	Nakon sto unesete recept i sve sastojke, pritisnite dugme "Zavrsi sa receptom". Hvala </p></center><br>
<center><form id="novi_sastojak" action="novi_recepti.php" method="post" >
<table border="1" cellspacing="2">
	<tr>
	<td><label for="n_sastojak"> Naziv sastojka: </label></td>
	<td><input name="n_sastojak" type="text" /></td></tr>
	<tr>
	<td><label for="slika_sastojak"> Slika sastojka: </label></td>
	<td><input name="slika_sastojak" type="text" /></td></tr>
	<tr><td align="middle" colspan="2"><input id="dugme" type="submit" name="dodaj1" value="Posalji sastojak" /></td></tr>
</table></form><b><?php echo $msg4  ?></b></center>

 <br>
<center><form id="sastojak_recepta" action="novi_recepti.php" method="post" >
<table border="1" cellspacing="2">
<tr>
	<td><label for="sastojak"> Sastojci: </label></td>
	<td>
<select name="sastojak_recepta">
	<?php while($row = mysqli_fetch_array($res2)) {

        echo '<option value="'.$row['sastojak_id'].'" >'.$row['naziv'].'</option>';

   } ?>
</select></td></tr>
<tr><td><label for="kolicina" >Kolicina: </label></td>
	<td><input name="kolicina" type="text" maxlength="15" /></td></tr>
	<tr><td colspan="2" align="middle"><input type="submit" id="dugme" name="dodaj" value="Dodaj sastojak" /></td></tr>
</table></form><b><?php echo $msg3 ?></b></center>

 <br>

<center><form id="novi_recept" method="post" action="novi_recepti.php" >
<table border="1" cellspacing="2" cellpadding="1" >
<tr>
	<td><label for="kategorija_id">Kategorija recepta: </label></td>

	<td align="middle">
	<select name="kategorija_id" >
		<?php
		while($row = mysqli_fetch_array($res5)) {
    echo '<option value="'.$row['kategorija_id'].'" >'.$row['naziv'].'</option>';

   } ?>
	</select>
	</td>
</tr>
<tr>
	<td><label for="naslov"> Naslov jela: </label></td>
	<td><input name="naslov" size="65" type="text" /></td></tr>
<tr>
	<td><label for="slika_jela"> Slika jela: </label></td>
	<td><input name="slika_jela" type="text" size="65" /> </td><tr>

<tr>
	<td><label for="recept"> Recept: </label></td>
	<td><textarea name="recept" rows="12" cols="64" ></textarea></td></tr>
<tr>
	<td align="middle" colspan="2"><input type="submit" id="dugme" name="posalji" value="Posalji recept" /></td></tr>
</table>
</form><?php echo "<center><b>$msg</b></center>"; ?></center>
<br /><center><a href='?reset=Reset' id="vazno" class="green" > Zavrsi sa receptom </a></center>
<br />

<?php
 zatvoriBP();
include ('footer.php'); ?>
