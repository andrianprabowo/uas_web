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

// Ambil data dosen
$data = $koneksi->query("SELECT * FROM dosen WHERE id='$id'");
$row = $data->fetch_assoc();
if (!$row) {
    die("Data dosen tidak ditemukan.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_dosen = $_POST["nama_dosen"];
    $nip        = $_POST["nip"];
    $email      = $_POST["email"];
    $no_hp      = $_POST["no_hp"];
    $jurusan    = $_POST["jurusan"];

    if ($nama_dosen && $nip && $email && $no_hp && $jurusan) {
        $update = $koneksi->query("UPDATE dosen SET 
            nama_dosen='$nama_dosen',
            nip='$nip',
            email='$email',
            no_hp='$no_hp',
            jurusan='$jurusan'
            WHERE id='$id'");
        if ($update) {
            $sukses = "Data dosen berhasil diupdate.";
            $row = array_merge($row, $_POST);
        } else {
            $error = "Gagal mengupdate data.";
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
    <title>Edit Dosen</title>
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
    <h2>Edit Dosen</h2>

    <?php if ($error): ?><div class="alert"><?= $error ?></div><?php endif; ?>
    <?php if ($sukses): ?><div class="success"><?= $sukses ?></div><?php endif; ?>

    <form method="post">
        <div class="form-group">
            <label>Nama Dosen</label>
            <input type="text" name="nama_dosen" value="<?= $row['nama_dosen'] ?>" required>
        </div>
        <div class="form-group">
            <label>NIP</label>
            <input type="text" name="nip" value="<?= $row['nip'] ?>" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?= $row['email'] ?>" required>
        </div>
        <div class="form-group">
            <label>No HP</label>
            <input type="text" name="no_hp" value="<?= $row['no_hp'] ?>" required>
        </div>
        <div class="form-group">
            <label>Jurusan</label>
            <input type="text" name="jurusan" value="<?= $row['jurusan'] ?>" required>
        </div>
        <button type="submit" class="btn-submit">Update</button>
        <a href="data_dosen.php" class="btn-submit" style="background-color: gray;">Kembali</a>
    </form>
</div>
</body>
</html>
