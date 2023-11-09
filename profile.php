<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('koneksi.php');

$username = $_SESSION['username'];
$petugas = "SELECT * FROM petugas WHERE username = '$username'";
$hasil = mysqli_query($koneksi, $petugas);

if (mysqli_num_rows($hasil) == 1) {
    $row = mysqli_fetch_assoc($hasil);
    $nama_petugas = $row['nama_petugas'];
    $level = $row['level'];
} else {
    echo "Data petugas tidak ditemukan.";
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="profile.css">
    <title>Profil Petugas</title>
</head>

<body>
    <div class="container">
        <h1>Profile login</h1>
        <h2>Nama: <span><?php echo $nama_petugas; ?></span></h2>
        <p>Level: <span><?php echo $level; ?></span></p>
        <button class="dashboard-button"><a href="index.php">Dashboard</a></button>
        <button class="logout-button"><a href="logout.php">Logout</a></button>
    </div>
</body>

</html>
