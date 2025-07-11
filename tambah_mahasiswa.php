<?php
session_start();

if ($_SESSION['members_email'] == '') {
    header("location:login.php");
    exit();
}

$koneksi = new mysqli("localhost", "andrian3_admin", "Adg222823?", "andrian3_andrianuas");


$error = "";
$sukses = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim    = $_POST["nim"];
    $nama   = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $prodi  = $_POST["prodi"];

    if ($nim && $nama && $alamat && $prodi) {
        $cek = $koneksi->query("SELECT * FROM mahasiswa WHERE nim='$nim'");
        if ($cek->num_rows > 0) {
            $error = "NIM sudah terdaftar.";
        } else {
            $simpan = $koneksi->query("INSERT INTO mahasiswa (nim, nama, alamat, prodi) VALUES ('$nim', '$nama', '$alamat', '$prodi')");
            if ($simpan) {
                $sukses = "Data berhasil disimpan.";
            } else {
                $error = "Gagal menyimpan data.";
            }
        }
    } else {
        $error = "Silakan isi semua kolom.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("inc_header.php") ?>
<div class="container mt-5">
    <h2>Tambah Mahasiswa</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <?php if ($sukses): ?>
        <div class="alert alert-success"><?= $sukses ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" class="form-control" name="nim" id="nim" value="<?= isset($_POST['nim']) ? htmlspecialchars($_POST['nim']) : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama" value="<?= isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" name="alamat" id="alamat" value="<?= isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="prodi" class="form-label">Prodi</label>
            <input type="text" class="form-control" name="prodi" id="prodi" value="<?= isset($_POST['prodi']) ? htmlspecialchars($_POST['prodi']) : '' ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="data_mahasiswa.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
