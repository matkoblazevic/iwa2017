<?php

include ('header.php');


	if(isset($_POST['korisnicko_ime'])) {

		$korisnicko_ime=$_POST['korisnicko_ime'];
		$lozinka=$_POST['lozinka'];
		$ime=$_POST['ime'];
		$prezime=$_POST['prezime'];
		$email=$_POST['email'];
		$slika='korisnici/' . $_POST['slika'];

		//dodavanje novog korisnika, samo administrator to moze
		if($_SESSION['aktivni_korisnik_tip']==0) {
		$tip_id=$_POST['tip_id'];
			$sql = "INSERT INTO korisnik (korisnik_id, tip_id, korisnicko_ime, lozinka, ime, prezime, email, slika)
			VALUES ('NULL', '$tip_id', '$korisnicko_ime', '$lozinka', '$ime', '$prezime', '$email', '$slika')";
		$rs = mysqli_query($link, $sql);
		if(! $rs) { $msg = "Korisnik nije dodan";}
		else {$msg = "Korisnik uspjesno dodan";}

		}

		//uredivanje, azuriranje podataka kod obicnih korisnika i moderatora
		else if($_SESSION['aktivni_korisnik_tip']==2 || $_SESSION['aktivni_korisnik_tip']==1) {
			$tip_id = $_SESSION['aktivni_korisnik_tip'];
			$korisnik_id = $_SESSION['korisnik_id'];

			$sql = "UPDATE `korisnik`
			SET	`korisnicko_ime`='$_POST[korisnicko_ime]',
				`lozinka`='$_POST[lozinka]',
				`ime`='$_POST[ime]',
				`prezime`='$_POST[prezime]',
				`email`='$_POST[email]',
				`slika`='$slika'
			WHERE `korisnik_id`='$korisnik_id'
			AND `tip_id`='$tip_id'";

		$rs = mysqli_query($link, $sql);
		if(! $rs) { $msg = "Korisnik nije azuriran";}
		else {$msg = "User added";}
		}

	}


?>

<center><h3>Unesite nove podatke</h3><br />
<form method="post" action="korisnik.php" name="korisnik" onsubmit="return provjeraUnosaKorisnika();">
	<input type="hidden" name="novi" />
	<table class="unos_korisnika">
	<tr>
		<td><label for="korisnicko_ime">Username:</label></td>
		<td><input type="text" name="korisnicko_ime" maxlength="25" size="20"
			<?php
			if ($_SESSION['aktivni_korisnik_tip']==2 || $_SESSION['aktivni_korisnik_tip']==1) {
			echo "readonly='readonly'";
			echo "value='$_SESSION[aktivni_korisnik]'"; } ?> /></td>
	</tr>
    <tr>
		<td><label for="lozinka" >Password:</label></td>
		<td><input type="text" name="lozinka" maxlength="25" size="20" /></td>
	</tr>
	<tr>
		<td><label for="ime">Ime:</label></td>
		<td><input type="text" name="ime" maxlength="20" size="20" /></td>
	</tr>
	<tr>
		<td><label for="prezime">Prezime:</label></td>
		<td><input type="text" name="prezime" maxlength="25" size="20" /></td>
	</tr>
	<?php
		if($_SESSION['aktivni_korisnik_tip']==0) {
	?>
		<tr>
			<td>Tip korisnika:</td>
				<td><select name="tip_id">
				<option value="0" >Administrator</option>
				<option value="1" >Moderator</option>
				<option value="2" selected>Korisnik</option>
				</select></td>
		</tr>
	<?php
		}
	?>
		<tr>
			<td><label for="email">email:</label></td>
			<td><input type="text" name="email" /></td>
		</tr>
		<tr>
			<td><label for="slika">Slika:</label></td>
			<td><input type="file" name="slika"  /></td>
		</tr>
		<tr>
			<td align="middle" colspan="2"><input id="dugme" type="submit" value="Send" />
			<input id="dugme" type="reset" value="Reset"/></td>
		</tr>
	</table>
</form>
</center>

<?php
global $msg;
 echo "<center><b>$msg</b></center>";
zatvoriBP();
include ('footer.php'); ?>
