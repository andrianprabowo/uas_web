<?php
session_start();

if ($_SESSION['members_email'] == '') {
    header("location:login.php");
    exit();
}

$koneksi = new mysqli("localhost", "andrian3_admin", "Adg222823?", "andrian3_andrianuas");


$id = $_GET['id'] ?? '';
$error = "";
$sukses = "";

$data = $koneksi->query("SELECT * FROM mata_kuliah WHERE id='$id'");
$row = $data->fetch_assoc();

if (!$row) {
    die("Data tidak ditemukan.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mata_kuliah = $_POST["mata_kuliah"];
    $jam_kuliah  = $_POST["jam_kuliah"];
    $sks         = $_POST["sks"];
    $nama_dosen  = $_POST["nama_dosen"];
    $hari        = $_POST["hari"];

    if ($mata_kuliah && $jam_kuliah && $sks && $nama_dosen && $hari) {
        $update = $koneksi->query("UPDATE mata_kuliah SET 
            mata_kuliah = '$mata_kuliah',
            jam_kuliah = '$jam_kuliah',
            sks = '$sks',
            nama_dosen = '$nama_dosen',
            hari = '$hari'
            WHERE id = '$id'");

        if ($update) {
            $sukses = "Data berhasil diupdate.";
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
    <title>Edit Mata Kuliah</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("inc_header.php"); ?>
<div class="container mt-5">
    <h2>Edit Mata Kuliah</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <?php if ($sukses): ?>
        <div class="alert alert-success"><?= $sukses ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="mata_kuliah" class="form-label">Nama Mata Kuliah</label>
            <input type="text" class="form-control" name="mata_kuliah" id="mata_kuliah" value="<?= $row['mata_kuliah'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="jam_kuliah" class="form-label">Jam Kuliah</label>
            <input type="text" class="form-control" name="jam_kuliah" id="jam_kuliah" value="<?= $row['jam_kuliah'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="sks" class="form-label">SKS</label>
            <input type="number" class="form-control" name="sks" id="sks" value="<?= $row['sks'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="nama_dosen" class="form-label">Nama Dosen</label>
            <input type="text" class="form-control" name="nama_dosen" id="nama_dosen" value="<?= $row['nama_dosen'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="hari" class="form-label">Hari</label>
            <select class="form-select" name="hari" id="hari" required>
                <option value="">Pilih Hari</option>
                <?php
                $hari_list = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
                foreach ($hari_list as $h) {
                    $selected = ($row['hari'] === $h) ? 'selected' : '';
                    echo "<option $selected>$h</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="data_mata_kuliah.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
