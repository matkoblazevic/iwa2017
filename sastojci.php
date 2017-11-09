<?php
include ('header.php');

if ($_SESSION['aktivni_korisnik_tip'] == 0) {

	?>

	<center><h3>Novi sastojak</h3><form method="post"  action="">
	<table border="1" cellspacing="2">
	<tr>
	<td><label for="n_sastojak"> Naziv sastojka: </label></td>
	<td><input name="n_sastojak" type="text" /></td></tr>
	<tr>
	<td><label for="slika_sastojak"> Slika sastojka: </label></td>
	<td><input name="slika_sastojak" type="text" /></td></tr>
	<tr><td align="middle" colspan="2"><input id="dugme" type="submit" name="dodaj" value="Po�alji sastojak" /></td></tr>
	</table></form></center>

<?php
	echo "<center><h2>Uredi sastojke</h2></center>";

	//novi sastojak
	if (isset($_POST['dodaj'])) {

	$sql = "INSERT INTO sastojak (sastojak_id, naziv, slika)
			VALUES (NULL,'$_POST[n_sastojak]','$_POST[slika_sastojak]')";
	$rs = mysqli_query($link, $sql);

		header("Location: " . $_SERVER['REQUEST_URI']);
		exit();
	}

	//odabir i ispis svih sastojaka sa slikama, mogu�nost promjene slike i brisanje sastojka
	$que = "SELECT sastojak_id, naziv, slika FROM sastojak";
	$rs = mysqli_query($link, $que);

		echo "<br /><center><table cellspacing='2' cellpadding='2' border='1' >";
		echo"<tr><th>Naziv sastojka</th><th>Slika sastojka</th><th colspan='2'>Promijeni sliku</th><th>Obrisi sastojak</th></tr>";

	while(list($sastojak_id, $naziv, $slika) = mysqli_fetch_array($rs)) {

			 //promjena slike sastojka
	if (isset($_POST['promjena'])) {
	$nslika=$_POST['nslika'];
	$s_id=$_POST['sastojak_id'];

	$que2 = "UPDATE `sastojak` SET
			`slika`='" . mysqli_real_escape_string($nslika) . "'
			WHERE `sastojak_id`='" . mysqli_real_escape_string($s_id) . "'";
		$rez2 = mysqli_query($link, $que2);
		header("Location: " . $_SERVER['REQUEST_URI']);
		exit();
		}
			//brisanje sastojka iz baze
	if(isset($_POST['brisanje']))	{
	$s_id=$_POST['sastojak_id'];
	$que3 = "DELETE FROM sastojak WHERE sastojak_id = $s_id";
	$rez3 = mysqli_query($link, $que3);
	header("Location: " . $_SERVER['REQUEST_URI']);
		exit();
		}

			//ispis sastojaka
		echo "<tr><td>$naziv</td><td><img src='$slika' height='200' width='320' /></td><form method='post'>
		<td><input name='nslika' value='$slika' /></td><input type='hidden' name='sastojak_id' value='$sastojak_id' />
		<td><input type='submit' name='promjena' value='Promijeni' />
		</td><td align='middle'><input name='brisanje' type='submit' value='Delete' onclick='return obrisi();' /></td></form></tr>";

	 } 	echo  "</table></center>";

  }
include ('footer.php') ?>
