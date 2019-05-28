<?php

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



include("baza.class.php");
$baza = new Baza();
$baza->spojiDB();

$sqlHoteli = "SELECT * FROM hoteli";
$hoteli = $baza->selectDB($sqlHoteli);

$head = "<thead>" . "<tr>" . "<th>Naziv</th>" . "<th>Adresa</th>" . "<th>Ocjena</th>" . "<th>Sobe</th>" . "</tr>" . "</thead>";
$table = "";

while ($row = $hoteli->fetch_assoc()) {
    $table = $table . "<tr> <td>" . $row["naziv"] . "</td>" . "<td>" . $row["adresa"] . "</td>" . "<td>" . $row["ocjena"] . "</td>" . "<td><a href='odabraniHotel.php?id=" . $row["id_hotel"] . "'>Detalji</a></td> </tr>";
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
    <script src="js/oglasi-ph.js"></script>


    <title>Popis hotela</title>
</head>

<body>
    <div class="wrapper">
        <!--       Banner-->
        <header class="banner">
            <h1 class="naslov">Projekt Hotel</h1>
        </header>
        <!--Navigacija-->
        <nav class="main">
            <ul>
                <li><a href="index.php">Početna</a></li>
                <li><a href="prijava.php">Prijava</a></li>
                <li><a href="registracija.php">Registracija</a></li>
                <li><a href="popisHotela.php">Popis hotela</a></li>
                <li><a href="popisSoba.php">Popis soba</a></li>
                <li><a href="dokumentacija.html">Dokumentacija</a></li>
                <li><a href="O_Autoru.html">O autoru</a></li>
                
            </ul>
        </nav>
        <!--        Hotel blokovi-->
        <div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'hr', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        <section class="container">
        <script type="text/javascript">
            $(document).ready(function() {
                $('#tablica').DataTable({
                    responsive: true
                });
            });
        </script>
        <table id="tablica" class="tab">
            <?php
                echo $head;
            ?>
            <tbody>
                <?php
                    echo $table;
                ?>
            </tbody>
        </table>
        </section>
        
<!--        Oglasi-->
        <h2>Oglasi</h2>
        <div id="popisoglasa2">
            <div id="oglas4"></div>
            <p id="kupiOglas4"></p>
            <div id="oglas5"></div>
            <p id="kupiOglas5"></p>
            <div id="oglas6"></div>
            <p id="kupiOglas6"></p>
        </div>

        <script type="text/javascript">
            function klikanje(id) {
                window.location.href = "klikovi.php?oglas_id=" + id + "&back=popisHotela";
            }
        </script>
        
        <!--        Footer-->
        <footer>
            <p>Luka Gotovac &copy; 2018</p>
        </footer>
    </div>
</body>

</html>
