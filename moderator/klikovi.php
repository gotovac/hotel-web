<?php
include("../baza.class.php");

$id_oglas = "";
$prethodnaStranica = "";
$brojKlikova = "";
$baza = new Baza();
$baza->spojiDB();

if(isset($_GET["oglas_id"]) && isset($_GET["back"])) {
    $id_oglas = $_GET["oglas_id"];
    $prethodnaStranica = $_GET["back"];
}

$sql_oglas = "SELECT * FROM oglasi WHERE oglas_id = '" . $id_oglas . "'";
$oglas = $baza->selectDB($sql_oglas);
if(mysqli_num_rows($oglas) > 0) {
    while($row = $oglas->fetch_assoc()) {
        $brojKlikova = $row["broj_klik"];
    }
    $brojKlikova++;
    $sql_klik = "UPDATE oglasi SET broj_klik = '" . $brojKlikova . "' WHERE oglas_id = '" . $id_oglas . "'";
    $dodanKlik = $baza->selectDB($sql_klik);
    header("Location: " . $prethodnaStranica . ".php");
}
else {
    header("Location: " . $prethodnaStranica . ".php");
}

$baza->zatvoriDB();