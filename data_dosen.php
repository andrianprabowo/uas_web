<?php
session_start();

if ($_SESSION['members_email'] == '') {
    header("location:login.php");
    exit();
}

$cari = isset($_GET['cari']) ? $_GET['cari'] : '';
$koneksi = new mysqli("localhost", "andrian3_admin", "Adg222823?", "andrian3_andrianuas");


$sql = "SELECT * FROM dosen";
if ($cari != '') {
    $sql .= " WHERE nama_dosen LIKE '%$cari%' OR nip LIKE '%$cari%' OR jurusan LIKE '%$cari%'";
}
$result = $koneksi->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Dosen</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("inc_header.php") ?>
<div class="container mt-5">
    <h2>Data Dosen</h2>

    <form method="get" class="mb-3">
        <div class="input-group">
            <input type="text" name="cari" class="form-control" placeholder="Cari dosen..." value="<?= htmlspecialchars($cari) ?>">
            <button type="submit" class="btn btn-primary">Cari</button>
            <a href="tambah_dosen.php" class="btn btn-success ms-2">+ Tambah Dosen</a>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nama Dosen</th>
                <th>NIP</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Jurusan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($dosen = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($dosen['nama_dosen']) ?></td>
                        <td><?= htmlspecialchars($dosen['nip']) ?></td>
                        <td><?= htmlspecialchars($dosen['email']) ?></td>
                        <td><?= htmlspecialchars($dosen['no_hp']) ?></td>
                        <td><?= htmlspecialchars($dosen['jurusan']) ?></td>
                        <td>
                            <a href="edit_dosen.php?id=<?= $dosen['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="hapus_dosen.php?id=<?= $dosen['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="6" class="text-center">Data tidak ditemukan</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
