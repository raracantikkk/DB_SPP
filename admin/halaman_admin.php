<html>
<head>
    <title>SPP ONLINE</title>
    <link rel="stylesheet" type="text/css" href="../src/style.css">
</head>
<body>
<?php
    session_start();
    // cek apakah yang mengakses halaman ini sudah login
    if($_SESSION['level']==""){
        header("location:index.php?pesan=gagal");
    }
?>

<br/><br/>
<!-- bagian header template -->
<header>
    <h1 class="judul">PEMBAYARAN SPP ONLINE SMK NEGERI 3 BANJARMASIN</h1>
</header>
<!-- akhir bagian header template -->

<!-- bagian menu -->
<div class="wrap">
    <nav class="menu">
        <?php include "menu.php"; ?>
    </nav>
    <!-- akhir bagian menu -->

    <div class="main-content">
        <!-- bagian isi (posisi di kiri) -->
        <div class="blog">
            <div class="conteudo">
                <?php include "buka_file.php"; ?>
            </div>
        </div>
        <!-- akhir bagian isi -->

        <!-- bagian sidebar website (posisi di kanan) -->
        <aside class="sidebar">
            <div class="widget">
                <h2>Selamat Datang, <?php echo $_SESSION['username']; ?></h2>
                <p>Selamat datang aplikasi pembayaran SPP SMK NEGERI 3 Banjarbaru</p>
            </div>
        </aside>
        <!-- akhir bagian sidebar website -->
    </div>
</div>

</body>
</html>       