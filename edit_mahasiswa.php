<?php
session_start();

if ($_SESSION['members_email'] == '') {
    header("location:login.php");
    exit();
}

$koneksi = new mysqli("localhost", "andrian3_admin", "Adg222823?", "andrian3_andrianuas");


$nim = $_GET['nim'] ?? '';
$error = "";
$sukses = "";

// Ambil data mahasiswa berdasarkan NIM
$data = $koneksi->query("SELECT * FROM mahasiswa WHERE nim='$nim'");
$row = $data->fetch_assoc();

if (!$row) {
    die("Data tidak ditemukan.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama   = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $prodi  = $_POST["prodi"];

    if ($nama && $alamat && $prodi) {
        $update = $koneksi->query("UPDATE mahasiswa SET nama='$nama', alamat='$alamat', prodi='$prodi' WHERE nim='$nim'");
        if ($update) {
            $sukses = "Data berhasil diupdate.";
            // Update tampilan data setelah simpan
            $row = array_merge($row, $_POST);
        } else {
            $error = "Gagal update data.";
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
    <title>Edit Mahasiswa</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("inc_header.php") ?>
<div class="container mt-5">
    <h2>Edit Mahasiswa</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <?php if ($sukses): ?>
        <div class="alert alert-success"><?= $sukses ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" class="form-control" id="nim" value="<?= $row['nim'] ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama" value="<?= $row['nama'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" name="alamat" id="alamat" value="<?= $row['alamat'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="prodi" class="form-label">Prodi</label>
            <input type="text" class="form-control" name="prodi" id="prodi" value="<?= $row['prodi'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="data_mahasiswa.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
