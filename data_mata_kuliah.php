<?php
session_start();

if ($_SESSION['members_email'] == '') {
    header("location:login.php");
    exit();
}

$koneksi = new mysqli("localhost", "andrian3_admin", "Adg222823?", "andrian3_andrianuas");


$search = isset($_GET['search']) ? $koneksi->real_escape_string($_GET['search']) : '';
$sql = "SELECT * FROM mata_kuliah";

if ($search != '') {
    $sql .= " WHERE mata_kuliah LIKE '%$search%' OR jam_kuliah LIKE '%$search%' OR nama_dosen LIKE '%$search%' OR hari LIKE '%$search%'";
}

$result = $koneksi->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mata Kuliah</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("inc_header.php"); ?>
<div class="container mt-5">
    <h2>Data Mata Kuliah</h2>

    <form method="get" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" class="form-control" placeholder="Cari mata kuliah...">
            <button type="submit" class="btn btn-outline-primary">Cari</button>
            <a href="tambah_mata_kuliah.php" class="btn btn-success ms-2">+ Tambah Mata Kuliah</a>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Mata Kuliah</th>
                <th>Jam Kuliah</th>
                <th>SKS</th>
                <th>Nama Dosen</th>
                <th>Hari</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['mata_kuliah']) ?></td>
                        <td><?= htmlspecialchars($row['jam_kuliah']) ?></td>
                        <td><?= htmlspecialchars($row['sks']) ?></td>
                        <td><?= htmlspecialchars($row['nama_dosen']) ?></td>
                        <td><?= htmlspecialchars($row['hari']) ?></td>
                        <td>
                            <a href="edit_mata_kuliah.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="hapus_mata_kuliah.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-sm btn-danger">Hapus</a>
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
