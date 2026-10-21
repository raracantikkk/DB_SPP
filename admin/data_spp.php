<?php
include_once "../src/koneksi.php";
?>

<h1><b>DATA SPP</b></h1>
<h4><a href="?open=tambah_spp">+ Tambah Data</a></h4>

<table cellspacing="1" cellpadding="3">
    <tr>
        <td width="5%" bgcolor="#CCCCCC"><b>No</b></td>
        <td width="15%" bgcolor="#CCCCCC"><b>ID SPP</b></td>
        <td width="40%" bgcolor="#CCCCCC"><b>Tahun</b></td>
        <td width="20%" bgcolor="#CCCCCC"><b>Nominal</b></td>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><b>Tools</b></td>
    </tr>
<?php
$sql = mysqli_query($koneksi, "SELECT * FROM spp ORDER BY id_spp ASC");
$nomor = 0;
while ($data = mysqli_fetch_array($sql)) {
    $nomor++;
?>
    <tr>
        <td><?php echo $nomor; ?></td>
        <td><?php echo $data['id_spp']; ?></td>
        <td><?php echo $data['tahun']; ?></td>
        <td><?php echo $data['nominal']; ?></td>
        <td width="9%" align="center">
            <a href="?open=hapus_spp&id_spp=<?php echo $data['id_spp']; ?>"
             target="_self" onclick="return confirm('YAKIN INGIN MENGHAPUS DATA SPP INI ... ?')">Delete</a></td>
        <td width="9%" align="center">
            <a href="?open=edit_spp&id_spp=<?php echo $data['id_spp']; ?>"
   target="_self">Edit</a></td>
</tr>
<?php } ?>
</table>