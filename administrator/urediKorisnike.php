<?php
include("../sesija.class.php");

Sesija::kreirajSesiju();

if (isset($_SESSION["korisnik"])) {
    if ($_SESSION["uloga"] == 'user') {
        header("Location: user/index.php");
    }
    if ($_SESSION["uloga"] == 'moderator') {
        header("Location: moderator/index.php");
    }
}

include("../baza.class.php");
$baza = new Baza();
$baza->spojiDB();
$kor = "";
$id_kor = "";

$sqlUser = "SELECT * FROM korisnici WHERE korisnicko_ime = '" . $_SESSION["korisnik"] . "'";
$user = $baza->selectDB($sqlUser);
while($row = $user->fetch_assoc()) {
    $kor = $row["korisnicko_ime"];
}

if (isset($_GET["id"]) && isset($_GET["opcija"])) {
    $id_kor = $_GET["id"];
    $opcija = $_GET["opcija"];
}

$sqlKorisnik = "SELECT * FROM korisnici WHERE id_korisnik = '" . $id_kor . "'";
$korisnik = $baza->selectDB($sqlKorisnik);
if (mysqli_num_rows($korisnik) > 0) {
    if ($opcija == '0') {
        $sqlOtkljucaj = "UPDATE korisnici SET status = '1', kriviUnosi = '0' WHERE id_korisnik = '" . $id_kor . "'";
        $baza->selectDB($sqlOtkljucaj);
        
        $vrijemeAktivnosti = date("Y/m/d H:i:s");
        $aktivnost = "Otkljucan korisnik";
        $opisAktivnosti = "Otkljucan je racun korisnika sa ID: " . $id_kor;
        $sqlUnosZapisa = "INSERT INTO `dnevnik`(`aktivnost`, `korisnik`,`vrijeme`, `opis`) VALUES 
        ('" . $aktivnost . "', '" . $kor . "' , '" . $vrijemeAktivnosti . "', '" . $opisAktivnosti . "')";
        $baza->selectDB($sqlUnosZapisa);
        
        header("Location: racuni.php");
    }
    if ($opcija == '1') {
        $sqlZakljucaj = "UPDATE korisnici SET status = '0' WHERE id_korisnik = '" . $id_kor . "'";
        $baza->selectDB($sqlZakljucaj);
        
        $vrijemeAktivnosti = date("Y/m/d H:i:s");
        $aktivnost = "Zakljucan korisnik";
        $opisAktivnosti = "Zakljucan je racun korisnika sa ID: " . $id_kor;
        $sqlUnosZapisa = "INSERT INTO `dnevnik`(`aktivnost`, `korisnik`,`vrijeme`, `opis`) VALUES 
        ('" . $aktivnost . "', '" . $kor . "' , '" . $vrijemeAktivnosti . "', '" . $opisAktivnosti . "')";
        $baza->selectDB($sqlUnosZapisa);
        
        header("Location: racuni.php");
    }
    else {
    header("Location: racuni.php");
    }
}

$baza->zatvoriDB();