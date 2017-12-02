<!DOCTYPE html>
<?php
include ('bazapodataka.php');

 function Logout ()	{
	session_start();
	if (isset ( $_SESSION['aktivni_korisnik'] ))
			//ako se korisnik logira ispisi mogucnost logouta, i promjene osobnih podataka
		{
	echo "Logirani ste kao korisnik <b id='korisnik'>" . $_SESSION['aktivni_korisnik'] . "</b>";
	echo "&nbsp;" .  "<a href='?log=out' id='odjava'  > Logout </a> ";
			//ako je prijavljeni korisnik administrator, omoguci pristup administraciji
	if ($_SESSION['aktivni_korisnik_tip'] == 0) {
	echo "&nbsp;" .  "<a href='korisnici.php' id='odjava'> Administracija </a> ";
} 	else {echo "&nbsp;" .  "<a href='korisnik.php' id='odjava'> Uredi moje podatke </a> ";}
	}

if(isset($_GET['log']) && ($_GET['log']=='out')){
        //ako se korisnik odlogira, ukloni session podatke
	session_destroy();

	header('location:login.php');
}
}

?>

<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" >
<meta name="viewport" content="width=device-width, initial-scale=1" >
<meta name="author" content="Matko Blazevic"/>
<meta http-equiv="content-type" content="text/html;charset=windows-1250" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />

<title>IWA_2013_VZ_PROJEKT</title>

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/iwa2013.css">

<div class="container" id="loginLine">
	<div class="row" >
		<div class="col-md-5"></div>
		<div class="col-md-7" align="right" > <?php Logout(); ?> </div>
	</div>
</div>

</head>
<div class="container">

	<div class="row">

		<div class="col-md-3">
		<a href="index.php">
		<img src="http://localhost/iwa2017/slike/banner.jpg" class="rounded-circle" name="logo" alt="Logo" height="240" width="240">
		</a></div>
	<div>
		<div class="col-md-9"><h1 id="mainTitle">Projektni zadatak - Kuharica</h1></div>
	</div>
</div></div>

  <div class="container-fluid">
    <nav>
	   <div class="row">

	      <div class="col-md-10" >
          <ul class="nav nav-pills nav-justified" role="tablist" id='izbornik'>

	<?php

	otvoriBP();

	//odabir kategorija za izbornik
	$sql = "SELECT kategorija_id, naziv FROM kategorija";
	$res = mysqli_query($link, $sql);

	while(list($kategorija_id, $naziv) = mysqli_fetch_row($res)) {

echo "<li class='nav-item' ><a class='nav-link' href='recepti.php?ref=$kategorija_id' >$naziv </a></li>";

 }  ?>

          </ul>
        </div>
        <div class="col-md-2" id="datum"><?php echo date("d.m.Y"); ?></div>
      </div>
    </nav>
    </div>

<body>
<div id="sadrzaj" >
