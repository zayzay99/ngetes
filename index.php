<?php
include "config.php";

$nis = @$_POST['tNis']; 
$nama = @$_POST['tNama']; 
$jk = @$_POST['tJk'];
$rombel = @$_POST['tRombel']; 
$simpan = @$_POST['tombolsimpan']; 
if(isset($simpan)){
    if(isset($jk)){
        if($jk=="L"){ 
            $jk="Laki-laki"; 
        }else{
            $jk="Perempuan";
        }
    }
    $masuk=mysqli_query($konek,"INSERT INTO namasiswatk (NIS,Nama,JK,Rombel) VALUES('$nis','$nama','$jk','$rombel')");
    
    if($masuk){
        echo "<script>alert('berhasil masuk'); document.location.href='index.php';</script>";
    }else{
        echo "<script>alert('gagal masuk');</script>";
    }
}

$hapus = @$_GET['delete'];
if(!empty($hapus)){
    $sql=mysqli_query($konek,"DELETE From namasiswatk WHERE NIS =$hapus ");
    if($hapus){
        echo "<script>alert('berhasil masuk'); document.location.href='index.php';</script>";
    }else{
        echo "<script>alert('gagal masuk');</script>";
        
    }
    }  
    
    $getNIS = @$_GET['nis'];
$tombolEdit = @$_GET['edit'];
if(isset($tombolEdit)){
    $edit= mysqli_query($konek,"SELECT * FROM namasiswatk WHERE NIS =$getNIS");
    $summon = mysqli_fetch_array($edit);
    if($edit){
        echo "<script>alert('$getNIS');</script>";
    }
}

if(isset($_POST['tombolupdate'])) {
    $nis = $_POST['tNis']; 
    $nama = $_POST['tNama']; 
    $jk = ($_POST['tJk'] == 'L') ? 'Laki-laki' : 'Perempuan';
    $rombel = $_POST['tRombel']; 

    $update =  mysqli_query($konek, "UPDATE namasiswatk SET Nama = '$nama', JK  = '$jk', Rombel = '$rombel' WHERE NIS = '$getNIS'");

    if ($update){
        echo "<script>alert('Data berhasil diperbarui'); document.location.herf='mysql.php';</script>";
    }  else {
        echo "<script>alert('Gagal memperbarui data');</script>";
    } 
}



    ?>
<form action="" method="post">
    <table>
        <tr>
            <td> NIS </td>
            <td><input type="text" name="tNis" value="<?php echo @$summon['NIS']?>" <?php if (!empty($getNIS)){ echo "readonly"; }else{ echo "";}?>/></td>
        </tr>
        <tr>
            <td> Nama </td>
            <td><input type="text" name="tNama" value="<?php echo @$summon['Nama']?>"/></td>
        </tr>
        <tr>
            <td> JK </td>
            <td>
                <input type="radio" name="tJk" value="L" <?php if (@$summon['JK'] =='Laki-laki') echo 'checked'; ?>>Laki-laki
                <input type="radio" name="tJk" value="P" <?php if (@$summon['JK'] =='Perempuan') echo 'checked'; ?>>Perempuan
            </td>
        </tr>
        <tr>
            <td> Rombel </td>
            <td><input type="text" name="tRombel" value="<?php echo @$summon['Rombel']?>"/></td>
        </tr>
        <tr>    
        <td colspan="2" align="right"><input type="submit" name="tombolsimpan" value="simpan"
            colspan="2" align="right"><input type="submit" name="tombolupdate" value="update"></td>
            </tr>
        </table>
    
    </form>
    <?php
        include("config.php");
    ?>
    
    <style>
        table{
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td,{
            padding: 10px;
        }
        th {
            background-color; blue;
            color: white;
        }
        </style>

        
    <table border="2">
        <tr>
        <td align="center" bgcolor="yellow">NIS</td>
            <td align="center" bgcolor="grey">Nama</td>
            <td align="center" bgcolor="grey">Jenis kelamin</td>
            <td align="center" bgcolor="grey">Rombel</td>
            <td align="center" colspan="1" bgcolor="grey">Hapus</td>
            <td align="center" colspan="2" bgcolor="grey">Edit</td>
        </tr>
        <?php
     $panggil=mysqli_query($konek,"SELECT * FROM namasiswatk ORDER by Nama ASC");
     while($data=mysqli_fetch_array($panggil)){
    ?>
     
    <tr>
        <td><?php echo $data['NIS']?></td>
        <td><?php echo $data['Nama']?></td>
        <td><?php echo $data['JK']?></td>
        <td><?php echo $data['Rombel']?></td>
        <td><a href="<?php echo'?delete='.$data['NIS']?>"><img src="gambar/sampah.jpg" width="30px" height="30" alt="tombol hapus" ></a></td>
        <td><a href="<?php echo'?edit&nis='.$data['NIS']?>"><img src="gambar/download.png" width="30px" height="30" alt="tombol edit" ></a></td>
    </tr>
    <?php
     }
   
?>
</table>