<?php
include("../baza.class.php");

$baza = new Baza();
$baza->spojiDB();

$sql_upit_korisnici = "SELECT * FROM korisnici";
$korisnici = $baza->selectDB($sql_upit_korisnici);

$head = "<thead>" . "<tr>" . "<th>Korisnicko ime</th>" . "<th>Ime</th>" . "<th>Prezime</th>" . "<th>Email</th>" . "<th>Lozinka</th>" . "</tr>" . "</thead>";
$table = "";

while ($row = $korisnici->fetch_assoc()) {
    $table = $table . "<tr> <td>" . $row["korisnicko_ime"] . "</td>" . "<td>" . $row["ime"] . "</td>" . "<td>" . $row["prezime"] . "</td>" . "<td>" . $row["email"] . "</td>" . "<td>" . $row["lozinka"] . "</td> </tr>";
}

$baza->zatvoriDB();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../dizajn.css">
    <link href="https://fonts.googleapis.com/css?family=Catamaran" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10/datatables.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="../provjere.js"></script>


    <title>Ispis korisnika</title>
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
                <li><a href="../index.php">Početna</a></li>
                <li><a href="../prijava.php">Prijava</a></li>
                <li><a href="../registracija.php">Registracija</a></li>
                <li><a href="../popisHotela.html">Popis hotela</a></li>
                <li><a href="../popisSoba.html">Popis soba</a></li>
                
            </ul>
        </nav>
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
            <tbody>
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
