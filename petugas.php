<?php
if (!isset($_GET['aksi'])) {
    ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Petugas</h1>
        <div class="card mb-4">
            <div class="card-header">
                <a class="btn btn-primary" href="index.php?page=petugas&aksi=tambah">Tambah Petugas</a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Petugas</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Telpon</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $petugas = mysqli_query($koneksi, "SELECT * FROM petugas");
                        $no = 1;
                        while ($data = mysqli_fetch_array($petugas)) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $no; ?>
                                </td>
                                <td>
                                    <?php echo $data['nama_petugas']; ?>
                                </td>
                                <td>
                                    <?php echo $data['username']; ?>
                                </td>
                                <td>******</td>
                                <td>
                                    <?php echo $data['telp']; ?>
                                </td>
                                <td>
                                    <?php echo $data['level']; ?>
                                </td>
                                <td>
                                    <a href="index.php?page=petugas&aksi=edit&id=<?php echo $data['id_petugas']; ?>">Edit</a> |
                                    <a href="index.php?page=petugas&aksi=hapus&id=<?php echo $data['id_petugas']; ?>">Hapus</a>
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
        <h1 class="mt-4">Petugas</h1>
        <div class="card mb-4 col-md-8">
            <div class="card-header">
                <h5>Tambah Petugas</h5>
            </div>
            <div class="card-body">
                <form action='' method="POST">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="b">
                        <label for="b">Nama Petugas</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="c">
                        <label for="c">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="password" name="d">
                        <label for="d">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="e">
                        <label for="e">Telpon</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="g">
                            <option value="Admin">Admin</option>
                            <option value="Petugas">Petugas</option>
                        </select>
                        <label for="g">Level</label>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary btn-block" type="submit" name="tambah">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['tambah'])) {
        $password = md5($_POST['d']); // Mengenkripsi password dengan MD5
        // Lakukan query INSERT untuk menambahkan petugas baru ke database
        mysqli_query($koneksi, "INSERT INTO petugas (nama_petugas, username, password, telp, level) VALUES (
            '" . $_POST['b'] . "',
            '" . $_POST['c'] . "',
            '" . $password . "',
            '" . $_POST['e'] . "',
            '" . $_POST['g'] . "')");

        echo "<script>window.alert('Sukses Tambah Data Petugas.');
                window.location='index.php?page=petugas'</script>";
    }

} elseif ($_GET['aksi'] == 'edit') {
    $petugas = mysqli_query($koneksi, "SELECT * FROM petugas where id_petugas='" . $_GET['id'] . "'");
    $data = mysqli_fetch_array($petugas);
    ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Petugas</h1>
        <div class="card mb-4 col-md-8">
            <div class="card-header">
                <h5>Update Petugas</h5>
            </div>
            <div class="card-body">
                <form action='' method="POST">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="b" value="<?php echo $data['nama_petugas']; ?>">
                        <label for="b">Nama Petugas</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="c" value="<?php echo $data['username']; ?>">
                        <label for="c">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="password" name="d" value="******">
                        <label for="d">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="e" value="<?php echo $data['telp']; ?>">
                        <label for="e">Telpon</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="g">
                            <option value="Admin" <?php if ($data['level'] == 'Admin')
                                echo 'selected'; ?>>Admin</option>
                            <option value="Petugas" <?php if ($data['level'] == 'Petugas')
                                echo 'selected'; ?>>Petugas
                            </option>
                        </select>
                        <label for="g">Level</label>
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
        $password = md5($_POST['d']); // Mengenkripsi password dengan MD5
        mysqli_query($koneksi, "UPDATE petugas SET
            nama_petugas = '" . $_POST['b'] . "',
            username     = '" . $_POST['c'] . "',
            telp         = '" . $_POST['e'] . "',
            password     = '" . $password . "',
            level        = '" . $_POST['g'] . "' WHERE id_petugas = '" . $_GET['id'] . "'");

        echo "<script>window.alert('Sukses Update Data Petugas.');
                window.location='index.php?page=petugas'</script>";
    }
} elseif ($_GET['aksi'] == 'hapus') {
    mysqli_query($koneksi, "DELETE FROM petugas where id_petugas='" . $_GET['id'] . "'");
    echo "<script>window.alert('Data Petugas Berhasil Dihapus.');
                window.location='index.php?page=petugas'</script>";
}
?>