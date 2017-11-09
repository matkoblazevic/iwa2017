<?php

	include ('header.php');


	if ($_SESSION['aktivni_korisnik_tip']==0 ) {
	echo "Dobrodosli korisnice <b id='korisnik'>" . $_SESSION['aktivni_korisnik_ime'] . "</b>";

	//odabir i ispis svih aktualnih moderatora, prikazuje se pritiskom na dugme moderatori
	echo "<center><form method='post' ><input id='vazno' type='submit' name='selekcija' value='Moderatori' /></form></center>";
	if (isset($_POST['selekcija'])) {
	echo"<center><h3>Popis trenutnih moderatora</h3></center><br />";
	$moderatori = "SELECT * FROM korisnik WHERE tip_id=1";
	$modrs = mysqli_query($link, $moderatori);
		echo "<center><table cellspacing='2' cellpadding='2' border='1'>";
	echo "<tr>
		<th>Korisnicko ime</th><th>Ime</th><th>Prezime</th><th>E-mail</th><th>Lozinka</th><th>Slika</th><th>Uredi</th>
		</tr>";
		while(list($id, $tip_id, $korisnicko_ime,$lozinka,$ime,$prezime,$email, $slika) =
		mysqli_fetch_array($modrs)) {

		echo "<tr>
			<td>$korisnicko_ime</td><td>$ime</td><td>$prezime</td><td>$email</td><td>$lozinka</td>
			<td><img src='$slika' width='70' height='100' alt='slika korisnika $ime $prezime'/></td>
			<td><a href='administracija.php?user=$id'>Uredi</a></td>";
		echo	"</tr>";
	}
	echo "</table></center>";
	}

	//odabir podataka svih obicnih korisnika
	$sql = "SELECT * FROM korisnik WHERE tip_id=2";
	$rs = mysqli_query($link, $sql);
	$_SESSION['aktivni_korisnik_tip'];

	//odabir svih moderatora za dodavanje nove kategorije, padaju�i izbornika kod moderator kategorije
	$que = "SELECT korisnik_id, korisnicko_ime FROM korisnik
			WHERE tip_id=1";
	$rezultat = mysqli_query($link, $que);

	//dodavanje nove kategorije
	if(isset($_POST['naziv']))	{
	$que2 = "INSERT INTO kategorija (kategorija_id, korisnik_id, naziv, slika)
			VALUES (NULL, '$_POST[korisnik_id]', '$_POST[naziv]', '$_POST[slika]')";
	$rezultat2 = mysqli_query($link, $que2);
	header("Location: " . $_SERVER['REQUEST_URI']);
	exit();
	}

	//izbornik za administratora
		echo '<center><a class="link" href="korisnik.php"><b>Dodaj korisnika</b></a><br>
		<a class="link" href="sastojci.php"><b>Uredivanje sastojaka</b></a>
		</center>';
	 ?>
	<center><h2>Nova kategorija</h2><form method="post" >
	<table border="1">
	<tr>
		<td>Moderator kategorije:</td>
				<td><select name="korisnik_id" >
				<?php
				while($row = mysqli_fetch_array($rezultat)) {
        echo '<option value="'.$row['korisnik_id'].'" >'.$row['korisnicko_ime'].'</option>';
   } ?>
		</select></td>
	</tr>
	<tr>
		<td><label for="naziv">Naziv kategorije:</label></td>
		<td><input type="text" name="naziv" maxlength="25" size="20" /></td>
	</tr>
    <tr>
		<td><label for="slika" >Slika kategorije:</label></td>
		<td><input type="text" name="slika" size="20" /></td>
	</tr>
	<tr><td colspan="2" align="middle"><input id="dugme" type="submit" value="Dodaj kategoriju" /></td></tr>
	</table>
</form></center>
<br />

<?php	}

	//prikaz svih korisnika sa opcijom uredenja podataka svakog korisnika, samo administrator to moze
	if ($_SESSION['aktivni_korisnik_tip']==0) {

	echo "<center><table cellspacing='2' cellpadding='2' border='1'>";
	echo "<tr>
		<th>Korisnicko ime</th>
		<th>Ime</th>
		<th>Prezime</th>
		<th>E-mail</th>
		<th>Lozinka</th>
		<th>Slika</th>
		<th>Uredi</th>
		</tr>";
		while(list($id, $tip_id, $korisnicko_ime,$lozinka,$ime,$prezime,$email, $slika) =
		mysqli_fetch_array($rs)) {


		echo "<tr>
			<td>$korisnicko_ime</td>
			<td>$ime</td>
			<td>$prezime</td>
			<td>$email</td>
			<td>$lozinka</td>
			<td><img src='$slika' width='70' height='100' alt='slika korisnika $ime $prezime'/></td>
			<td><a href='administracija.php?user=$id'>Uredi</a></td>";
		echo	"</tr>";

	}
	echo "</table></center>";


}	zatvoriBP();
	include ('footer.php');

?>
