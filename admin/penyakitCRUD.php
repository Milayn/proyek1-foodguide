<!DOCTYPE html>
<html>
<title>Home Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styleHome.css">

<body>
    <!-- Sidebar -->
    <div class="w3-sidebar bg-sidebar w3-bar-block" style="width:20%">
        <div class="admin">
            <h5><b>Admin</b></h5>
        </div>
        <a href="index.php" class="w3-bar-item w3-button">Penyakit</a>
        <a href="rekomendasiCRUD.php" class="w3-bar-item w3-button">Rekomendasi</a>
        <a href="pantanganCRUD.php" class="w3-bar-item w3-button">Pantangan</a>
        <a href="resepCRUD.php" class="w3-bar-item w3-button">Resep</a>
        <div class="logout">
            <a href="../index.html">Log Out</a>
        </div>
    </div>

    <!-- Page Content -->
    <div style="margin-left:20%">

        <div class="w3-container w3-teal">
            <br>
            <h1>
                <center><b>Data Penyakit</b></center>
            </h1><br><br>
        </div><br>
        <div class="w3-container">
            <div class="w3-container">
                <form action="penyakitCRUD.php" method="get">
                    <label><b> Cari</b></label>
                    <input type="text" name="cari">
                    <input type="submit" value="Cari" class="btn btn-success">
                </form>
                <br>
                <div class="menu">
                    <a href="rekomendasiCRUD.php"> Rekomendasi </a>
                </div>
                <div class="tambah">
                    <a href="insertPenyakit.html"> Tambah Data </a>
                </div>
                <table>
                    <tr>
                        <th>ID Penyakit</th>
                        <th>Nama Penyakit</th>
                        <th>Gambar</th>
                    </tr>
                    <?php
                    include "koneksi.php";
                    if(isset($_GET['cari'])){
                        $cari = $_GET['cari'];
                        $query="SELECT idpenyakit, namapenyakit, gambarpenyakit
                        from penyakit where namapenyakit like '%$cari%' OR idpenyakit like '%$cari%' 
                        OR idpenyakit like '%$cari%' OR keterangan like '%$cari%'";	
                        if($cari==null)	{
                            $query = "SELECT idpenyakit, namapenyakit, gambarpenyakit
                        from penyakit";
                        }		
                    }else{
                        $query = "SELECT idpenyakit, namapenyakit, gambarpenyakit
                        from penyakit";	
                    }
                    $result = mysqli_query($connect, $query);
                    $query = "SELECT p.idpenyakit, p.namapenyakit, p.gambarpenyakit from penyakit p";
                    $result = mysqli_query($connect, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                    ?>
                            <tr>
                                <td><?php echo $row["idpenyakit"] ?></td>
                                <td><?php echo $row["namapenyakit"] ?></td>
                                <td><?php echo '<img src = "images/penyakit/' . $row['gambarpenyakit'] . '">' ?></td>

                                <td>
                                    <div class="aksi">
                                        <div class="edit">
                                            <a href="editPenyakit.php?idpenyakit=<?php echo $row['idpenyakit']; ?>">Edit</a>
                                        </div>
                                        <div class="hapus">
                                            <a href="hapusPenyakit.php?idpenyakit=<?php echo $row['idpenyakit']; ?>">Hapus</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "0 result";
                    }
                    ?>
                </table>
            </div>

        </div>

</body>

</html>