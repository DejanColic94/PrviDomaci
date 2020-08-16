<?php


// start sesije
session_start();

// konekcija na bazu
$mysqli = new mysqli('localhost', 'root', '', 'itehprvidomaci') or die(mysqli_error($mysqli));


// postavljamo naziv i cenu na default vrednost

$id = 0;
$update = false;
$naziv = '';
$cena = '';

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

//edit dugme
if(isset($_GET['edit'])) {
    $id=$_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM usluge WHERE id=$id") or die($mysqli->error());
    
    if($result->num_rows){

        $row = $result->fetch_array();
        $naziv = $row['naziv'];
        $cena = $row['cena'];

    }
    
}

// update dugme
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $naziv = $_POST['naziv'];
    $cena = $_POST['cena'];

    $mysqli->query("UPDATE usluge SET naziv='$naziv', cena ='$cena' WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Uspešno izmenjeno!";
    $_SESSION['msg_type'] = "warning";

    header('location: index.php');
}

//------------------------ drugi deo -----------------------------



//snimi dugme
if(isset($_POST['snimi'])) {
    $ime = $_POST['ime'];

    $mysqli->query("INSERT INTO tehnologije (ime) VALUES('$ime')") or die($mysqli->error);

    $_SESSION['message'] = "Snimljeno!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}


//delete2 dugme
if (isset($_GET['delete2'])) {
    $rb = $_GET['delete2'];
    $mysqli->query("DELETE FROM tehnologije WHERE rb=$rb") or die($mysqli->error());

    $_SESSION['message'] = "Obrisano!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}
