<?php
session_start();

if ($_SESSION['members_email'] == '') {
    header("location:login.php");
    exit();
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
$koneksi = new mysqli("localhost", "andrian3_admin", "Adg222823?", "andrian3_andrianuas");


// Ambil data dari tabel info_kuliah
$sql = "SELECT * FROM info_kuliah";
if ($search != '') {
    $search_safe = $koneksi->real_escape_string($search);
    $sql .= " WHERE informasi LIKE '%$search_safe%' OR tanggal LIKE '%$search_safe%'";
}
$sql .= " ORDER BY tanggal ASC";
$result = $koneksi->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Informasi Kuliah</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("inc_header.php") ?>
<div class="container mt-5">
    <h2>Data Informasi Kuliah</h2>

    <form method="get" class="mb-3">
        <div class="input-group" style="max-width: 400px;">
            <input type="text" name="search" class="form-control" placeholder="Cari informasi kuliah..." value="<?= htmlspecialchars($search) ?>">
            <button type="submit" class="btn btn-secondary">Cari</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Informasi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= date("d-m-Y", strtotime($row['tanggal'])) ?></td>
                    <td><?= htmlspecialchars($row['informasi']) ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="3" class="text-center">Data tidak ditemukan</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
