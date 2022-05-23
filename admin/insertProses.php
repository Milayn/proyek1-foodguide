<?php
    include "koneksi.php";

    // $idresep =$_POST['idresep'];
    $idpenyakit =$_POST['idpenyakit'];
    $namaresep =$_POST['namaresep'];
    //$gambarresep = $_POST['gambarresep'];
    $gambarresep = $_FILES['gambarresep']['name'];//mengambil nama file yg diupload
    $tmp = $_FILES['gambarresep']['tmp_name'];//mengambil path folder sementara file yang diupload
    $bahan =$_POST['bahan'];
    $caramembuat =$_POST['caramembuat'];

    //merename nama foto dengan menmabhkan tanggal dan jam upload
    $fotobaru = date('dmYHis').$gambarresep;

    //memilih path unutk menyimpan foto
    
    $path= "images/".$fotobaru;

    //proses mengupload data
    if(move_uploaded_file($tmp, $path)){
        $sql = "INSERT INTO resep(idpenyakit, namaresep, gambarresep, bahan, caramembuat)
        VALUES('$idpenyakit','$namaresep', '$fotobaru', '$bahan', '$caramembuat')";
    }else{
        echo '
        <script type="text/JavaScript"> 
            alert("Wahh! Sepertinya Ada Data Yang Belum Diisi");
            document.location.href="resepCRUD.php"
        </script>';
    }

    if(mysqli_query($connect, $sql)){
        // echo "Data berhasil ditambahkan";
        echo '
        <script type="text/JavaScript"> 
            alert("Data Berhasil Ditambahkan!");
            document.location.href="resepCRUD.php"
        </script>';
?>
    <a href="index.php">Lihat Data</a>
<?php
    }
    else{
        // echo "Data gagal ditambahkan <br>" .mysqli_error($connect);
        echo '
        <script type="text/JavaScript"> 
            alert("Data Gagal Ditambahkan!!");
            document.location.href="resepCRUD.php"
        </script>';
    }
    mysqli_close($connect);
    
?>