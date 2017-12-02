<?php include ('header.php');


	$kategorija_id=$_GET['ref'];
	$mod = "SELECT ka.korisnik_id, k.korisnicko_ime
			FROM korisnik k, kategorija ka
			WHERE ka.korisnik_id=k.korisnik_id
			AND	ka.kategorija_id=$kategorija_id";
	$result = mysqli_query($link, $mod);


	  $sql2 = "SELECT naziv, slika FROM kategorija WHERE kategorija_id=$kategorija_id";
	$rs2 = mysqli_query($link, $sql2);

		//Naslov i slika kategorije
		while(list($naziv, $slika) = mysqli_fetch_array($rs2)) {
		echo "<h1> $naziv </h1><br><img src='$slika' width='370' height='200' id='slikaKategorije' /><br><br>"; }

	if (isset($_SESSION['aktivni_korisnik'])) {
	while(list($moderator_id, $moderator_ime) = mysqli_fetch_array($result)) {

			echo "Moderator ove kategorije je <b>$moderator_ime</b>";

	//postavljanje novog moderatora kategorije, ovo moze samo administrator
	if ($_SESSION['aktivni_korisnik_tip'] == 0) {
		$msql = "SELECT korisnik_id, korisnicko_ime FROM korisnik
			WHERE tip_id=1";
		$odabir = mysqli_query($link, $msql);
		echo "<form method='post'><label for='novi_mod'><i>Postavi novog moderatora kategorije: </i></label>
		<select name='novi_mod'>";
		while($row = mysqli_fetch_array($odabir))  {
		echo "<option value='$row[korisnik_id]' >$row[korisnicko_ime]</option>"; }
		echo "</select><input type='submit' name='postavi' value='Postavi' /></form>";

	if(isset($_POST['postavi'])) {
		$mod_k = $_POST['novi_mod'];
		$novi = "UPDATE `kategorija` SET
		`korisnik_id`='" . mysqli_real_escape_string($link, $mod_k) . "'
		WHERE `kategorija_id`='" . mysqli_real_escape_string($link, $kategorija_id) . "'";
		$mod_res = mysqli_query($link, $novi);
		header("Location: " . $_SERVER['REQUEST_URI']);
		exit();
	}

		//brisanje kategorije, potrebno je prvo ukloniti sve recepte iz te kategorije
		echo "<br/><form method='post'><label for='brisanje'><i>Obrisi kategoriju (svi recepti moraju biti prvo obrisani): </i></label>
		<input name='brisanje' type='submit' value='Delete' /></form>";
		if(isset($_POST['brisanje'])) {
		$brisanje_kategorije ="DELETE FROM kategorija WHERE kategorija_id = $kategorija_id";
		$obrisi = mysqli_query($link, $brisanje_kategorije);
		header("Location: index.php");
		exit();
		}
	}

	if ($_SESSION['aktivni_korisnik_tip'] == 0 || $_SESSION['korisnik_id'] == $moderator_id) {
	//promjena naziva i slike kategorije, promjeniti mogu samo administrator i moderator te kategorije
		if(isset($_POST['knaziv'])) {
		$knaziv=$_POST['knaziv'];
		$kslika=$_POST['kslika'];

			$ktg = "UPDATE `kategorija` SET
				`naziv`='" . mysqli_real_escape_string($link, $knaziv) . "',
				`slika`='" . mysqli_real_escape_string($link, $kslika) . "'
			WHERE `kategorija_id`='" . mysqli_real_escape_string($link, $kategorija_id) . "'";
		$ktgres = mysqli_query($link, $ktg);
		header("Location: " . $_SERVER['REQUEST_URI']);
		exit();
		}

		echo "<br /><center><table><form method='post' >
		<tr><td>Naziv kategorije:</td><td><input type='text' name='knaziv' /></td></tr>
		<tr><td>Slika kategorije:</td><td><input type='text' name='kslika' /></td></tr>
		<tr><td colspan='2' ><input type='submit' value='Promjeni' naziv='promjeni' /></td></tr>
		</form></table></center><br />";

		//za moderatora kategorije i administratora, pregled neodobrenih recepata
		$neodobreni = "SELECT r.recept_id, r.naslov, r.slika, k.korisnicko_ime, k.slika
			FROM recept r , korisnik k
			WHERE r.kategorija_id=$kategorija_id
			AND k.korisnik_id=r.korisnik_id
			AND r.odobren=0
			GROUP BY r.recept_id";
	$rezultat = mysqli_query($link, $neodobreni);
if(mysqli_num_rows($rezultat) == 0) {echo "<center><b>Nema neodobrenih recepata</b></center>"; }
else
{	echo "<center><table cellspacing='2' cellpadding='2' border='1' >";
	echo "<tr>
		<th colspan='4'>NEODOBRENI RECEPTI</th>
		</tr>";
}

			while(list($recept_id, $naslov, $slika, $korisnik_id, $kslika) = mysqli_fetch_array($rezultat))

	{
		$_SESSION['recept'] = $recept_id ;
		echo "<tr>
			<td><a id='otvori' href='recept.php?id=$_SESSION[recept]&val=0&mod=$moderator_id' >$naslov </a></td>
			<td><img src='$slika' width='200' height='200' alt='slika jela $naslov'/></td>
			<td>$korisnik_id</td>
			<td><img src='$kslika' width='70' height='100' /></td>";
			echo "</tr>";
			 }
		echo "</table></center><br />";
	}

	//prikaz recepata za odobrene recepte, obicne kocisnike
	$sql = "SELECT r.recept_id, r.naslov, r.slika, k.korisnicko_ime, k.slika
			FROM recept r , korisnik k
			WHERE r.kategorija_id=$kategorija_id
			AND k.korisnik_id=r.korisnik_id
			AND r.odobren=1
			GROUP BY r.recept_id";
	$rs = mysqli_query($link, $sql);


	if (isset($_SESSION['aktivni_korisnik'])) {

	echo "<center><table cellspacing='2' cellpadding='2' border='1' >";
	echo "<tr>
		<th>NASLOV</th>
		<th>SLIKA</th>
		<th colspan='2'>RECEPT NAPISAO</th>
		</tr>";


			while(list($recept_id, $naslov, $slika, $korisnik_id, $kslika) = mysqli_fetch_array($rs))

	{
		$_SESSION['recept'] = $recept_id ;
		echo "<tr>
			<td><a id='otvori' href='recept.php?id=$_SESSION[recept]&val=1&mod=$moderator_id' >$naslov </a></td>
			<td><img src='$slika' width='200' height='200' alt='slika jela $naslov'/></td>
			<td>$korisnik_id</td>
			<td><img src='$kslika' width='70' height='100' /></td>";

			echo "</tr>";
			 }
		echo "</table></center>";
		echo "<br><center><a href='novi_recepti.php' id='podebljano' >Napisite svoj recept </a></center>";
			}}}
	//prikaz za goste
	else {
		$gst = "SELECT recept_id, naslov, slika
			FROM recept
			WHERE kategorija_id=$kategorija_id
			AND odobren=1
			GROUP BY recept_id";
		$gost = mysqli_query($link, $gst);
		echo "<center><table  cellspacing='2' cellpadding='2' border='1'  >";
		echo "<tr><th>NASLOV</th>
				  <th>SLIKA</th></tr>";
		while(list($recept_id, $naslov, $slika) = mysqli_fetch_array($gost)) {
		echo "<tr>
			<td>$naslov</td>
			<td><img src='$slika' width='200' height='200' alt='slika jela $naslov'/></td>";
			echo "</tr>";
			 }
		echo "</table></center>";

	}

	zatvoriBP();

include ('footer.php'); ?>
