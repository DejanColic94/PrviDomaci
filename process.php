<?php


// start sesije
session_start();

// konekcija na bazu
$mysqli = new mysqli('localhost', 'root', '', 'itehprvidomaci') or die(mysqli_error($mysqli));

// provera da li je save dugme zapamti pritisnuto
if (isset($_POST['save'])) {
    $naziv = $_POST['naziv'];
    $cena = $_POST['cena'];

   

    // sad upit da bi ubacio u bazu
    $mysqli->query("INSERT INTO usluge (naziv, cena) VALUES ('$naziv', '$cena') ") or die($mysqli->error);

    $_SESSION['message'] = "Uspešno uneto!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

// delete dugme
if(isset($_GET['delete'])) {
    $id=$_GET['delete'];
    $mysqli->query("DELETE FROM usluge WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Uspešno obrisano!";
    $_SESSION['msg_type'] = "danger";
    header("location: index.php");
}





