<?php
if (!isset($_GET['aksi'])) {
?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Anggota</h1>
        <div class="card mb-4">
            <div class="card-header">
                <a type="button" class="btn btn-primary" href="index.php?page=anggota&aksi=tambah">Tambah Anggota</a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Telpon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $anggota = mysqli_query($koneksi, "SELECT * FROM anggota");
                        $no = 1;
                        while ($data = mysqli_fetch_array($anggota)) {
                        ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['username']; ?></td>
                                <td><?php echo '******'; ?></td>
                                <td><?php echo $data['telp']; ?></td>
                                <td>
                                    <a href="index.php?page=anggota&aksi=edit&id=<?php echo $data['id_anggota'] ?>">Edit</a> |
                                    <a href="index.php?page=anggota&aksi=hapus&id=<?php echo $data['id_anggota'] ?>">Hapus</a>
                                </td>
                            </tr>
                        <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
} elseif ($_GET['aksi'] == 'tambah') {
?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Anggota</h1>
        <div class="card mb-4 col-md-8">
            <div class="card-header">
                <h5>Tambah Anggota</h5>
            </div>
            <div class="card-body">
                <form action='' method="POST">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="b">
                        <label>Nama Anggota</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="c">
                        <label>Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="password" name="d">
                        <label>Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="e">
                        <label>Telpon</label>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary btn-block" type="submit" name="simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['simpan'])) {
        mysqli_query($koneksi, "INSERT INTO anggota (nama, username, password, telp)
            VALUES ('" . $_POST['b'] . "', '" . $_POST['c'] . "', '" . $_POST['d'] . "', '" . $_POST['e'] . "')");

        echo "<script>window.alert('Sukses Menambahkan Data Siswa.');
                window.location='anggota'</script>";
    }
} elseif ($_GET['aksi'] == 'edit') {
    $anggota = mysqli_query($koneksi, "SELECT * FROM anggota where id_anggota='" . $_GET['id'] . "'");
    $data = mysqli_fetch_array($anggota);
    ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Anggota</h1>
        <div class="card mb-4 col-md-8">
            <div class="card-header">
                <h5>Update Anggota</h5>
            </div>
            <div class="card-body">
                <form action='' method="POST">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="b" value="<?php echo $data['nama']; ?>">
                        <label>Nama</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="c" value="<?php echo $data['username']; ?>">
                        <label>Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="password" name="d" value="<?php echo '******'; ?>">
                        <label>Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="e" value="<?php echo $data['telp']; ?>">
                        <label>Telpon</label>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary btn-block" type="submit" name="update">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['update'])) {
        mysqli_query($koneksi, "UPDATE anggota SET
            nama     = '" . $_POST['b'] . "',
            username = '" . $_POST['c'] . "',
            password = '" . $_POST['d'] . "',
            telp     = '" . $_POST['e'] . "' WHERE id_anggota = '" . $_GET['id'] . "'");

        echo "<script>window.alert('Sukses Update Data Anggota.');
                window.location='anggota'</script>";
    }
} elseif ($_GET['aksi'] == 'hapus') {
    mysqli_query($koneksi, "DELETE FROM anggota where id_anggota='" . $_GET['id'] . "'");
    echo "<script>window.alert('Data Anggota Berhasil Dihapus.');
                window.location='anggota'</script>";
}
?>
