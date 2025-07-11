<?php
session_start();
$koneksi = new mysqli("localhost", "andrian3_admin", "Adg222823?", "andrian3_andrianuas");


$error = "";
$sukses = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email        = trim($_POST["email"] ?? '');
    $password     = trim($_POST["password"] ?? '');
    $nama_lengkap = trim($_POST["nama_lengkap"] ?? '');

    if ($email && $password && $nama_lengkap) {
        // Cek apakah email sudah ada
        $cek = $koneksi->query("SELECT * FROM users WHERE email='$email'");
        if ($cek->num_rows > 0) {
            $error = "Email sudah terdaftar.";
        } else {
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
            $simpan = $koneksi->query("INSERT INTO users (email, password, nama_lengkap) VALUES ('$email', '$password_hashed', '$nama_lengkap')");
            if ($simpan) {
                $sukses = "Pendaftaran berhasil. Silakan login.";
            } else {
                $error = "Terjadi kesalahan saat menyimpan data.";
            }
        }
    } else {
        $error = "Semua kolom wajib diisi.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Akun</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        form {
            max-width: 500px;
            margin: 40px auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label { font-weight: bold; display: block; margin-bottom: 5px; }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%; padding: 10px; box-sizing: border-box;
        }
        .btn-submit {
            width: 100%;
            background-color: #2c3e50;
            color: #fff;
            padding: 10px;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }
        .alert {
            text-align: center;
            margin-bottom: 15px;
            color: red;
        }
        .success {
            text-align: center;
            margin-bottom: 15px;
            color: green;
        }
    </style>
</head>
<body>
<?php include("inc_header.php"); ?>
<div class="wrapper">
    <form method="post">
        <h2>Registrasi Akun</h2>

        <?php if ($error): ?>
            <div class="alert"><?= $error ?></div>
        <?php endif; ?>
        <?php if ($sukses): ?>
            <div class="success"><?= $sukses ?></div>
        <?php endif; ?>

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit" class="btn-submit">Daftar</button>
    </form>
</div>
</body>
</html>
