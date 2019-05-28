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

$id_soba = "";
$brojSobe = 0;
$slika_url = "";
$opis = "";

if (isset($_GET["id"])) {
    $id_soba = $_GET["id"];
    $sqlSoba = "SELECT broj_sobe, slika_url, opis FROM sobe WHERE id_soba = '" . $id_soba . "'";
    $soba = $baza->selectDB($sqlSoba);
    while($row = $soba->fetch_assoc()){
        $brojSobe = $row["broj_sobe"];
        $opis = $row["opis"];
        $slika_url = $row["slika_url"];
    }
    $img = "<img id='slika' src='img/" . $slika_url . "' height='200' width='500'>";

}


if(isset($_POST["submit"])) {
    $id_soba = $_POST["soba_id"];
    $email = $_POST["email"];
    $datum = date("Y-m-d H:i:s");
    $sqlRezSoba = "SELECT * FROM sobe WHERE id_soba = '" . $id_soba . "'";
    $RezSoba = $baza->selectDB($sqlRezSoba);
    
    while($row = $RezSoba->fetch_assoc()) {
        $id_hotel = $row["hoteli_id_hotel"];
        $brojrez = $row["broj_rez"];
    }
    $sqlUnosRezervacije = "INSERT INTO `anon_rezervacije`(`email`, `pocetak_boravka`, `status`,  `sobe_id_soba`, `hoteli_id_hotel`) VALUES
    ('" . $email . "', '" . $datum . "', '0', '" . $id_soba . "', '" . $id_hotel . "')";
    $baza->selectDB($sqlUnosRezervacije);
    
    $idMod = "";
    $sqlMod = "SELECT korisnici_id_korisnik FROM moderacija_hotela WHERE hoteli_id_hotel = '" . $id_hotel . "'";
    $moderator = $baza->selectDB($sqlMod);
    while($row = $moderator->fetch_assoc()) {
        $modd = $row["korisnici_id_korisnik"];
    }
    
    $sqlMail = "SELECT email FROM korisnici WHERE id_korisnik = '" . $modd . "'";
    
    $mailMod = $baza->selectDB($sqlMail);
    while($row = $mailMod->fetch_assoc()) {
        $modMail = $row["email"];
    }
    
    
    $mail_to = $modMail;
    $mail_subject = "Zahtjev za rezervaciju - WebDiP2017x046";
    $mail_body = "Zahtjev za rezervaciju, email: " . $email . " datum: " . $datum;
    $mail_from = "WebDiP2017x046";
    
    mail($mail_to, $mail_subject, $mail_body, $mail_from);
    
    $brojrez++;
    $sqlBrojRezervacija = "UPDATE sobe SET broj_rez = '" . $brojrez . "' WHERE id_soba = '" . $id_soba . "'";
    $baza->selectDB($sqlBrojRezervacija);
    
    
    
    $aktivnost = "Rezervacija";
    $opisAktivnosti = "Rezervirana soba sa ID: " . $id_soba;
    $sqlUnosZapisa = "INSERT INTO `dnevnik`(`aktivnost`, `vrijeme`, `opis`) VALUES
        ('" . $aktivnost . "', '" . $datum . "', '" . $opisAktivnosti . "')";
    $baza->selectDB($sqlUnosZapisa);
    
    header("Location: index.php");
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


    <title>Soba</title>
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
        <section class="info">
            <?php echo$img; ?> 
            <div>
                <h2>Podaci o sobi <?php echo$brojSobe ?></h2>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <input type="hidden" id="soba_id" name="soba_id" value="<?php echo$id_soba; ?>">
                <p><?php echo$opis; ?></p>
                <label id="lemail" for="email">E-mail adresa: </label><br>
                <input type="text" id="email" name="email" placeholder="e-mail"><br>
                <input id="sumbit" name="submit" type="submit" value=" Rezerviraj "><br>
                
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
