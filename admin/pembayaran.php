<?php
include_once "../src/koneksi.php";

// 1. Script proses update database saat tombol [Bayar] diklik
if(isset($_GET['id']) && $_GET['id'] != ''){
    $id_pembayaran = $_GET['id'];
    $nisn_asal = $_GET['nisn'];
    
    $no_bayar = date('dmYHis');
    $tgl_pembayaran = date('Y-m-d');
    $keterangan = "LUNAS";

    $update = mysqli_query($koneksi, "UPDATE pembayaran SET no_bayar='$no_bayar', tgl_pembayaran='$tgl_pembayaran', keterangan='$keterangan' WHERE id_pembayaran='$id_pembayaran'");

    if($update){
        echo "<script>alert('Pembayaran Berhasil!'); window.location='pembayaran.php?nisn=".$nisn_asal."';</script>";
        exit;
    } else {
        echo "<script>alert('Pembayaran Gagal!'); window.location='pembayaran.php?nisn=".$nisn_asal."';</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>SPP ONLINE</title>
    <link rel="stylesheet" type="text/css" href="src/style.css">
</head>
<body>
    <br/><br/>
<header>
    <h1 class="judul">PEMBAYARAN SPP ONLINE SMK NEGERI 3 BANJARBARU</h1>
</header>
    <div class="wrap">
        <div class="blog">
            <div class="conteudo">

                <h3>Transaksi Pembayaran SPP</h3>
                <form method="get" action="">
                    nisn: <input type="text" name="nisn" value="<?php echo isset($_GET['nisn']) ? $_GET['nisn'] : ''; ?>" />
                    <input type="hidden" name="open" value="data_pembayaran"/>
                    <input type="submit" name="cari" value="Cari Siswa" />
                </form>

<?php
if(isset($_GET['nisn']) && $_GET['nisn']!=''){
    $nisn = $_GET['nisn'];
    $sqlSiswa = mysqli_query($koneksi, "SELECT * FROM kelas join siswa on kelas.id_kelas = siswa.id_kelas join spp on siswa.id_spp = spp.id_spp WHERE nisn='$nisn'");
    $data=mysqli_fetch_array($sqlSiswa);
    if($data){
?>

<h3>Biodata Siswa</h3>
<table>
    <tr>
        <td>nisn</td>
        <td>:</td>
        <td><?php echo $data['nisn']; ?></td>
    </tr>
    <tr>
        <td>Nama Siswa</td>
        <td>:</td>
        <td><?php echo $data['nama']; ?></td>
    </tr>
    <tr>
        <td>Kelas</td>
        <td>:</td>
        <td><?php echo $data['nama_kelas']; ?></td>
    </tr>
</table>

<h3>Tagihan SPP Siswa</h3>
<table border="1">
    <tr>
        <th>No</th>
        <th>Bulan</th>
        <th>Tahun</th>
        <th>No. Bayar</th>
        <th>Tgl. Bayar</th>
        <th>Jumlah</th>
        <th>Keterangan</th>
    </tr>

<?php
    $sql = mysqli_query($koneksi, "SELECT pembayaran.*, spp.nominal FROM pembayaran join spp on pembayaran.id_spp = spp.id_spp WHERE nisn='$data[nisn]'");
    $no=1;
    while($row=mysqli_fetch_array($sql)){
        // 2. Logika kolom keterangan & link bayar (Pas 7 kolom, tanpa kolom Aksi terpisah)
        if($row['no_bayar'] == ''){
            $ket = "Belum Bayar <a href='pembayaran.php?id=$row[id_pembayaran]&nisn=$data[nisn]' style='color: blue;'>[Bayar]</a>";
        } else {
            $ket = "LUNAS";
        }

        echo "<tr>
            <td>$no</td>
            <td>$row[bulan_tagihan]</td>
            <td>$row[tahun_tagihan]</td>
            <td>$row[no_bayar]</td>
            <td>$row[tgl_pembayaran]</td>
            <td>$row[nominal]</td>
            <td>$ket</td>
        </tr>";
        $no++;
    }
?>
</table>

<?php
    } else {
        echo "<p style='color:red;'>Data siswa tidak ditemukan!</p>";
    }
}
?>

            </div>
        </div>
    </div>
</body>
</html>