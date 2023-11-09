<?php
    $anggota = mysqli_query($koneksi, "SELECT * FROM anggota");
    $jumlah_anggota = mysqli_num_rows($anggota);
    
    $buku = mysqli_query($koneksi, "SELECT * FROM buku ");
    $jumlah_buku = mysqli_num_rows($buku);
    
    $pinjaman = mysqli_query($koneksi, "SELECT * FROM peminjaman where id_peminjaman ");
    $jumlah_peminjaman = mysqli_num_rows($pinjaman);

    $petugas = mysqli_query($koneksi, "SELECT * FROM petugas ");
    $jumlah_petugas = mysqli_num_rows($petugas);
?>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card text-center bg-primary text-white mb-4">
                                <div class="card-body card-title"><h1><?php echo $jumlah_anggota; ?></h1></div>
                                <div class="card-footer ">
                                Jumlah anggota
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card text-center bg-primary text-white mb-4">
                                <div class="card-body card-title"><h1><?php echo $jumlah_peminjaman; ?></h1></div>
                                <div class="card-footer ">
                                Jumlah Peminjam
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card text-center bg-primary text-white mb-4">
                                <div class="card-body card-title"><h1><?php echo $jumlah_buku; ?></h1></div>
                                <div class="card-footer ">
                                Jumlah Buku
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card text-center bg-primary text-white mb-4">
                                <div class="card-body card-title"><h1><?php echo $jumlah_petugas; ?></h1></div>
                                <div class="card-footer ">
                                Jumlah Petugas
                                </div>
                            </div>
                    </div>                        
                </div>