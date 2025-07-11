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
    $mata_kuliah = $_POST["mata_kuliah"];
    $jam_kuliah  = $_POST["jam_kuliah"];
    $sks         = $_POST["sks"];
    $nama_dosen  = $_POST["nama_dosen"];
    $hari        = $_POST["hari"];

    if ($mata_kuliah && $jam_kuliah && $sks && $nama_dosen && $hari) {
        $simpan = $koneksi->query("INSERT INTO mata_kuliah (mata_kuliah, jam_kuliah, sks, nama_dosen, hari)
                                    VALUES ('$mata_kuliah', '$jam_kuliah', '$sks', '$nama_dosen', '$hari')");
        if ($simpan) {
            $sukses = "Data berhasil disimpan.";
        } else {
            $error = "Gagal menyimpan data.";
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
    <title>Tambah Mata Kuliah</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("inc_header.php"); ?>
<div class="container mt-5">
    <h2>Tambah Mata Kuliah</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <?php if ($sukses): ?>
        <div class="alert alert-success"><?= $sukses ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="mata_kuliah" class="form-label">Nama Mata Kuliah</label>
            <input type="text" class="form-control" name="mata_kuliah" id="mata_kuliah" required>
        </div>
        <div class="mb-3">
            <label for="jam_kuliah" class="form-label">Jam Kuliah</label>
            <input type="text" class="form-control" name="jam_kuliah" id="jam_kuliah" required>
        </div>
        <div class="mb-3">
            <label for="sks" class="form-label">SKS</label>
            <input type="number" class="form-control" name="sks" id="sks" required>
        </div>
        <div class="mb-3">
            <label for="nama_dosen" class="form-label">Nama Dosen</label>
            <input type="text" class="form-control" name="nama_dosen" id="nama_dosen" required>
        </div>
        <div class="mb-3">
            <label for="hari" class="form-label">Hari</label>
            <select class="form-select" name="hari" id="hari" required>
                <option value="">Pilih Hari</option>
                <option>Senin</option>
                <option>Selasa</option>
                <option>Rabu</option>
                <option>Kamis</option>
                <option>Jumat</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="data_mata_kuliah.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
