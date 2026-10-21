<?php
# KONTROL MENU PROGRAM
if(isset($_GET['open'])) {
    // Jika mendapatkan variabel URL ?open
    switch($_GET['open']){
        case '' :
            if(!file_exists ("informasi_utama.php")) die ("File tidak ada !");
            include "informasi_utama.php"; break;

            case 'data_spp' :
            if(!file_exists ("data_spp.php")) die ("File tidak ada !");
            include "data_spp.php"; break;

        case 'tambah_spp' :
            if(!file_exists ("tambah_spp.php")) die ("File tidak ada !");
            include "tambah_spp.php"; break;

        case 'hapus_spp' :
            if(!file_exists ("hapus_spp.php")) die ("File tidak ada !");
            include "hapus_spp.php"; break;

        case 'edit_spp' :
            if(!file_exists ("edit_spp.php")) die ("File tidak ada !");
            include "edit_spp.php"; break;

            case 'data_kelas' :
        if(!file_exists ("data_kelas.php")) die ("File tidak ada !");
        include "data_kelas.php"; break;

    case 'tambah_kelas' :
        if(!file_exists ("tambah_kelas.php")) die ("File tidak ada !");
        include "tambah_kelas.php"; break;

    case 'hapus_kelas' :
        if(!file_exists ("hapus_kelas.php")) die ("File tidak ada !");
        include "hapus_kelas.php"; break;

    case 'edit_kelas' :
        if(!file_exists ("edit_kelas.php")) die ("File tidak ada !");
        include "edit_kelas.php"; break;
        
        case 'data_siswa' :
        if(!file_exists ("data_siswa.php")) die ("File tidak ada !");
        include "data_siswa.php"; break;

    case 'tambah_siswa' :
        if(!file_exists ("tambah_siswa.php")) die ("File tidak ada !");
        include "tambah_siswa.php"; break;

    case 'hapus_siswa' :
        if(!file_exists ("hapus_siswa.php")) die ("File tidak ada !");
        include "hapus_siswa.php"; break;

    case 'edit_siswa' :
        if(!file_exists ("edit_siswa.php")) die ("File tidak ada !");
        include "edit_siswa.php"; break;

        case 'data_petugas':
    if(!file_exists("data_petugas.php")) die ("File tidak ada!");
    include "data_petugas.php"; break;

case 'tambah_petugas':
    if(!file_exists("tambah_petugas.php")) die ("File tidak ada!");
    include "tambah_petugas.php"; break;

case 'hapus_petugas':
    if(!file_exists("hapus_petugas.php")) die ("File tidak ada!");
    include "hapus_petugas.php"; break;

case 'edit_petugas':
    if(!file_exists("edit_petugas.php")) die ("File tidak ada!");
    include "edit_petugas.php"; break;

    case 'data_pembayaran' :
    if(!file_exists ("pembayaran.php")) die ("File tidak ada !");
    include "pembayaran.php";   break;

        default:
            if(!file_exists ("informasi_utama.php")) die ("File tidak ada !");
            include "informasi_utama.php";
            break;
    }
}
else {
    // Jika tidak mendapatkan variabel URL : ?open
    if(!file_exists ("informasi_utama.php")) die ("File tidak ada !");
    include "informasi_utama.php";
}
?>