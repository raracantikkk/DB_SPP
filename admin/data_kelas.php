<?php
include_once "../src/koneksi.php";
?>
<h1><b>DATA KELAS </b></h1>
<h4><a href="?open=tambah_kelas">+ Tambah Data</a></h3>
<table cellspacing="1" cellpadding="3">
  <tr>
    <td width="5%" bgcolor="#CCCCCC"><b>No</b></td>
    <td width="15%" bgcolor="#CCCCCC"><b>ID Kelas</b></td>
    <td width="20%" bgcolor="#CCCCCC"><b>Nama Kelas </b></td>
    <td width="30%" bgcolor="#CCCCCC"><b>Kompetensi Keahlian</b></td>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><b>Tools</b></td>
  </tr>
<?php
$sql = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY id_kelas ASC");
$nomor = 0;
while ($data = mysqli_fetch_array($sql)) {
    $nomor++;
?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $data['id_kelas']; ?></td>
    <td><?php echo $data['nama_kelas']; ?></td>
    <td><?php echo $data['kompetensi_keahlian']; ?></td>
    <td width="9%" align="center"><a href="?open=hapus_kelas&id_kelas=<?php echo $data['id_kelas']; ?>"
       target="_self" onclick="return confirm('YAKIN INGIN MENGHAPUS DATA KELAS INI ... ?')">Delete</a></td>
    <td width="9%" align="center"><a href="?open=edit_kelas&id_kelas=<?php echo $data['id_kelas']; ?>"
       target="_self">Edit</a></td>
  </tr>
<?php } ?>
</table>