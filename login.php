<?php
	include ('header.php');

		//ako je uneseno korisnicko ime
	if (isset($_POST['korisnicko_ime'])) {

		$korisnicko_ime = mysqli_real_escape_string($link, $_POST['korisnicko_ime']);
		$lozinka = mysqli_real_escape_string($link, $_POST['lozinka']);
		if (!empty($korisnicko_ime) && !empty($lozinka)) {

			//provjera da li uneseno korisnicko ime i lozinka postoje u bazi
			$sql = "SELECT korisnik_id, tip_id, ime, prezime FROM korisnik WHERE korisnicko_ime='$korisnicko_ime' AND lozinka = '$lozinka'";
			$rs = mysqli_query($link, $sql);
			//ako nema podudaranja izbaci pogresku
			if(mysqli_num_rows($rs) == 0) {
				$error = "Ne postoji korisnik s navedenim usernameom i passwordom";
			} else {
				//zapisi potrebne podatke u session
				session_start();
				list($id, $tip_id, $ime, $prezime) = mysqli_fetch_array($rs);
				$_SESSION['korisnik_id'] = $id;
				$_SESSION['aktivni_korisnik'] = $korisnicko_ime;
				$_SESSION['aktivni_korisnik_ime'] = $ime . " " . $prezime;
				$_SESSION['aktivni_korisnik_tip'] = $tip_id;
				header("Location:index.php");
			}
			mysqli_close($link);
		} else {
			$error = "Unesite korisnicko ime i lozinku";
		}
	}

?>

<center>
<h2>Login</h2><br><br>
<form method="post" action="login.php">
	<table  id="login">
		<tr>
			<td><label for="korisnicko_ime">Username:</label></td>
			<td><input type="text" name="korisnicko_ime" maxlength="25" /></td>
		</tr>
		<tr>
			<td><label for="lozinka">Password:</label></td>
			<td><input type="password" name="lozinka" maxlength="25"/></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><br><input id="vazno" type="submit" class="green" value="Prijava" /></td>
		</tr>
	</table>
</form></center><br><br>

<?php
global $error;
 echo "<center><b> $error </b></center>";
include ("footer.php");
?>
