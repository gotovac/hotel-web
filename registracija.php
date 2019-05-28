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

if (isset($_POST["submit"])){
    
    // Validacija za ime
    $ime = $_POST["rime"];
    $errIme = "";
    $regImePrez = '/[?!@#$%]/';
    if(empty($ime)){
        $errIme = "Ime je ostalo prazno!";
    }
    if(preg_match($regImePrez, $ime)){
        $errIme = "Nedozvoljeni znak u imenu!";
    }
    
    // Validacija za prezime
    $prez = $_POST["rprez"];
    $errPrez = "";
    if(empty($prez)){
        $errPrez = "Prezime je ostalo prazno!";
    }
    if(preg_match($regImePrez, $prez)){
        $errPrez = "Nedozvoljeni znak u prezimenu!";
    }
    
    // Validacija za korisnicko ime
    $korime = $_POST["rkorime"];
    $errKorime = "";
    if(strlen($korime) < 3 || strlen($korime) > 20){
        $errKorime = "Korisnicko ime sadrzi manje od 3 ili vise od 20 znakova!";
    }
    
    
    // Validacija za email
    $email = $_POST["remail"];
    $errEmail = "";
    if(empty($email)){
        $errEmail = "E-mail je ostao prazan!";
    }
    if(mysqli_num_rows($baza->selectDB("SELECT email FROM korisnici WHERE email = '$email' ")) > 0){
        $errEmail = "E-mail vec postoji!";
    }
    
    // Validacija za lozinku1
    $lozinka1 = $_POST["rlozinka1"];
    $errLoz1 = "";
    if(empty($lozinka1)){
        $errLoz1 = "Orginalna lozinka je ostala prazna!";
    }
    if(strlen($lozinka1) < 3 || strlen($lozinka1) > 20){
        $errLoz1 = "Lozinka sadrzi manje od 3 ili vise od 20 znakova!";
    }
    
    // Validacija za lozinku2
    $lozinka2 = $_POST["rlozinka2"];
    $errLoz2 = "";
    if(empty($lozinka2)){
        $errLoz2 = "Potvrda lozinke je ostala prazna!";
    }
    if(strlen($lozinka2) < 3 || strlen($lozinka2) > 20){
        $errLoz2 = "Lozinka sadrzi manje od 3 ili vise od 20 znakova!";
    }
    if($lozinka2 !== $lozinka1){
        $errLoz2 = "Lozinka unesena u potvrdu lozinke nije jednaka orginalnoj lozinci!";
    }
    
    if ($errIme === "" && $errPrez === "" && $errKorime === "" && $errEmail === "" && $errLoz1 === "" && $errLoz2 === ""){
        $salt = sha1(time());
        $kriptLozinka = sha1($salt . "text" . $lozinka1);
        
        $sqlUnosKorisnika = "INSERT INTO `korisnici`(`korisnicko_ime`, `ime`, `prezime`, `email`, `lozinka`, `kript_lozinka`, `status`, `tip_korisnika_id_tip_kor`) VALUES
        ('" . $korime . "', '" . $ime . "', '" . $prez . "', '" . $email . "', '" . $lozinka1 . "', '" . $kriptLozinka . "', '0', '1')";
        $baza->selectDB($sqlUnosKorisnika);
        
        $aktivacija_link = "http://barka.foi.hr/WebDiP/2017_projekti/WebDiP2017x046/aktivacija.php?korime=" . $korime . "&kod=" . $kriptLozinka;
        $mail_to = $email;
        $mail_subject = "Aktivacija novog racuna - WebDiP2017x046";
        $mail_body = $aktivacija_link;
        $mail_from = "WebDiP2017x046";
        
        $vrijemeAktivnosti = date("Y/m/d H:i:s");
        $aktivnost = "Registracija";
        $opisAktivnosti = "Registracija novog racuna: " . $korime . " sa e-mail adresom: " . $email;
        $sqlUnosZapisa = "INSERT INTO `dnevnik`(`aktivnost`, `vrijeme`, `opis`) VALUES
        ('" . $aktivnost . "', '" . $vrijemeAktivnosti . "', '" . $opisAktivnosti . "')";
        $baza->selectDB($sqlUnosZapisa);
        
        $uspjesnaRegistracija = "";
        
        if (mail($mail_to, $mail_subject, $mail_body, $mail_from)){
            $uspjesnaRegistracija = "Registracija uspjesna.";
            
        }
        else {
            $uspjesnaRegistracija = "Registracija neuspjesna.";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/provjere.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>


    <title>Registracija</title>
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
           
           <p id="errori">
               <?php
                    if(isset($errIme)){
                        echo $errIme . "<br>";
                    }   
                    if(isset($errPrez)){
                        echo $errPrez . "<br>";
                    }
                    if(isset($errKorime)){
                        echo $errKorime . "<br>";
                    }
                    if(isset($errEmail)){
                        echo $errEmail . "<br>";
                    }
                    if(isset($errLoz1)){
                        echo $errLoz1 . "<br>";
                    }
                    if(isset($errLoz2)){
                        echo $errLoz2 . "<br>";
                    }
                    if(isset($uspjesnaRegistracija)){
                        echo $uspjesnaRegistracija;
                    }
            ?>
               
           </p>
            
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="prireg" onsubmit="return validirajCaptchu();">
                <h2>Registracija</h2>
                <label id="regime" for="ime">Ime: </label>
                <input type="text" id="rime" name="rime" size="30" placeholder="Ime"><br>
                <p id="errIme"></p><br>
                <label id="regprez" for="prez">Prezime: </label>
                <input type="text" id="rprez" name="rprez" size="30" placeholder="Prezime"><br>
                <p id="errPrezime"></p><br>
                <label id="regkorime" for="korimer">Korisničko ime: </label>
                <input type="text" id="rkorime" name="rkorime" size="30" placeholder="korisničko ime"><br>
                <p id="errKorime"></p><br>
                <label id="regemail" for="email">E-mail adresa: </label>
                <input type="email" id="remail" name="remail" size="30" placeholder="ime.prezime@posluzitelj.xxx"><br>
                <p id="errEmail"></p><br>
                <label id="regloz1" for="lozinka1">Lozinka: </label>
                <input type="password" id="rlozinka1" name="rlozinka1" size="30" placeholder="lozinka"><br>
                <p id="errLozinka1"></p><br>
                <label id="regloz2" for="lozinka2">Potrvda lozinke: </label>
                <input type="password" id="rlozinka2" name="rlozinka2" size="30" placeholder="lozinka"><br>
                <p id="errLozinka2"></p><br>
                <div class="g-recaptcha" data-sitekey="6Lc0kl4UAAAAAEHUGNkTblyB2z8tUhVnm26Dy5R9"></div><br>
                
                <script type="text/javascript">
                    function validirajCaptchu(){
                        if (grecaptcha.getResponse() == ""){
                            alert("Neuspjesna validacija!");
                            return false;
                        }
                        else {
                            return true;
                        }
                    }
                </script>
                
                <input id="rsumbit" name="submit" type="submit" value=" Registriraj se "><br>
            </form>
        </section>
        <!--Footer-->
        <footer>
            <p>Luka Gotovac &copy; 2018</p>
        </footer>
    </div>
</body>

</html>