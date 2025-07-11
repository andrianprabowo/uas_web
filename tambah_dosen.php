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
    $nama_dosen = $_POST["nama_dosen"];
    $nip        = $_POST["nip"];
    $email      = $_POST["email"];
    $no_hp      = $_POST["no_hp"];
    $jurusan    = $_POST["jurusan"];

    if ($nama_dosen && $nip && $email && $no_hp && $jurusan) {
        $simpan = $koneksi->query("INSERT INTO dosen (nama_dosen, nip, email, no_hp, jurusan)
                                   VALUES ('$nama_dosen', '$nip', '$email', '$no_hp', '$jurusan')");
        if ($simpan) {
            $sukses = "Data dosen berhasil disimpan.";
        } else {
            $error = "Gagal menyimpan data dosen.";
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
    <title>Tambah Dosen</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        form { max-width: 600px; margin: 40px auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input[type="text"], input[type="email"] {
            width: 100%; padding: 10px; box-sizing: border-box;
        }
        .btn-submit {
            background-color: #2c3e50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
        .alert { margin-bottom: 15px; color: red; }
        .success { margin-bottom: 15px; color: green; }
    </style>
</head>
<body>
<?php include("inc_header.php"); ?>
<div class="wrapper">
    <h2>Tambah Dosen</h2>

    <?php if ($error): ?><div class="alert"><?= $error ?></div><?php endif; ?>
    <?php if ($sukses): ?><div class="success"><?= $sukses ?></div><?php endif; ?>

    <form method="post">
        <div class="form-group">
            <label>Nama Dosen</label>
            <input type="text" name="nama_dosen" required>
        </div>
        <div class="form-group">
            <label>NIP</label>
            <input type="text" name="nip" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>No HP</label>
            <input type="text" name="no_hp" required>
        </div>
        <div class="form-group">
            <label>Jurusan</label>
            <input type="text" name="jurusan" required>
        </div>
        <button type="submit" class="btn-submit">Simpan</button>
        <a href="data_dosen.php" class="btn-submit" style="background-color: gray;">Kembali</a>
    </form>
</div>
</body>
</html>
