<?php
    include "koneksi.php";

    $idpenyakit = $_POST['idpenyakit'];
    $namapenyakit = $_POST['namapenyakit'];
    $gambarpenyakit = $_POST['gambarpenyakit'];

    //mengambil data foto yang dipilih dalam form
    $gambarpenyakit = $_FILES['gambarpenyakit']['name'];//mengambil nama file yg diupload
    $tmp = $_FILES['gambarpenyakit']['tmp_name'];

    //mencari idpenyakit yang memeliki namapenyakit tertentu
    // $sql ="SELECT idpenyakit from penyakit where namapenyakit= '$namapenyakit'";
    // $hasil= mysqli_query($connect, $sql);

    // if(mysqli_num_rows($hasil)>0){
    //      while($row = mysqli_fetch_array($hasil)){    
    //         $idpenyakit = $row["idpenyakit"];
    //     }
    // }
    // else{
    //     echo "0 hasil";
    // }

    if(empty($gambarpenyakit)){//jika user tidak memilih file foto pada form
        $query = "UPDATE penyakit SET namapenyakit='$namapenyakit'
        WHERE idpenyakit ='$idpenyakit'";
    }else{
        $gambarpenyakitbaru = date('dmYHis').$gambarpenyakit;
        $path = "images/penyakit/".$gambarpenyakitbaru;

        if(move_uploaded_file($tmp, $path)){     
            $sql = "SELECT * FROM penyakit WHERE idpenyakit='$idpenyakit'";
            $hasil = mysqli_query($connect,$sql);

            if(mysqli_num_rows($hasil)>0){
                while($row = mysqli_fetch_array($hasil)){  
                    if(is_file("images/penyakit/".$row['gambarpenyakitbaru']))
                    unlink("images/penyakit/".$row['gambarpenyakitbaru']);
                }
            }
            //Proses ubah data
            $query = "UPDATE penyakit SET namapenyakit='$namaresep', gambarpenyakit = '$gambarpenyakitbaru'
            WHERE idpenyakit ='$idpenyakit'";
        } 
    }
    $result = mysqli_query($connect,$query);

    if($result){
        // echo "Berhasil update data";
        echo '
        <script type="text/JavaScript"> 
            alert("Data Berhasil di-Update!");
            document.location.href="index.php"
        </script>';
?>
    <a href="index.php">Lihat Data</a>
<?php
    }
    else{
        // echo "Gagal update data". mysqli_error($connect);
        echo '
        <script type="text/JavaScript"> 
            alert("Hufft, Data Gagal di-Update!");
            document.location.href="index.php"
        </script>';
    }
?>