<?php
ob_start();
include ('header.php');

$moder = $_GET['moder'];
if ($_SESSION['aktivni_korisnik_tip'] == 0 || $_SESSION['korisnik_id'] == $moder) {

echo "<center><h1>Uredi recept</h1></center>";

$recept_id = $_GET['recept'];

	//odabir recepta koji se zeli promjeniti
	$sql = "SELECT naslov, slika, tekst
			FROM recept
			WHERE recept_id=$recept_id
			GROUP BY recept_id";
	$rs = mysqli_query($link, $sql);

	//odabir sastojaka recepta
	$sqlsastojci = "SELECT sr.sastojak_id, sr.kolicina, s.naziv FROM sastojak_recepta sr, sastojak s
					WHERE s.sastojak_id = sr.sastojak_id AND sr.recept_id = $recept_id";
	$rssastojci = mysqli_query($link, $sqlsastojci);


	//novi sastojak, padajuci odabir
	$sql2 = "SELECT sastojak_id, naziv FROM sastojak";
	$rs2 = mysqli_query($link, $sql2);


	//Promjena naslova, slike i teksta recepta
	if(isset($_POST['promjeni'])) {
	$naslov=$_POST['naslov'];
	$slika=$_POST['slika_jela'];
	$tekst=$_POST['tekst'];


	$upit = "UPDATE `recept` SET
				`naslov`='$naslov',
				`slika`='$slika',
				`tekst`='$tekst'
				WHERE `recept_id`='$recept_id'";
		$update = mysqli_query($link, $upit);
		header("Location: " . $_SERVER['REQUEST_URI']);
		exit();
	}

	//dodavanje novih sastojaka i kolicina u recept
	if (isset($_POST['promjeni2'])) {
	$sastojak = $_POST['sastojak_recepta'];
	$kolicina = $_POST['kolicina'];

	$sql3 = "INSERT INTO sastojak_recepta (recept_id, sastojak_id, kolicina)
			VALUES ('$recept_id','$sastojak','$kolicina')";
	$rs3= mysqli_query($link, $sql3);

	header("Location: " . $_SERVER['REQUEST_URI']);
	exit();	 }

	//dodavanje novog sastojka, ako ga nema pod ponu�enima
	if (isset($_POST['dodaj'])) {

	$sql4 = "INSERT INTO sastojak (sastojak_id, naziv, slika)
			VALUES (NULL,'$_POST[n_sastojak]','$_POST[slika_sastojak]')";
	$rs4 = mysqli_query($link, $sql4);

		header("Location: " . $_SERVER['REQUEST_URI']);
		exit();
	}

	//brisanje recepta
	if(isset($_POST['brisanje'])) {
	$sql5 = "DELETE FROM recept
	WHERE recept_id = $recept_id" ;
	$rs5 = mysqli_query($link, $sql5);
	header("Location: index.php" );
		exit();

	}

	while(list($naslov, $slika, $tekst)
			= mysqli_fetch_array($rs)) {
?>

<center><form method="post"  action="">
<table border="1" cellspacing="2" cellpadding="1" >
<tr>
	<td><label for="naslov"> Naslov jela: </label></td>
	<td><input name="naslov" type="text" size="35" value="<?php echo $naslov; ?>" /></td></tr>
<tr>
	<td><label for="slika_jela"> Slika jela: </label></td>
	<td><img src="<?php echo $slika; ?>" width='300' height='250' /><br />
	<input name="slika_jela" type="text" size="60" value="<?php echo $slika; ?>" />
	</td><tr>
<tr>
	<td><label for="tekst"> Recept: </label></td>
	<td><textarea name="tekst" rows="15" cols="50" /><?php echo $tekst; ?></textarea></td></tr>
<tr>
	<td align="middle" colspan="2"><input type="submit" id="dugme" name="promjeni" value="Promjeni" />
	<input type="reset" id="dugme" value="Reset" /></td></tr>
</table>
</form></center>
<?php }

	//ispis sastojaka recepta
	echo "<br /><center><h4>Sastojci recepta</h4></center>";
while(list($s_id, $kolicina, $sastojak)= mysqli_fetch_array($rssastojci)) {

	//brisanje sastojka recepta
	if(isset($_POST['ukloni'])) {
	$sast_id = $_POST['s_id'];
	$sqlbrisanje = "DELETE FROM sastojak_recepta WHERE recept_id = $recept_id AND sastojak_id = $sast_id";
	$rsbrisanje = mysqli_query($link, $sqlbrisanje);
	header("Location: " . $_SERVER['REQUEST_URI']);
	exit();
	}

echo "<center><table><tr><td align='right'>$kolicina</td> <td align='middle'>$sastojak</td>
	<td><form method='post'><input type='hidden' name='s_id' value='$s_id'/>
	<input type='submit' name='ukloni' value='Delete' /></form></td></tr></table></center>";

}
?>
<br /><center><h3>Dodajte sastojke</h3><form method="post"  action="">
<table border="1" cellspacing="2" cellpadding="1" >
<tr>
	<td><label for="sastojak"> Sastojci: </label></td>
	<td>
<select name="sastojak_recepta">
	<?php while($row = mysqli_fetch_array($rs2)) {

        echo '<option value="'.$row['sastojak_id'].'" >'.$row['naziv'].'</option>';

   } ?>
</select></td></tr>
<tr><td><label for="kolicina" >Kolicina: </label></td>
	<td><input name="kolicina" type="text" /></td></tr>
<tr><td align="middle" colspan="2"><input type="submit" id="dugme" name="promjeni2" value="Dodaj" /></tr>
</table>
</form></center>
<br />

<center><h3>Novi sastojak</h3><form method="post"  action="">
<table border="1" cellspacing="2">
	<tr>
	<td><label for="n_sastojak"> Naziv sastojka: </label></td>
	<td><input name="n_sastojak" type="text" /></td></tr>
	<tr>
	<td><label for="slika_sastojak"> Slika sastojka: </label></td>
	<td><input name="slika_sastojak" type="text" /></td></tr>
	<tr><td align="middle" colspan="2"><input id="dugme" type="submit" name="dodaj" value="Posalji sastojak" /></td></tr>
</table></form></center>

<?php
	echo "<br/><center><i>Obrisi recept (prvo je potrebno ukloniti sve sastojke recepta): </i>
	<form method='post'><input id='vazno' type='submit' name='brisanje' value='Delete' /></form></center>";
}

include ('footer.php');
ob_end_flush();
 ?>
