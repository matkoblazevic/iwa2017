<?php

$username = 'iwa_2011';
$password = 'FOI';
$baza = 'iwa_vz_projekt';

function otvoriBP() {

global $username;
global $password;
global $baza;
global $link;

//spajanje na server
$link = mysqli_connect ("localhost", $username, $password, $baza);
if (!$link) {
	echo "Problem sa spajanjem na server!";
	exit;
}

if (!mysqli_set_charset ($link, "cp1250")) {
	echo "Problem kod postavljanja charset tipa utf-8!";
	exit();
}
}
//zatvaranje
function zatvoriBP() {
global $link;
mysqli_close($link); }
?>
