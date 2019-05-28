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
$slika_url = "";
$naziv = "";

if (isset($_GET["id"])) {
    $id_oglas = $_GET["id"];
    $sqlOglas = "SELECT * FROM oglasi WHERE oglas_id = '" . $id_oglas . "'";
    $oglas = $baza->selectDB($sqlOglas);
    while($row = $oglas->fetch_assoc()){
        $naziv = $row["naziv"];
        $slika_url = $row["slika_url"];
    }
    $img = "<img id='slika' src='" . $slika_url . "' height='200' width='200'>";
    
    $sqlKorisnik = "SELECT * FROM korisnici WHERE korisnicko_ime = '" . $_SESSION["korisnik"] . "'";
    $korisnik = $baza->selectDB($sqlKorisnik);
    while($row = $korisnik->fetch_assoc()) {
    $id_kor = $row["id_korisnik"];
    }
}


if(isset($_POST["submit"])) {
    $id_oglas = $_POST["idoglas"];
    $id_kor = $_POST["idkor"];
    $razlog = $_POST["razlog"];
    $datum = date("Y-m-d H:i:s");
    $sqlNoviBlokZahtjev = "INSERT INTO `zahtjevi_za_blok`(`id_zahtjevatelja`, `opis_razloga`, `datum`, `status`, `oglasi_id_oglas`) VALUES
    ('" . $id_kor . "', '" . $razlog . "', '" . $datum . "', 'U obradi', '" . $id_oglas . "')";
    $baza->selectDB($sqlNoviBlokZahtjev);
    
    $vrijemeAktivnosti = date("Y/m/d H:i:s");
    $aktivnost = "Novi zahtjev za blokiranje oglasa";
    $opisAktivnosti = "Zahtjev za blokiranje oglasa pod ID: " . $id_kor;
    $sqlUnosZapisa = "INSERT INTO `dnevnik`(`aktivnost`, `vrijeme`, `opis`) VALUES 
    ('" . $aktivnost . "', '" . $vrijemeAktivnosti . "', '" . $opisAktivnosti . "')";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10/datatables.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>


    <title>Blokiranje oglasa</title>
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
        
        
         <section class="info">
            <?php echo$img; ?> 
            <div>
                <h2>Zahtjev za blokiranje oglasa: <?php echo$naziv ?></h2>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <input type="hidden" id="idoglas" name="idoglas" value="<?php echo$id_oglas; ?>">
                <input type="hidden" id="idkor" name="idkor" value="<?php echo$id_kor; ?>">
                <label id="lrazlog" for="razlog">Razlog: </label><br>
                <input type="text" id="razlog" name="razlog" placeholder="Razlog..."><br>
                <input id="sumbit" name="submit" type="submit" value=" Posalji "><br>
                
                </form>
                
            </div>
       
        </section>
        <!--        Footer-->
        <footer>
            <p>Luka Gotovac &copy; 2018</p>
        </footer>
    </div>
</body>

</html>
