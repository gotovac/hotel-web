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

$sqlKorisnici = "SELECT korisnici.korisnicko_ime, oglasi.naziv, oglasi.opis, oglasi.status, oglasi.broj_klik FROM korisnici, oglasi WHERE korisnici.id_korisnik = oglasi.korisnici_id_korisnik";
$korisnici = $baza->selectDB($sqlKorisnici);
$head =  "<thead>" . "<tr>" . "<th>Naziv</th>" . "<th>Opis</th>" . "<th>Vlasnik oglasa</th>" . "<th>Status</th>" . "<th>Klikovi</th>" . "</tr>" . "</thead>";
$table = "";

while ($row = $korisnici->fetch_assoc()) {
    $table = $table . "<tr> <td>" . $row["naziv"] . "</td>" . "<td>" . $row["opis"] . "</td>" . "<td>" . $row["korisnicko_ime"] . "</td>" . "<td>" . $row["status"] . "</td>" . "<td>" . $row["broj_klik"] . "</td> </tr>";
}

$baza->zatvoriDB();

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

    <title>Klikovi</title>
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
                <li><a href="dnevnik.php">Dnevnik</a></li>
                <li><a href="racuni.php">Korisnicki racuni</a></li>
                <li><a href="statKlikovi.php">Statistika klikova</a></li>
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
