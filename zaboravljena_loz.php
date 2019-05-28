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

$greska = 0;

if (isset($_POST["submit"])) {
    $email = $_POST["email"];

    $sqlKorisnik = "SELECT * FROM korisnici WHERE email = '" . $email . "'";
    $korisnik = $baza->selectDB($sqlKorisnik);
    if (mysqli_num_rows($korisnik) > 0) {
        while ($row = $korisnik->fetch_assoc()) {
            $lozinka = $row["lozinka"];
            $korime = $row["korisnicko_ime"];
        }
        $salt = sha1(time());
        $genLozinka = sha1($salt . "text" . $lozinka);
        $sqlLozinka = "UPDATE korisnici SET lozinka = '" . $genLozinka . "' WHERE korisnicko_ime = '" . $korime . "'";
        $baza->selectDB($sqlLozinka);
        
        $vrijemeAktivnosti = date("Y/m/d H:i:s");
        $aktivnost = "Zaboravljena lozinka";
        $opisAktivnosti = "Korisnik: " . $korime . " je zatrazio novu lozinku";
        $sqlUnosZapisa = "INSERT INTO `dnevnik`(`aktivnost`, `vrijeme`, `opis`) VALUES 
        ('" . $aktivnost . "', '" . $vrijemeAktivnosti . "', '" . $opisAktivnosti . "')";
        $baza->selectDB($sqlUnosZapisa);
        
        $mail_to = $email;
        $mail_subject = "Nova generirana lozinka - WebDiP2017x046";
        $mail_body = "Nova lozinka: " . $genLozinka;
        $mail_from = "WebDiP2017x046";
        if (mail($mail_to, $mail_subject, $mail_body, $mail_from)) {
            header("Location: prijava.php");
        }
    } else {
        $greska = 1;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="dizajn.css">
    <link href="https://fonts.googleapis.com/css?family=Catamaran" rel="stylesheet">


    <title>Zaboravljena lozinka</title>
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
            
            
            
            <form method="post" id="zabloz" class="prireg" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <h2>Zaboravljena lozinka</h2>
                <label for="korimep">E-mail korisnickog racuna: </label>
                <input type="text" id="email" name="email" size="20" placeholder="e-mail" autofocus="autofocus"><br>
                <input type="submit" name="submit" value=" Zatrazi novu lozinku "><br>
                <p id="errors">
                    <?php
                        if ($greska === 1) echo "Ne postoji korisnicki racun sa unesenom e-mail adresom!";
                    
                    ?>
                    
                </p>
            </form>
         
           
        </section>
        <!--Footer-->
        <footer>
            <p>Luka Gotovac &copy; 2018</p>
        </footer>
    </div>
</body>

</html>
