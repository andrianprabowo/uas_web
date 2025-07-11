<?php
session_start();
if ($_SESSION['members_email'] == '') {
    header("location:login.php");
    exit();
}

$koneksi = new mysqli("localhost", "andrian3_admin", "Adg222823?", "andrian3_andrianuas");


$id = $_GET['id'] ?? '';

if ($id !== '') {
    $hapus = $koneksi->query("DELETE FROM dosen WHERE id = '$id'");
}

header("Location: data_dosen.php");
exit();
