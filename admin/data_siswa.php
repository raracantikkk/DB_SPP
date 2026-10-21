<?php
include_once "../src/koneksi.php";
?>
<h1><b>DATA SISWA </b></h1>
<h4><a href="?open=tambah_siswa">+ Tambah Data</a></h3>
<table cellspacing="1" cellpadding="3">
  <tr>
    <td width="5%" bgcolor="#CCCCCC"><b>No.</b></td>
    <td width="5%" bgcolor="#CCCCCC"><b>NISN</b></td>
    <td width="5%" bgcolor="#CCCCCC"><b>NIS</b></td>
    <td width="20%" bgcolor="#CCCCCC"><b>Nama Siswa </b></td>
    <td width="10%" bgcolor="#CCCCCC"><b>Kelas</b></td>
    <td width="20%" bgcolor="#CCCCCC"><b>Alamat</b></td>
    <td width="20%" bgcolor="#CCCCCC"><b>No. Telepon</b></td>
    <td width="30%" bgcolor="#CCCCCC"><b>SPP</b></td>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><b>Tools</b></td>
  </tr>
<?php
$sql = mysqli_query($koneksi, "SELECT * FROM kelas JOIN siswa
on kelas.id_kelas = siswa.id_kelas JOIN spp on siswa.id_spp = spp.id_spp");
$nomor = 0;
while ($data = mysqli_fetch_array($sql)) {
    $nomor++;
?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $data['nisn']; ?></td>
    <td><?php echo $data['nis']; ?></td>
    <td><?php echo $data['nama']; ?></td>
    <td><?php echo $data['nama_kelas']; ?></td>
    <td><?php echo $data['alamat']; ?></td>
    <td><?php echo $data['no_telp']; ?></td>
    <td><?php echo $data['nominal']; ?></td>
    <td width="9%" align="center"><a href="?open=hapus_siswa&nisn=<?php echo $data['nisn']; ?>"
       target="_self" onclick="return confirm('YAKIN INGIN MENGHAPUS DATA SISWA INI ... ?')">Delete</a></td>
    <td width="9%" align="center"><a href="?open=edit_siswa&nisn=<?php echo $data['nisn']; ?>"
       target="_self">Edit</a></td>
  </tr>
<?php } ?>
</table>