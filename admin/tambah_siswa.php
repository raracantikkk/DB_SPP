<?php
include_once "../src/koneksi.php";

# SKRIP TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
    $nisn       = $_POST['nisn'];
    $nis        = $_POST['nis'];
    $nama       = $_POST['nama'];
    $id_kelas   = $_POST['id_kelas'];
    $alamat     = $_POST['alamat'];
    $no_telp    = $_POST['no_telp'];
    $id_spp     = $_POST['id_spp'];
    
    // Array 12 bulan tagihan
    $arraybulan = array("Juli","Agustus","September","Oktober","Nopember","Desember",
                        "Januari","Februari","Maret","April","Mei","Juni");

    // Validasi Form Inputs
    $pesanError = array();
    if (trim($nisn)=="") {
        $pesanError[] = "Data <b>NISN </b> tidak boleh kosong !";
    }
    if (trim($nis)=="") {
        $pesanError[] = "Data <b>NIS</b> tidak boleh kosong !";
    }
    if (trim($nama)=="") {
        $pesanError[] = "Data <b>NAMA</b> tidak boleh kosong !";
    }
    if (trim($id_kelas)=="" || $id_kelas=="Kosong") {
        $pesanError[] = "Data <b>ID KELAS</b> tidak boleh kosong !";
    }
    if (trim($alamat)=="") {
        $pesanError[] = "Data <b>ALAMAT</b> tidak boleh kosong !";
    }
    if (trim($no_telp)=="") {
        $pesanError[] = "Data <b>NOMOR TELEPON</b> tidak boleh kosong !";
    }
    if (trim($id_spp)=="" || $id_spp=="Kosong") {
        $pesanError[] = "Data <b>ID SPP</b> tidak boleh kosong !";
    }

    // Menampilkan Pesan Error dari Form
    if (count($pesanError)>=1){
        $noPesan=0;
        foreach ($pesanError as $indeks=>$pesan_tampil) {
            $noPesan++;
            echo "&nbsp; $noPesan. $pesan_tampil<br>";
        }
        echo "<br>";
    }
    else {
        // 1. Simpan data siswa ke tabel siswa
        $sql = mysqli_query($koneksi, "INSERT INTO siswa (nisn, nis, nama, id_kelas, alamat, no_telp, id_spp)
        VALUES('$nisn', '$nis', '$nama', '$id_kelas', '$alamat', '$no_telp', '$id_spp')");
        if($sql){
            // 2. Ambil NISN siswa yang baru saja disimpan
            $ds = mysqli_fetch_array(mysqli_query($koneksi, "SELECT nisn FROM siswa WHERE nisn = '$nisn'"));
            $nisn_siswa = $ds['nisn'];

            // 3. Proses pembuatan 12 tagihan otomatis ke tabel pembayaran
            $tahunsekarang = date('Y');

            for($i=0; $i<12; $i++){
                $bulan = $arraybulan[$i];

                if ($i == 6) {
                    $tahunsekarang++;
                }

                mysqli_query($koneksi, "INSERT INTO pembayaran (nisn, bulan_tagihan, tahun_tagihan, id_spp)
                VALUES('$nisn_siswa', '$bulan', '$tahunsekarang', '$id_spp')");
            }

            echo "<center><b><font color = 'red' size = '4'><p> Data Berhasil disimpan </p>
            </center></b></font> </br>";
            echo "<meta http-equiv='refresh' content='2; url=?open=data_siswa'>";
        }
        else{
            echo "<center><b><font color = 'red' size = '4'><p> Data Gagal Disimpan!
            <meta http-equiv='refresh' content='2; url=?open=data_siswa'>";
        }
        exit;
    }
}
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
    <table cellspacing="1" cellpadding="3">
        <tr>
            <td bgcolor="#CCCCCC"><strong>TAMBAH DATA SISWA </strong></td>
        </tr>
        <tr>
            <td>NISN</td>
            <td>:</td>
            <td><input name="nisn" type="text" size="10" maxlength="10" /></td>
        </tr>
        <tr>
            <td>NIS </td>
            <td>:</td>
            <td><input name="nis" type="text" size="20" maxlength="10" /></td>
        </tr>
        <tr>
            <td>NAMA </td>
            <td>:</td>
            <td><input name="nama" type="text" size="50" maxlength="50" /></td>
        </tr>
        <tr>
            <td>KELAS </td>
            <td>:</td>
            <td>
                <select name="id_kelas">
                    <option value="Kosong">..... </option>
                    <?php
                    $tampilkanKelas = mysqli_query($koneksi, "select * from kelas");
                    while ($bacaData = mysqli_fetch_array($tampilkanKelas)){
                        echo "<option value='$bacaData[id_kelas]'>$bacaData[nama_kelas]</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Alamat </td>
            <td>:</td>
            <td><input name="alamat" type="text" size="50" maxlength="50" /></td>
        </tr>
        <tr>
            <td>No. Telepon </td>
            <td>:</td>
            <td><input name="no_telp" type="text" size="50" maxlength="50" /></td>
        </tr>
        <tr>
            <td>Nominal </td>
            <td>:</td>
            <td>
                <select name="id_spp">
                    <option value="Kosong">..... </option>
                    <?php
                    $tampilkanSPP = mysqli_query($koneksi, "select * from spp");
                    while ($bacaData = mysqli_fetch_array($tampilkanSPP)){
                        echo "<option value='$bacaData[id_spp]'> $bacaData[nominal]</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td> <td>&nbsp;</td>
            <td><input name="btnSimpan" type="submit" value="Simpan" /></td>
        </tr>
    </table>
</form>