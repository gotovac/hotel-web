<?php
include("../sesija.class.php");
include("../baza.class.php");

Sesija::kreirajSesiju();

if (isset($_SESSION["korisnik"])) {
    if ($_SESSION["uloga"] == 'user') {
        header("Location: ../user/index.php");
    }
    if ($_SESSION["uloga"] == 'moderator') {
        header("Location: ../moderator/index.php");
    }
}

$baza = new Baza();
$baza->spojiDB();

$aktivnost = "Odjava";
$vrijemeAktivnosti = date("Y/m/d H:i:s");
$sqlUnosZapisa = "INSERT INTO `dnevnik`(`aktivnost`, `vrijeme`, `opis`) VALUES
        ('" . $aktivnost . "', '" . $vrijemeAktivnosti . "', 'Korisnik " . $_SESSION["korisnik"] . " se odjavio')";

$rez = $baza->selectDB($sqlUnosZapisa);
if(isset($_COOKIE["Login"])) {
    unset($_COOKIE["Login"]);
}
Sesija::obrisiSesiju();
$baza->zatvoriDB();
header("Location: ../index.php");
