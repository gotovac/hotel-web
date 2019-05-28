<?php
include("baza.class.php");
include("sesija.class.php");

Sesija::kreirajSesiju();

if (isset($_SESSION["korisnik"])) {
    if ($_SESSION["uloga"] == 'user') {
        header("Location: user/index.php");
    }
    if ($_SESSION["uloga"] == 'moderator') {
        header("Location: moderator/index.php");
    }
    if ($_SESSION["uloga"] == 'administrator') {
        header("Location: administrator/index.php");
    }
}

$baza = new Baza();
$baza->spojiDB();

$korime = "";
$kod = "";

if(isset($_GET["korime"]) && isset($_GET["kod"])) {
    $korime = $_GET["korime"];
    $kod = $_GET["kod"];
    $sqlUpit = "SELECT * FROM korisnici WHERE korisnicko_ime = '" . $korime . "' AND kript_lozinka = '" . $kod . "'";
    $redovi = $baza->selectDB($sqlUpit);
    if(mysqli_num_rows($redovi) > 0) { 
        $sqlAktivacija = "UPDATE korisnici SET status = '1' WHERE korisnicko_ime = '" . $korime . "'";
        $aktivacija = $baza->selectDB($sqlAktivacija);
        header("Location: prijava.php");
    }
    else {
        header("Location: index.php");
    }
}


$baza->zatvoriDB();