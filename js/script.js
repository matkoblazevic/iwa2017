function obrisi(){
    let brisanje=confirm("Potvrdite brisanje?");
    if (brisanje==true){ alert ("Podatak obrisan")}
	else{alert("Brisanje ponisteno")}
  return brisanje; }


function provjeraUnosaKorisnika(){
	  let korisnicko_ime = document.korisnik.korisnicko_ime;
    let lozinka = document.korisnik.lozinka;
    let ime = document.korisnik.ime;
    let slika = document.korisnik.slika;

if (korisnicko_ime.value == "")
    {
        alert("Unesite korisnicko ime.");
        korisnicko_ime.focus();
        return false;
    }
if (lozinka.value == "")
    {
        alert("Unesite lozinku.");
        lozinka.focus();
        return false;
    }
if (ime.value == "")
    {
        alert("Unesite ime.");
        ime.focus();
        return false;
    }
if (slika.value == "")
    {
        alert("Odaberite sliku.");
        slika.focus();
        return false;
    }
}
