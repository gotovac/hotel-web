<?php

include("../sesija.class.php");

Sesija::kreirajSesiju();

if (isset($_SESSION["korisnik"])) {
    if ($_SESSION["uloga"] == 'moderator') {
        header("Location: moderator/index.php");
    }
    if ($_SESSION["uloga"] == 'user') {
        header("Location: user/index.php");
    }
}

include("../baza.class.php");
$baza = new Baza();
$baza->spojiDB();
$oglasi = array();

$sqlOglasi = "SELECT oglasi.oglas_id, oglasi.status, oglasi.pocetak, oglasi.url, oglasi.slika_url, tip_oglasa.trajanje as Trajanje, tip_oglasa.cijena as Cijena, tip_oglasa.brzina as Brzina, pozicije_oglasa.lokacija as Lokacija, pozicije_oglasa.sirina as Sirina, pozicije_oglasa.visina as Visina FROM oglasi, tip_oglasa, pozicije_oglasa WHERE oglasi.oglasi_id_oglas = tip_oglasa.id_oglas AND tip_oglasa.pozicije_oglasa_id_pozicija = pozicije_oglasa.id_pozicija AND oglasi.status = 'Aktivan'";
$aktivniOglasi = $baza->selectDB($sqlOglasi);
while($row = $aktivniOglasi->fetch_assoc()) {
    array_push($oglasi, $row);
}

header('Content-Type: application:/json');
echo json_encode($oglasi);
$baza->zatvoriDB();