<?php
if (!isset($_GET['aksi'])) {
    ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Peminjaman</h1>
        <div class="card mb-4">
            <div class="card-header">
                <a type="button" class="btn btn-primary" href="index.php?page=peminjaman&aksi=tambah">Pinjam Buku</a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID Peminjaman</th>
                            <th>Kode Buku</th>
                            <th>ID Anggota</th>
                            <th>ID Petugas</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pinjam = mysqli_query($koneksi, "SELECT p.id_peminjaman, b.kode_buku, a.id_anggota, pt.id_petugas, p.tgl_pinjam, p.tgl_kembali, p.status 
                                                      FROM peminjaman p
                                                      JOIN buku b ON p.kode_buku = b.kode_buku
                                                      JOIN anggota a ON p.id_anggota = a.id_anggota
                                                      JOIN petugas pt ON p.id_petugas = pt.id_petugas");
                        $no = 1;
                        while ($data = mysqli_fetch_array($pinjam)) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $data['id_peminjaman']; ?>
                                </td>
                                <td>
                                    <?php echo $data['kode_buku']; ?>
                                </td>
                                <td>
                                    <?php echo $data['id_anggota']; ?>
                                </td>
                                <td>
                                    <?php echo $data['id_petugas']; ?>
                                </td>
                                <td>
                                    <?php echo $data['tgl_pinjam']; ?>
                                </td>
                                <td>
                                    <?php echo $data['tgl_kembali']; ?>
                                </td>
                                <td>
                                    <?php echo $data['status']; ?>
                                </td>
                                <td>
                                    <a
                                        href="index.php?page=peminjaman&aksi=edit&id=<?php echo $data['id_peminjaman']; ?>">Edit</a>
                                    |
                                    <a
                                        href="index.php?page=peminjaman&aksi=hapus&id=<?php echo $data['id_peminjaman']; ?>">Hapus</a>
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
        <h1 class="mt-4">Peminjaman</h1>
        <div class="card mb-4 col-md-8">
            <div class="card-header">
                <h5>Pinjam Buku</h5>
            </div>
            <div class="card-body">
                <form action='' method="POST">
                    <div class="form-floating mb-3">
                        <select class="form-select" name="b">
                            <?php
                            $buku = mysqli_query($koneksi, "SELECT kode_buku FROM buku");
                            while ($row = mysqli_fetch_array($buku)) {
                                echo '<option value="' . $row['kode_buku'] . '">' . $row['kode_buku'] . '</option>';
                            }
                            ?>
                        </select>
                        <label>Kode Buku</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="c">
                            <?php
                            $anggota = mysqli_query($koneksi, "SELECT id_anggota FROM anggota");
                            while ($row = mysqli_fetch_array($anggota)) {
                                echo '<option value="' . $row['id_anggota'] . '">' . $row['id_anggota'] . '</option>';
                            }
                            ?>
                        </select>
                        <label>ID Anggota</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="d">
                            <?php
                            $petugas = mysqli_query($koneksi, "SELECT id_petugas FROM petugas");
                            while ($row = mysqli_fetch_array($petugas)) {
                                echo '<option value="' . $row['id_petugas'] . '">' . $row['id_petugas'] . '</option>';
                            }
                            ?>
                        </select>
                        <label>ID Petugas</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="date" name="e">
                        <label>Tanggal Pinjam</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="date" name="f">
                        <label>Tanggal Kembali</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="g">
                            <option value="pengajuan">Pengajuan</option>
                            <option value="proses">Proses</option>
                            <option value="selesai">Selesai</option>
                        </select>
                        <label>Status</label>
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
        $kode_buku = $_POST['b'];
        $id_anggota = $_POST['c'];
        $id_petugas = $_POST['d'];
        $tgl_pinjam = $_POST['e'];
        $tgl_kembali = $_POST['f'];
        $status = $_POST['g'];

        $query = "INSERT INTO peminjaman (kode_buku, id_anggota, id_petugas, tgl_pinjam, tgl_kembali, status)
           VALUES ('$kode_buku', '$id_anggota', '$id_petugas', '$tgl_pinjam', '$tgl_kembali', '$status')";

        if (mysqli_query($koneksi, $query)) {
            echo "<script>window.alert('Sukses Meminjam Buku.');
                    window.location='index.php?page=peminjaman'</script>";
        } else {
            echo "<script>window.alert('Gagal Meminjam Buku.');
                    window.location='index.php?page=peminjaman&aksi=tambah'</script>";
        }
    }
} elseif ($_GET['aksi'] == 'edit') {
    $peminjaman = mysqli_query($koneksi, "SELECT * FROM peminjaman where id_peminjaman='" . $_GET['id'] . "'");
    $data = mysqli_fetch_array($peminjaman);
    ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Peminjaman</h1>
        <div class="card mb-4 col-md-8">
            <div class="card-header">
                <h5>Update Peminjaman</h5>
            </div>
            <div class="card-body">
                <form action='' method="POST">
                    <div class="form-floating mb-3">
                        <select class="form-select" name="b">
                            <?php
                            $buku = mysqli_query($koneksi, "SELECT kode_buku FROM buku");
                            while ($row = mysqli_fetch_array($buku)) {
                                $selected = ($row['kode_buku'] == $data['kode_buku']) ? 'selected' : '';
                                echo '<option value="' . $row['kode_buku'] . '" ' . $selected . '>' . $row['kode_buku'] . '</option>';
                            }
                            ?>
                        </select>
                        <label>Kode Buku</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="c">
                            <?php
                            $anggota = mysqli_query($koneksi, "SELECT id_anggota FROM anggota");
                            while ($row = mysqli_fetch_array($anggota)) {
                                $selected = ($row['id_anggota'] == $data['id_anggota']) ? 'selected' : '';
                                echo '<option value="' . $row['id_anggota'] . '" ' . $selected . '>' . $row['id_anggota'] . '</option>';
                            }
                            ?>
                        </select>
                        <label>ID Anggota</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="d">
                            <?php
                            $petugas = mysqli_query($koneksi, "SELECT id_petugas FROM petugas");
                            while ($row = mysqli_fetch_array($petugas)) {
                                $selected = ($row['id_petugas'] == $data['id_petugas']) ? 'selected' : '';
                                echo '<option value="' . $row['id_petugas'] . '" ' . $selected . '>' . $row['id_petugas'] . '</option>';
                            }
                            ?>
                        </select>
                        <label>ID Petugas</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="date" name="e" value="<?php echo $data['tgl_pinjam']; ?>">
                        <label>Tanggal Pinjam</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="date" name="f" value="<?php echo $data['tgl_kembali']; ?>">
                        <label>Tanggal Kembali</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="g">
                            <option value="pengajuan" <?php if ($data['status'] == 'pengajuan')
                                echo 'selected'; ?>>Pengajuan
                            </option>
                            <option value="proses" <?php if ($data['status'] == 'proses')
                                echo 'selected'; ?>>Proses</option>
                            <option value="selesai" <?php if ($data['status'] == 'selesai')
                                echo 'selected'; ?>>Selesai
                            </option>
                        </select>
                        <label>Status</label>
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
        $kode_buku = $_POST['b'];
        $id_anggota = $_POST['c'];
        $id_petugas = $_POST['d'];
        $tgl_pinjam = $_POST['e'];
        $tgl_kembali = $_POST['f'];
        $status = $_POST['g'];

        $query = "UPDATE peminjaman SET
            kode_buku = '$kode_buku',
            id_anggota = '$id_anggota',
            id_petugas = '$id_petugas',
            tgl_pinjam = '$tgl_pinjam',
            tgl_kembali = '$tgl_kembali',
            status = '$status'
            WHERE id_peminjaman = '" . $_GET['id'] . "'";

        if (mysqli_query($koneksi, $query)) {
            echo "<script>window.alert('Sukses Update Peminjaman.');
                    window.location='index.php?page=peminjaman'</script>";
        } else {
            echo "<script>window.alert('Gagal Update Peminjaman.');
                    window.location='index.php?page=peminjaman&aksi=edit&id=" . $_GET['id'] . "'</script>";
        }
    }
} elseif ($_GET['aksi'] == 'hapus') {
    mysqli_query($koneksi, "DELETE FROM peminjaman where id_peminjaman='" . $_GET['id'] . "'");
    echo "<script>window.alert('Data Peminjaman Berhasil Dihapus.');
                window.location='index.php?page=peminjaman'</script>";
}
?>