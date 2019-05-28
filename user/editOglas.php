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



$id_oglas = "";
$id_kor = "";
$kor = "";

if (isset($_GET["id"])) {
    $id_oglas = $_GET["id"];
}

$sqlKorisnik = "SELECT * FROM korisnici WHERE korisnicko_ime = '" . $_SESSION["korisnik"] . "'";
$korisnik = $baza->selectDB($sqlKorisnik);
while($row = $korisnik->fetch_assoc()) {
    $id_kor = $row["id_korisnik"];
    $kor = $row["korisnicko_ime"];
}


if(isset($_POST["submit"])) {
    $id_oglas = $_POST["idoglas"];
    $id_kor = $_POST["idkor"];
    $naziv = $_POST["naziv"];
    $opis = $_POST["opis"];
    $url = $_POST["url"];
    $datum = $_POST["datum"];
    $slika_url = '../img/';
    $slika_url_final = $slika_url.$_FILES['file']['name'];
    
    $sqlUrediZahtjev = "UPDATE oglasi SET 
    naziv='" . $naziv . "', pocetak='" . $datum . "', url='" . $url . "', slika_url='" . $slika_url_final . "', opis='" . $opis . "' WHERE oglas_id = '" . $id_oglas . "'";
    $baza->selectDB($sqlUrediZahtjev);
    
    $vrijemeAktivnosti = date("Y/m/d H:i:s");
    $aktivnost = "Uredivanje zahtjeva za oglas";
    $opisAktivnosti = "Zahtjev za novi oglas je ureden";
    $sqlUnosZapisa = "INSERT INTO `dnevnik`(`aktivnost`, `korisnik`,`vrijeme`, `opis`) VALUES 
    ('" . $aktivnost . "', '" . $kor . "' , '" . $vrijemeAktivnosti . "', '" . $opisAktivnosti . "')";
    $baza->selectDB($sqlUnosZapisa);
    
    header("Location: mojiZahtjevi.php");
}
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


    <title>Uredivanje zahtjeva</title>
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
        
        
         <section class="container">
                
                <form class="prireg" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype='multipart/form-data'>
                <h2>Uredivanje zahtjeva za novi oglas</h2>
                <input type="hidden" id="idoglas" name="idoglas" value="<?php echo$id_oglas; ?>">
                <input type="hidden" id="idkor" name="idkor" value="<?php echo$id_kor; ?>">
                <label id="lnaziv" for="naziv">Naziv: </label><br>
                <input type="text" id="naziv" name="naziv" placeholder="Naziv"><br><br>
                <label id="lopis" for="opis">Opis: </label><br>
                <input type="text" id="opis" name="opis" placeholder="Opis..."><br><br>
                <label id="lurl" for="url">URL: </label><br>
                <input type="text" id="url" name="url" placeholder="URL"><br><br>
                <label id="ldatum" for="datum">Pocetak prikazivanja: </label><br>
                <input id="datum" type="date" name="datum"><br><br>
                <label id="lslika" for="slika">Slika: </label><br>
                <input type="file" id="file" name="file"><br><br>
                <input id="sumbit" name="submit" type="submit" value=" Izmjeni "><br>
                
                </form>
                
       
        </section>
        <!--        Footer-->
        <footer>
            <p>Luka Gotovac &copy; 2018</p>
        </footer>
    </div>
</body>

</html>
