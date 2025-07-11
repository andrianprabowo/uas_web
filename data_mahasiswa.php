<?php
session_start();

if ($_SESSION['members_email'] == '') {
    header("location:login.php");
    exit();
}

$cari = isset($_GET['cari']) ? $_GET['cari'] : '';
$koneksi = new mysqli("localhost", "andrian3_admin", "Adg222823?", "andrian3_andrianuas");


$sql = "SELECT * FROM mahasiswa";
if ($cari != '') {
    $sql .= " WHERE nama LIKE '%$cari%' OR nim LIKE '%$cari%' OR prodi LIKE '%$cari%'";
}
$result = $koneksi->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("inc_header.php") ?>
<div class="container mt-5">
    <h2>Data Mahasiswa</h2>

    <form method="get" class="mb-3">
        <div class="input-group">
            <input type="text" name="cari" class="form-control" placeholder="Cari mahasiswa..." value="<?= htmlspecialchars($cari) ?>">
            <button type="submit" class="btn btn-primary">Cari</button>
            <a href="tambah_mahasiswa.php" class="btn btn-success ms-2">+ Tambah Mahasiswa</a>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Prodi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($mhs = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($mhs['nim']) ?></td>
                        <td><?= htmlspecialchars($mhs['nama']) ?></td>
                        <td><?= htmlspecialchars($mhs['alamat']) ?></td>
                        <td><?= htmlspecialchars($mhs['prodi']) ?></td>
                        <td>
                            <a href="edit_mahasiswa.php?nim=<?= $mhs['nim'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="hapus_mahasiswa.php?nim=<?= $mhs['nim'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5" class="text-center">Data tidak ditemukan</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
