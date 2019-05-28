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

if(isset($_GET["id"]) && isset($_GET["obrada"])) {
    $id_oglas = $_GET["id"];
    $obrada = $_GET["obrada"];
}

$sqlKorisnik = "SELECT * FROM korisnici WHERE korisnicko_ime = '" . $_SESSION["korisnik"] . "'";
$korisnik = $baza->selectDB($sqlKorisnik);
while($row = $korisnik->fetch_assoc()) {
    $id_kor = $row["id_korisnik"];
    $kor = $row["korisnicko_ime"];
}

if($obrada == '0') {
    $sqlOdbij = "UPDATE oglasi SET status = 'Odbijen' WHERE oglas_id = '" . $id_oglas . "'";
    $baza->selectDB($sqlOdbij);
    
    $vrijemeAktivnosti = date("Y/m/d H:i:s");
    $aktivnost = "Odbijen zahtjev za oglas";
    $opisAktivnosti = "Zahtjev za oglas ID:" . $id_oglas . " je odbijen";
    $sqlUnosZapisa = "INSERT INTO `dnevnik`(`aktivnost`, `korisnik`, `vrijeme`, `opis`) VALUES 
    ('" . $aktivnost . "', '" . $kor . "' , '" . $vrijemeAktivnosti . "', '" . $opisAktivnosti . "')";
    $baza->selectDB($sqlUnosZapisa);
    header("Location: oglasZahtjevi.php");
}

if($obrada == '1') {
    $sqlPrihvati = "UPDATE oglasi SET status = 'Aktivan' WHERE oglas_id = '" . $id_oglas . "'";
    $baza->selectDB($sqlPrihvati);
    
    $vrijemeAktivnosti = date("Y/m/d H:i:s");
    $aktivnost = "Prihvacen zahtjev za oglas";
    $opisAktivnosti = "Zahtjev za oglas ID:" . $id_oglas . " je prihvacen";
    $sqlUnosZapisa = "INSERT INTO `dnevnik`(`aktivnost`, `korisnik`, `vrijeme`, `opis`) VALUES 
    ('" . $aktivnost . "', '" . $kor . "' , '" . $vrijemeAktivnosti . "', '" . $opisAktivnosti . "')";
    $baza->selectDB($sqlUnosZapisa);
    
    header("Location: oglasZahtjevi.php");
}

$baza->zatvoriDB();