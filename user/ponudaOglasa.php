<?php

include("../sesija.class.php");

Sesija::kreirajSesiju();

if (isset($_SESSION["korisnik"])) {
    if ($_SESSION["uloga"] == 'administrator') {
        header("Location: administrator/index.php");
    }
    if ($_SESSION["uloga"] == 'moderator') {
        header("Location: moderator/index.php");
    }
}



include("../baza.class.php");
$baza = new Baza();
$baza->spojiDB();

$sqlOglasi = "SELECT * FROM tip_oglasa";
$oglasi = $baza->selectDB($sqlOglasi);

$head = "<thead>" . "<tr>" . "<th>Pozicija</th>" . "<th>Trajanje (u danima)</th>" . "<th>Cijena</th>" . "<th>Brzina</th>" . "<th></th>" . "</tr>" . "</thead>";
$table = "";

while ($row = $oglasi->fetch_assoc()) {
    $table = $table . "<tr> <td>" . $row["naziv"] . "</td>" . "<td>" . $row["trajanje"] . "</td>" . "<td>" . $row["cijena"] . "</td>" . "<td>" . $row["brzina"] . "</td>" . "<td><a href='noviOglas.php?id=" . $row["id_oglas"] . "'>Zatrazi oglas</a></td>" . "</tr>";
}

        
$baza->zatvoriDB();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="dizajn.css">
    <link href="https://fonts.googleapis.com/css?family=Catamaran" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10/datatables.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>


    <title>Ponuda oglasa</title>
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
                <li><a href="aktivniOglasi.php">Aktivni oglasi</a></li>
                <li><a href="ponudaOglasa.php">Ponuda oglasa</a></li>
                <li><a href="mojiZahtjevi.php">Moji zahtjevi</a></li>
                <li><a href="mojiOglasi.php">Moji oglasi</a></li>
            </ul>
        </nav>
        <!--        Hotel blokovi-->
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
