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
    if (trim($id_kelas)=="") {
        $pesanError[] = "Data <b>ID KELAS</b> tidak boleh kosong !";
    }
    if (trim($alamat)=="") {
        $pesanError[] = "Data <b>ALAMAT</b> tidak boleh kosong !";
    }
    if (trim($no_telp)=="") {
        $pesanError[] = "Data <b>NOMOR TELEPON</b> tidak boleh kosong !";
    }
    if (trim($id_spp)=="") {
        $pesanError[] = "Data <b>ID SPP</b> tidak boleh kosong !";
    }

    // Menampilkan Pesan Error dari Form
    if (count($pesanError)>=1 ){
        $noPesan=0;
        foreach ($pesanError as $indeks=>$pesan_tampil) {
            $noPesan++;
            echo "&nbsp; $noPesan. $pesan_tampil<br>";
        }
        echo "<br>";
    }
    else {
        // Skrip Simpan data ke Database
        $sqlEdit = mysqli_query($koneksi, "UPDATE siswa set nis='$nis', nama='$nama',
        id_kelas='$id_kelas', alamat='$alamat', no_telp='$no_telp', id_spp='$id_spp' WHERE nisn='$nisn'");
        if($sqlEdit){
            echo "<center> <b> <font color = 'red' size = '4'> <p> Data Berhasil diubah </p>
            </center> </b> </font> </br>";
            echo "<meta http-equiv='refresh' content='2; url=?open=data_siswa'>";
        }
        else{
            echo "<center> <b> <font color = 'red' size = '4'> <p> Data Gagal Disimpan!
            <meta http-equiv='refresh' content='2; url=?open=data_siswa'>";
        }
        exit;
    }
}

# MEMBACA DATA DARI DATABASE UNTUK DIEDIT
$nisn   = $_GET['nisn'];
$sql    = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn ='$nisn'");
$data   = mysqli_fetch_array($sql);

?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" >
  <table cellspacing="1" cellpadding="3">
    <tr>
      <td bgcolor="#CCCCCC"><strong>EDIT DATA SISWA </strong></td>
    </tr>
    <tr>
      <td>NISN</td>
      <td>:</td>
      <td><input name="nisn" type="text" size="10" maxlength="10" value="<?php echo $data['nisn']; ?>" 
         readonly = "true"/></td>
    </tr>
    <tr>
      <td>NIS </td>
      <td>:</td>
      <td><input name="nis" type="text" size="20" maxlength="10" value="<?php echo $data['nis']; ?>" /></td>
    </tr>
    <tr>
      <td>NAMA </td>
      <td>:</td>
      <td><input name="nama" type="text" size="50" maxlength="50" value="<?php echo $data['nama']; ?>" /></td>
    </tr>
    <tr>
      <td>KELAS </td>
      <td>:</td>
      <td>
        <select name="id_kelas">
          <option value="Kosong">..... </option>
          <?php
          $tampilkanKelas = mysqli_query ($koneksi, "select * from kelas");
          while ($bacaData = mysqli_fetch_array($tampilkanKelas)){
              if($bacaData['id_kelas']== $data['id_kelas']){
                  $cek = " selected";
              }else {
                  $cek = "";}
              echo "<option value= '$bacaData[id_kelas]' $cek> $bacaData[nama_kelas]</option>";
          }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>Alamat </td>
      <td>:</td>
      <td><input name="alamat" type="text" size="50" maxlength="50" value="<?php echo $data['alamat']; ?>" /></td>
    </tr>
    <tr>
      <td>No. Telepon </td>
      <td>:</td>
      <td><input name="no_telp" type="text" size="50" maxlength="50" value="<?php echo $data['no_telp']; ?>" /></td>
    </tr>
    <tr>
      <td>Nominal </td>
      <td>:</td>
      <td>
        <select name="id_spp">
          <option value="Kosong">..... </option>
          <?php
          $tampilkanSPP = mysqli_query ($koneksi, "select * from spp");
          while ($bacaData = mysqli_fetch_array($tampilkanSPP)){
              if($bacaData['id_spp']== $data['id_spp']){
                  $cek = " selected";
              }else {
                  $cek = "";}
              echo "<option value= '$bacaData[id_spp]' $cek> $bacaData[nominal]</option>";
          }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="btnSimpan" type="submit" value="Simpan" /></td>
    </tr>
  </table>
</form>