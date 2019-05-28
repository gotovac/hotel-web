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



$id_hotel = "";
$id_kor = "";
$kor = "";

if (isset($_GET["id"])) {
    $id_hotel = $_GET["id"];
}

$sqlKorisnik = "SELECT * FROM korisnici WHERE korisnicko_ime = '" . $_SESSION["korisnik"] . "'";
$korisnik = $baza->selectDB($sqlKorisnik);
while($row = $korisnik->fetch_assoc()) {
    $id_kor = $row["id_korisnik"];
    $kor = $row["korisnicko_ime"];
}


if(isset($_POST["submit"])) {
    $hotel_id = $_POST["idhotel"];
    $broj_sobe = $_POST["broj"];
    $opis = $_POST["opis"];
    $broj_lezaja = $_POST["lezaji"];
    $slika_url = '../img/';
    $temp_name = $_FILES['file']['tmp_name'];
    $targetdir = "/WebDiP/2017_projekti/WebDiP2017x046/img";   
    $slika_url_final = $slika_url.$_FILES['file']['name'];
    move_uploaded_file($temp_name, $targetdir . $_FILES['file']['name']);
    
    $sqlNovaSoba = "INSERT INTO `sobe`(`broj_sobe`, `broj_lezaja`, `opis`, `slika_url`, `hoteli_id_hotel`, `status`) VALUES
    ('" . $broj_sobe . "', '" . $broj_lezaja . "' , '" . $opis . "', '" . $slika_url_final . "', '" . $hotel_id . "', '0')";
    $baza->selectDB($sqlNovaSoba);
    
    $vrijemeAktivnosti = date("Y/m/d H:i:s");
    $aktivnost = "Unesena nova soba za hotel ID: " . $hotel_id;
    $opisAktivnosti = "Unesena je soba broj: " . $broj_sobe . " u hotel ID: " . $hotel_id;
    $sqlUnosZapisa = "INSERT INTO `dnevnik`(`aktivnost`, `korisnik`,`vrijeme`, `opis`) VALUES 
    ('" . $aktivnost . "', '" . $kor . "' , '" . $vrijemeAktivnosti . "', '" . $opisAktivnosti . "')";
    $baza->selectDB($sqlUnosZapisa);
    
    header("Location: mojiHoteli.php");
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

    <title>Nova soba</title>
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
                <h2>Unos nove sobe</h2>
                <input type="hidden" id="idhotel" name="idhotel" value="<?php echo$id_hotel; ?>">
                <label id="lbroj" for="broj">Broj sobe: </label><br>
                <input type="text" id="broj" name="broj" placeholder="Broj sobe"><br><br>
                <label id="lopis" for="opis">Opis: </label><br>
                <input type="text" id="opis" name="opis" placeholder="Opis"><br><br>
                <label id="llezaji" for="lezaji">Broj lezaja: </label><br>
                <input type="text" id="lezaji" name="lezaji" placeholder="Broj lezaja"><br><br>
                <label id="lslika" for="slika">Slika: </label><br>
                <input type="file" id="file" name="file"><br><br>
                <input id="sumbit" name="submit" type="submit" value=" Dodaj "><br>
                
                </form>
        </section>
        
        <!--        Footer-->
        <footer>
            <p>Luka Gotovac &copy; 2018</p>
        </footer>
    </div>
</body>

</html>
