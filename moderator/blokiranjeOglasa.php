<?php
include("../sesija.class.php");

Sesija::kreirajSesiju();

if (isset($_SESSION["korisnik"])) {
    if ($_SESSION["uloga"] == 'user') {
        header("Location: user/index.php");
    }
    if ($_SESSION["uloga"] == 'administrator') {
        header("Location: administrator/index.php");
    }
}

include("../baza.class.php");
$baza = new Baza();
$baza->spojiDB();

$blok = "";

if(isset($_GET["idoglas"]) && isset($_GET["blok"]) && isset($_GET["idzahtjev"])) {
    $id_oglas = $_GET["idoglas"];
    $blok = $_GET["blok"];
    $id_zahtjev = $_GET["idzahtjev"];
}

$sqlKorisnik = "SELECT * FROM korisnici WHERE korisnicko_ime = '" . $_SESSION["korisnik"] . "'";
$korisnik = $baza->selectDB($sqlKorisnik);
while($row = $korisnik->fetch_assoc()) {
    $id_kor = $row["id_korisnik"];
    $kor = $row["korisnicko_ime"];
}

if($blok == '1') {
    $sqlBlokiraj = "UPDATE oglasi SET status = 'Blokiran' WHERE oglas_id = '" . $id_oglas . "'";
    $baza->selectDB($sqlBlokiraj);
    
    $sqlZahtjevP = "UPDATE zahtjevi_za_blok SET status = 'Prihvacen' WHERE id_blokzahtjev = '" . $id_zahtjev . "'";
    $baza->selectDB($sqlZahtjevP);
    
    $vrijemeAktivnosti = date("Y/m/d H:i:s");
    $aktivnost = "Prihvacen zahtjev i blokiranje oglasa";
    $opisAktivnosti = "Zahtjev za blokiranje ID:" . $id_zahtjev . " je prihvacen i blokiran je";
    $sqlUnosZapisa = "INSERT INTO `dnevnik`(`aktivnost`, `korisnik`, `vrijeme`, `opis`) VALUES 
    ('" . $aktivnost . "', '" . $kor . "' , '" . $vrijemeAktivnosti . "', '" . $opisAktivnosti . "')";
    $baza->selectDB($sqlUnosZapisa);
    header("Location: blokZahtjevi.php");
}

if($blok == '0') {
    $sqlZahtjevO = "UPDATE zahtjevi_za_blok SET status = 'Odbijen' WHERE id_blokzahtjev = '" . $id_zahtjev . "'";
    $baza->selectDB($sqlZahtjevO);
    
    $vrijemeAktivnosti = date("Y/m/d H:i:s");
    $aktivnost = "Odbijen zahtjev za blokiranje oglasa";
    $opisAktivnosti = "Zahtjev za blokiranje ID:" . $id_zahtjev . " je odbijen";
    $sqlUnosZapisa = "INSERT INTO `dnevnik`(`aktivnost`, `korisnik`, `vrijeme`, `opis`) VALUES 
    ('" . $aktivnost . "', '" . $kor . "' , '" . $vrijemeAktivnosti . "', '" . $opisAktivnosti . "')";
    $baza->selectDB($sqlUnosZapisa);
    header("Location: blokZahtjevi.php");
}

$baza->zatvoriDB();