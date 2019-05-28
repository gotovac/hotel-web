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

$korime = "";
$lozinka = "";
$ulogaID = "";
$tipKorisnika = "";
$kriviUnosi = "";
$greska = 0;

$kolac = '';
$checkcookie = 0;

if(isset($_COOKIE['Login'])) {
    $kolac=$_COOKIE['Login'];
    $checkcookie = 1;
}

if (isset($_POST["submit"])) {
    
    $korime = $_POST["pkorime"];
    $lozinka = $_POST["plozinka"];

    $sqlKorisnik = "SELECT * FROM korisnici WHERE korisnicko_ime = '" . $korime . "' AND lozinka = '" . $lozinka . "' AND kriviUnosi < '3' AND status = '1'";
    $korisnik = $baza->selectDB($sqlKorisnik);
    if (mysqli_num_rows($korisnik) > 0) {
        while ($row = $korisnik->fetch_assoc()) {
            $ulogaId = $row["tip_korisnika_id_tip_kor"];
        }
        if ($ulogaId == '1') {
            $tipKorisnika = "user";
        }
        if ($ulogaId == '2') {
            $tipKorisnika = "moderator";
        }
        if ($ulogaId == '3') {
            $tipKorisnika = "administrator";
        }
        
        Sesija::kreirajKorisnika($korime, $tipKorisnika, '1');
        setcookie('Login', $korime, time() + 1000);
        
        $vrijemeAktivnosti = date("Y/m/d H:i:s");
        $aktivnost = "Prijava";
        $opisAktivnosti = "Korisnik: " . $korime . " se prijavio";
        $sqlUnosZapisa = "INSERT INTO `dnevnik`(`aktivnost`, `vrijeme`, `opis`) VALUES 
        ('" . $aktivnost . "', '" . $vrijemeAktivnosti . "', '" . $opisAktivnosti . "')";
        $baza->selectDB($sqlUnosZapisa);
        
        $sqlResetUnosi = "UPDATE korisnici SET kriviUnosi = '0' WHERE korisnicko_ime = '" . $korime . "'";
        $reset = $baza->selectDB($sqlResetUnosi);
        header("Location: index.php");
        
    } else {
        $sql_upit_greske = "SELECT * FROM korisnici WHERE korisnicko_ime = '" . $korime . "' AND tip_korisnika_id_tip_kor NOT LIKE '3'";
        $rezultat = $baza->selectDB($sql_upit_greske);
        if (mysqli_num_rows($rezultat) > 0) {
            while ($row = $rezultat->fetch_assoc()) {
                $kriviUnosi = $row["kriviUnosi"];
            }
        $kriviUnosi++;
        $sql_pogresna_prijava = "UPDATE korisnici SET kriviUnosi = '" . $kriviUnosi . "' WHERE korisnicko_ime = '" . $korime . "'";
        $izmjena = $baza->selectDB($sql_pogresna_prijava);
        $greska = 1;
        }
    }
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
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="js/oglasi-pri.js"></script>


    <title>Prijava</title>
</head>

<body>

    <div class="wrapper">
        <!--Banner-->
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
        <!--Kontejner s formama-->
        <div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'hr', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        <section class="container">
            
            
            
            <form method="post" class="prireg" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <h2>Prijava</h2>
                <label for="korimep">Korisničko ime: </label>
                <input type="text" id="pkorime" name="pkorime" size="20" placeholder="korisničko ime" autofocus="autofocus" value="<?php if($checkcookie===1) echo$kolac; ?>"><br>
                <label for="lozinka">Lozinka: </label>
                <input type="password" id="plozinka" name="plozinka" size="20" placeholder="lozinka"><br>
                <input type="submit" name="submit" value=" Prijavi se "><br>
                <a href="zaboravljena_loz.php">Zaboravio sam lozinku!</a><br>
                <p id="errors">
                <?php
                    if ($greska === 1) echo "Neuspjesna prijava!"; 
                ?>
                
            </p>
            </form>
         
           
        </section>
        
        <!--        Oglasi-->
        <h2>Oglasi</h2>
        <div id="popisoglasa2">
            <div id="oglas7"></div>
            <p id="kupiOglas7"></p>
        </div>
        
        <script type="text/javascript">
            function klikanje(id) {
                window.location.href = "klikovi.php?oglas_id=" + id + "&back=prijava";
            }
        </script>
        
        <!--Footer-->
        <footer>
            <p>Luka Gotovac &copy; 2018</p>
        </footer>
    </div>
</body>

</html>
