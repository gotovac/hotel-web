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
    <script src="js/oglasi.js"></script>
    
    <title>Projekt Hotel</title>
    <script type="text/javascript">
    window.cookieconsent_options = {"message":"Ova stranica koristi kolacice!","dismiss":"OK","learnMore":"","link":null,"theme":"dark-floating"};
    </script>
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
        <!--Glavni kontejner-->
        <div id="google_translate_element"></div><script type="text/javascript">
            function googleTranslateElementInit() {
              new google.translate.TranslateElement({pageLanguage: 'hr', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
            }
            </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                    <section class="container">
            <header class="showcase">
                <h1>Dobrodošli!</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem, saepe!</p>
            </header>
        </section>
        
<!--        Oglasi-->
       <h2>Oglasi</h2>
        <div id="popisoglasa2">
            <div id="oglas1"></div>
            <p id="kupiOglas1"></p>
            <div id="oglas2"></div>
            <p id="kupiOglas2"></p>
            <div id="oglas3"></div>
            <p id="kupiOglas3"></p>
        </div>

        <script type="text/javascript">
            function klikanje(id) {
                window.location.href = "klikovi.php?oglas_id=" + id + "&back=index";
            }
        </script>
        
        <!--        Footer-->
        <footer>
            <p>Luka Gotovac &copy; 2018</p>
        </footer>
    </div>
</body>

</html>
