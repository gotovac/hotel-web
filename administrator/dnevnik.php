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

$sqlAktivnosti = "SELECT * FROM dnevnik";
$aktivnosti = $baza->selectDB($sqlAktivnosti);

$head = "<thead>" . "<tr>" . "<th>Aktivnost</th>" . "<th>Korisnik</th>" . "<th>Vrijeme</th>" . "<th>Opis aktivnosti</th>" . "</tr>" . "</thead>";
$table = "";

while ($row = $aktivnosti->fetch_assoc()) {
    $table = $table . "<tr> <td>" . $row["aktivnost"] . "</td>" . "<td>" . $row["korisnik"] . "</td>" . "<td>" . $row["vrijeme"] . "</td>" . "<td>" . $row["opis"] . "</td>" . "</tr>";
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


    <title>Dnevnik aktivnosti</title>
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
