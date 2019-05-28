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

$sqlKorisnik = "SELECT * FROM korisnici WHERE korisnicko_ime = '" . $_SESSION["korisnik"] . "'";
$korisnik = $baza->selectDB($sqlKorisnik);
while($row = $korisnik->fetch_assoc()) {
    $id_kor = $row["id_korisnik"];
    $kor = $row["korisnicko_ime"];
}

$sqlOglasi = "SELECT oglasi.oglas_id, oglasi.naziv, oglasi.status, oglasi.pocetak, oglasi.url, oglasi.slika_url, oglasi.opis, pozicije_oglasa.id_pozicija as Pozicija FROM oglasi, tip_oglasa, moderacija_pozicije, korisnici, pozicije_oglasa WHERE oglasi.status = 'U obradi' AND oglasi.oglasi_id_oglas = tip_oglasa.id_oglas AND tip_oglasa.pozicije_oglasa_id_pozicija = pozicije_oglasa.id_pozicija AND tip_oglasa.pozicije_oglasa_id_pozicija = moderacija_pozicije.pozicije_oglasa_id_pozicija AND moderacija_pozicije.korisnici_id_korisnik = '" . $id_kor . "' GROUP BY 1";
$oglasi = $baza->selectDB($sqlOglasi);

$head = "<thead>" . "<tr>" . "<th>Oglas ID</th>" . "<th>Naziv</th>" . "<th>ID Pozicije</th>" . "<th>URL</th>" . "<th>Slika URL</th>" . "<th>Opis</th>" . "<th></th>" . "<th></th>" . "</tr>" . "</thead>";
$table = "";

while ($row = $oglasi->fetch_assoc()) {
    $table = $table . "<tr> <td>" . $row["oglas_id"] . "</td>" . "<td>" . $row["naziv"] . "</td>" . "<td>" . $row["Pozicija"] . "</td>" . "<td>" . $row["url"] . "</td>" . "<td>" . $row["slika_url"] . "</td>" . "<td>" . $row["opis"] . "</td>" . "<td><a href='obradaZahtjeva.php?id=" . $row["oglas_id"] . "&obrada=1'>Prihvati</a></td>" . "<td><a href='obradaZahtjeva.php?id=" . $row["oglas_id"] . "&obrada=0'>Odbij</a></td>" . "</tr>";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="dizajn.css">
    <link href="https://fonts.googleapis.com/css?family=Catamaran" rel="stylesheet">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.10/cookieconsent.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10/datatables.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="../js/oglasi.js"></script>

    <title>Zahtjevi za oglas</title>
</head>

<body>
    <div class="wrapper">
        <!--       Banner-->
        <header class="banner">
            <h1 class="naslov">Projekt Hotel</h1>
        </header>
        <a id="odjava" href="odjava.php" class="button">Odjava</a>
        <!--Navigacija-->
        <nav class="main">
            <ul>
                <li><a href="index.php">Početna</a></li>
                <li><a href="novaVrsta.php">Novi vrsta oglasa</a></li>
                <li><a href="oglasZahtjevi.php">Zahtjevi za oglas</a></li>
                <li><a href="blokZahtjevi.php">Zahtjevi za blokiranje</a></li>
                <li><a href="mojiHoteli.php">Moji hoteli</a></li>
                <li><a href="novaRezervacija.php">Nova rezervacija</a></li>
            </ul>
        </nav>
        <!--Glavni kontejner-->
        <section class="container">
        <script type="text/javascript">
            $(document).ready(function() {
                $('#tablica').DataTable();
            }); 
        </script>
        <table id="tablica">
            <?php
                echo $head;
            ?>
            <tbody style="text-align:center">
                <?php
                    echo $table;
                ?>
            </tbody>
        </table>
        </section>
        
        <!--        Footer-->
        <footer>
            <p>Luka Gotovac &copy; 2018</p>
        </footer>
    </div>
</body>

</html>
