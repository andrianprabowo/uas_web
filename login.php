<?php
session_start();
$koneksi = new mysqli("localhost", "andrian3_admin", "Adg222823?", "andrian3_andrianuas");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';

    // Cek email di database
    $data = $koneksi->query("SELECT * FROM users WHERE email = '$email'");
    $user = $data->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['members_email'] = $user['email'];
        $_SESSION['members_nama'] = $user['nama_lengkap'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Email atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - New Portal</title>
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
        input[type="email"], input[type="password"] {
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
        .btn-submit:hover {
            background-color: #1a242f;
        }
        .alert {
            text-align: center;
            margin-bottom: 15px;
            color: red;
        }
    </style>
</head>
<body>
<?php include("inc_header.php"); ?>

<div class="wrapper">
    <form method="post">
        <h2>Login ke Portal</h2>

        <?php if ($error): ?>
            <div class="alert"><?= $error ?></div>
        <?php endif; ?>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="Masukkan email" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>
        </div>
        <button type="submit" class="btn-submit">Login</button>
    </form>
</div>

</body>
</html>
