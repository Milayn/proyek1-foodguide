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
  <a href="reseprCRUD.php" class="w3-bar-item w3-button">Resep</a>
  <div class="logout">
    <a href="../index.html">Log Out</a>
  </div>
</div>

<!-- Page Content -->
<div style="margin-left:20%">

<div class="w3-container w3-teal">
  <br><h1><center><b>Menu Pantangan</b></center></h1><br><br>
</div><br>
<div class="w3-container">
    <div class="w3-container">
        <div class="tambah">
            <a href="InsertPantangan.html"> Tambah Data</a>
        </div>
    <table>
        <tr>
            <th>ID Pantangan</th>
            <th>ID Penyakit</th>
            <th>Nama Pantangan</th>           
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
        <?php
            include "koneksi.php";
            $query ="SELECT idpantangan, idpenyakit, namapantangan, keterangan
            from menupantangan";
            $result = mysqli_query($connect, $query);

            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_array($result)){    
        ?>
        <tr>
            <td><?php echo $row["idpantangan"]?></td>
            <td><?php echo $row["idpenyakit"]?></td>
            <td><?php echo $row["namapantangan"]?></td>
            <td><?php echo nl2br(htmlspecialchars($row["keterangan"]))?></td>
            
            <td>
                <div class="aksi">
                    <div class="edit">
                        <a href="editPantangan.php?idpantangan=<?php echo $row['idpantangan'];?>">Edit</a>
                    </div>
                    <div class="hapus">
                        <a href="hapusPantangan.php?idpantangan=<?php echo $row['idpantangan'];?>">Hapus</a>
                    </div>
                </div>
            </td>
        </tr>
        <?php
                }
            }
            else{
                echo "0 result";
            }
        ?>
    </table>
</div>

</div>
      
</body>
</html>
