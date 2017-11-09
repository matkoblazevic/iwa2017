<?php
include ('header.php');

if ($_SESSION['aktivni_korisnik_tip'] == 0) {
  	$korisnik_id = $_GET['user'];

	//selektiraj sve podatke o odabranome korisniku
	$que = "SELECT tip_id, korisnicko_ime, lozinka, ime, prezime, email, slika FROM korisnik
			WHERE korisnik_id = $korisnik_id";

	$result = mysqli_query($link, $que);

	//selekcija naziva i vrijednosti tipa korisnika, slu�i kao opcije kod selekcije
	$que2 = "SELECT tip_id, naziv FROM tip_korisnika";
	$result2 = mysqli_query($link, $que2);

	//azuriranje novih podataka o korisniku, ukoliko su neke informacije promjenjene
	if(isset($_POST['tip_id'])) {
	$tip_id=$_POST['tip_id'];
	$korisnicko_ime=$_POST['korisnicko_ime'];
	$lozinka=$_POST['lozinka'];
	$ime=$_POST['ime'];
	$prezime=$_POST['prezime'];
	$email=$_POST['email'];
	$slika='korisnici/' . $_POST['slika'];
	$korisnik_id = $_POST['korisnik_id'];
	$que3 = "UPDATE `korisnik`
			SET
				`tip_id`='$tip_id',
				`korisnicko_ime`='$korisnicko_ime',
				`lozinka`='$lozinka',
				`ime`='$ime',
				`prezime`='$prezime',
				`email`='$email',
				`slika`='$slika'
			WHERE `korisnik_id`='$korisnik_id'";
		$result3 = mysqli_query($link, $que3);
		header("Location: " . $_SERVER['REQUEST_URI']);
		exit();

}
	//brisanje korisnika iz baze
	if(isset($_POST['brisi'])){
		$delete = "DELETE FROM `korisnik` WHERE korisnik_id = '" . $_POST['id']. "'";
		$obrisi = mysqli_query($link, $delete);
		header("Location: korisnici.php");
		exit();
	}

	//obrazac za aktualne podatke korisnika
		while(list($tip_id, $korisnicko_ime, $lozinka, $ime, $prezime, $email, $slika) = mysqli_fetch_row($result)) {

	echo "Odabrani korisnik je korisnik tipa " . $tip_id;

	?>

	<center><h3>Update info</h3><br /><form name="korisnik" method="post" onsubmit="return provjeraUnosaKorisnika();" >
	<table class="unos_korisnika">
	<input type="hidden"  name="korisnik_id"  value="<?php echo $korisnik_id ?>"/>
	<tr>
		<td>Tip korisnika:</td>
				<td><select name="tip_id" >
				<?php while($row = mysqli_fetch_array($result2)) {
        echo '<option value="'.$row['tip_id'].'" selected="selected" >'.$row['naziv'].'</option>';
   } ?>
		</select></td>
	</tr>
	<tr>
		<td><label for="korisnicko_ime">Username:</label></td>
		<td><input type="text" name="korisnicko_ime" maxlength="25" size="20" value="<?php echo $korisnicko_ime; ?>"/></td>
	</tr>
    <tr>
		<td><label for="lozinka" >Lozinka:</label></td>
		<td><input type="text" name="lozinka" maxlength="25" size="20" value="<?php echo $lozinka; ?>" /></td>
	</tr>
	<tr>
		<td><label for="ime">Ime:</label></td>
		<td><input type="text" name="ime" maxlength="20" size="20" value="<?php echo $ime; ?>" /></td>
	</tr>
	<tr>
		<td><label for="prezime">Prezime:</label></td>
		<td><input type="text" name="prezime" maxlength="25" size="20" value="<?php echo $prezime; ?>" /></td>
	</tr>
	<tr>
		<td><label for="email">email:</label></td>
		<td><input type="text" name="email" value="<?php echo $email; ?>" /></td>
	</tr>
	<tr>
		<td><label for="slika">Slika:</label></td>
		<td><input type="file" name="slika"  value="<?php echo $slika; ?>" /><?php echo "<img src='$slika' width='70' height='100' border='1' />"; ?></td>
	</tr>
	<tr>
		<td align="middle" colspan="2"><input id="dugme" type="submit" value="Update"/><input class="btn btn-warning" type="reset" value="Reset"/></td>
	</tr>
	</table></form></center>

	<center><form action="" method="post">
	<input type="hidden" name="id" value="<?php echo $korisnik_id; ?>" />
	<input type="submit" id="vazno" name="brisi" value="Delete user" onclick="return obrisi();"  /></form></center>

<?php
	}	}

include ('footer.php');
?>
