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

$sqlHoteli = "SELECT hoteli.id_hotel as HotelID, hoteli.naziv as HotelNaziv, hoteli.adresa as HotelAdresa FROM hoteli, korisnici, moderacija_hotela WHERE korisnici.id_korisnik = '" . $id_kor . "' AND 
hoteli.id_hotel = moderacija_hotela.hoteli_id_hotel AND korisnici.id_korisnik = moderacija_hotela.korisnici_id_korisnik";
$hoteli = $baza->selectDB($sqlHoteli);

$head = "<thead>" . "<tr>" . "<th>Hotel ID</th>" . "<th>Naziv</th>" . "<th>Adresa</th>" . "<th></th>" . "</tr>" . "</thead>";
$table = "";

while ($row = $hoteli->fetch_assoc()) {
    $table = $table . "<tr> <td>" . $row["HotelID"] . "</td>" . "<td>" . $row["HotelNaziv"] . "</td>" . "<td>" . $row["HotelAdresa"] . "</td>" . "<td><a href='novaSoba.php?id=" . $row["HotelID"] . "'>Dodaj sobu</a></td>" . "</tr>";
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

    <title>Moji hoteli</title>
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
