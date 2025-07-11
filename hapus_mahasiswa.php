<?php
session_start();

if ($_SESSION['members_email'] == '') {
    header("location:login.php");
    exit();
}

$koneksi = new mysqli("localhost", "andrian3_admin", "Adg222823?", "andrian3_andrianuas");


$nim = $_GET['nim'] ?? '';

if ($nim !== '') {
    $hapus = $koneksi->query("DELETE FROM mahasiswa WHERE nim = '$nim'");
}

header("Location: data_mahasiswa.php");
exit();
?>
