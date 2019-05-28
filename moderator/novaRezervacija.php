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


$sqlSobe = "SELECT * FROM sobe WHERE status = '0'";
$sobe = $baza->selectDB($sqlSobe);
$odabirSobe = "<select id='broj' name='broj'>";
while ($row = mysqli_fetch_array($sobe)) {
    $hotel_id = $row['hoteli_id_hotel'];
    $vrijednost = $row['broj_sobe'];
    $odabirSobe .= "<option value='" . $row['id_soba'] . "'>" . $vrijednost . "</option>";
}
$odabirSobe .= "</select>";

$sqlKorisnici = "SELECT * FROM korisnici WHERE tip_korisnika_id_tip_kor = '1'";
$korisnici = $baza->selectDB($sqlKorisnici);
$odabirKorisnika = "<select id='korisnik' name='korisnik'>";
while ($row = mysqli_fetch_array($korisnici)) {
    $vrijednost = $row['korisnicko_ime'];
    $odabirKorisnika .= "<option value='" . $row['id_korisnik'] . "'>" . $vrijednost . "</option>";
}
$odabirKorisnika .= "</select>";

if(isset($_POST["submit"])) {
    $id_soba = $_POST["broj"];
    $id_kor = $_POST["korisnik"];
    $datum = $_POST["datum"];
    $trajanje = $_POST["trajanje"];

    $sqlUnosRez = "INSERT INTO `rezervacije`(`dolazak`, `trajanje_boravka`, `korisnici_id_korisnik`, `sobe_id_soba`, `hoteli_id_hotel`) VALUES ('" . $datum . "', '" . $trajanje . "', '" . $id_kor . "', '" . $id_soba . "', '" . $hotel_id . "')";
    $baza->selectDB($sqlUnosRez);
    
    $sqlSobaRez = "UPDATE sobe SET broj_rez = broj_rez + 1, status = '1' WHERE id_soba = '" . $id_soba . "'";
    $baza->selectDB($sqlSobaRez);
    
    $vrijemeAktivnosti = date("Y/m/d H:i:s");
    $aktivnost = "Nova rezervacija";
    $opisAktivnosti = "Nova rezervacija: Korisnik ID: " . $id_kor . ", soba ID: " . $id_soba . " u hotel ID: " . $id_hotel;
    $sqlUnosZapisa = "INSERT INTO `dnevnik`(`aktivnost`, `korisnik`,`vrijeme`, `opis`) VALUES 
    ('" . $aktivnost . "', '" . $kor . "' , '" . $vrijemeAktivnosti . "', '" . $opisAktivnosti . "')";
    $baza->selectDB($sqlUnosZapisa);
    
    header("Location: index.php");
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
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="../js/oglasi.js"></script>

    <title>Nova rezervacija</title>
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
           <form class="prireg" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <h2>Unos nove rezervacije</h2>
                <label id="lbroj" for="broj">Broj sobe: </label><br>
                <?php echo($odabirSobe);?><br>
                <label id="ldatum" for="datum">Datum dolaska: </label><br>
                <input type="date" id="datum" name="datum" placeholder="Datum"><br><br>
                <label id="ltrajanje" for="trajanje">Trajanje boravka: </label><br>
                <input type="number" id="trajanje" name="trajanje" placeholder="Trajanje boravka"><br><br>
                <label id="lkorisnik" for="korisnik">Korisnik: </label><br>
                <?php echo($odabirKorisnika);?><br>
                <input id="sumbit" name="submit" type="submit" value=" Rezerviraj "><br>
                
                </form>
        </section>
        
        <!--        Footer-->
        <footer>
            <p>Luka Gotovac &copy; 2018</p>
        </footer>
    </div>
</body>

</html>
