<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$base_url = "http://localhost/UTS_Andrian_Prabowo_2021230036";
function url_dasar() {
    global $base_url;
    return $base_url;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>New Portal</title>
    <link rel="stylesheet" href="<?php echo url_dasar() ?>/css/style.css">
</head>
<body>
    <nav>
        <div class="wrapper">
            <div class="logo"><a href="<?php echo url_dasar() ?>">New Portal</a></div>
            <div class="menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="info_kuliah.php">Info Kuliah</a></li>
                    <li><a href="data_mahasiswa.php">Data Mahasiswa</a></li>
                    <li><a href="data_mata_kuliah.php">Mata Kuliah</a></li>
                    <li><a href="data_dosen.php">Data Dosen</a></li>
                    <?php if (isset($_SESSION['members_email']) && $_SESSION['members_email'] != ''): ?>
                        <li><a href="logout.php">Logout</a></li>
                        <li><strong><?= $_SESSION['members_nama'] ?></strong></li>
                    <?php else: ?>
                        <li><a href="login.php" class="tbl-biru">Login</a></li>
                        <li><a href="pendaftaran.php" class="tbl-biru">Daftar</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper">
