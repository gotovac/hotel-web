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

$sqlZahtjevi = "SELECT zahtjevi_za_blok.id_blokzahtjev, zahtjevi_za_blok.id_zahtjevatelja, zahtjevi_za_blok.opis_razloga, zahtjevi_za_blok.status, zahtjevi_za_blok.datum, zahtjevi_za_blok.oglasi_id_oglas ,oglasi.naziv as Naziv, korisnici.korisnicko_ime as Korime FROM zahtjevi_za_blok, oglasi, korisnici WHERE zahtjevi_za_blok.oglasi_id_oglas = oglasi.oglas_id AND zahtjevi_za_blok.id_zahtjevatelja = korisnici.id_korisnik";
$zahtjevi = $baza->selectDB($sqlZahtjevi);


$head = "<thead>" . "<tr>" . "<th>Zahtjev ID</th>" . "<th>Naziv oglasa</th>" . "<th>Zahtjevatelj</th>" . "<th>Razlog</th>" . "<th>Status</th>" . "<th>Datum</th>" . "<th></th>" . "<th></th>" . "</tr>" . "</thead>";
$table = "";

while ($row = $zahtjevi->fetch_assoc()) {
    $table = $table . "<tr> <td>" . $row["id_blokzahtjev"] . "</td>" . "<td>" . $row["Naziv"] . "</td>" . "<td>" . $row["Korime"] . "</td>" . "<td>" . $row["opis_razloga"] . "</td>" . "<td>" . $row["status"] . "</td>" . "<td>" . $row["datum"] . "</td>" . "<td><a href='blokiranjeOglasa.php?idoglas=" . $row["oglasi_id_oglas"] . "&idzahtjev=" . $row["id_blokzahtjev"] . "&blok=1'>Prihvati</a></td>" . "<td><a href='blokiranjeOglasa.php?idoglas=" . $row["oglasi_id_oglas"] . "&idzahtjev=" . $row["id_blokzahtjev"] ."&blok=0'>Odbij</a></td>" . "</tr>";
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

    <title>Zahtjevi za blokiranje oglasa</title>
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
