<?php
include '../config/koneksi.php';

@session_start();
if (isset($_POST['simpan'])) {
    if ($_POST['nilai'] > 100) {
        echo "<script>alert('Data yang dimasukkan lebih dari 100');document.location.href='?menu=nilai'</script>";
    }else{
        mysqli_query($koneksi, "INSERT INTO nilai  (`id`, `id_siswa`, `id_guru`, `id_mapel`, `nilai`) VALUES (NULL, $_POST[nama], $_SESSION[id_guru], $_SESSION[id_mapel], $_POST[nilai]);");
            echo "<script>alert('Data Berhasil Disimpan');document.location.href='?menu=nilai'</script>";
    }
}
if (isset($_GET['hapus'])) {
    mysqli_query($koneksi, "DELETE FROM nilai WHERE id = $_GET[id]");
    echo "<script>alert('Data yang dimasukkan lebih dari 100');document.location.href='?menu=nilai'</script>";
}
if (isset($_GET['edit'])) {
    $sql= mysqli_query($koneksi, "SELECT * FROM nilai where id='$_GET[id]'");
    $edit= mysqli_fetch_array($sql);
}
if (isset($_POST['ubah'])) {
        mysqli_query($koneksi, "UPDATE nilai SET id_siswa = '$_POST[nama]', nilai = $_POST[nilai] WHERE id = '$_GET[id]'");
        echo "<script>alert('Data Berhasil Diupdate');document.location.href='?menu=nilai'</script>";
    }
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Input Nilai</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    </head>
<body>
    <section>
        <div class="container">
            <div class="row">
                <form method="post">
                    <div class="col-md-5" style="float: none; margin: 0 auto;">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Form Input Nilai</h3>
                            </div>
                            <table class="table">
                                <tr>
                                    <td>Nama Siswa</td>
                                    <td>:</td>
                                    <td>
                                        <select name="nama" class="input" required="required">
                                            <option>Pilih Siswa</option>
                                                <?php
                                                    $sql_siswa = mysqli_query($koneksi,"SELECT * FROM siswa");
                                                    while($data_siswa = mysqli_fetch_array($sql_siswa)){
                                                    ?>
                                                    <option value="<?php echo $data_siswa ['id'] ?>"
                                                        <?php if($data_siswa['id'] == $edit['id_siswa']):?> selected <?php endif;?> ><?php echo $data_siswa ['nama'] ?></option>
                                                <?php } ?>    
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nilai</td>
                                    <td>:</td>
                                    <td><input type="text" name="nilai" class="form-control" value="<?php echo $edit['nilai']; ?>"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <?php if ($_GET['id']=="") { ?>
                                        <input type="submit" name="simpan" class="btn btn-info" value="Simpan">
                                        <?php }else{ ?>
                                        <input type="submit" name="ubah" class="btn btn-info" value="Ubah">
                                        <?php } ?>
                                    </td>
                                </tr>
                            </table>
                            <table class="table">
                                <tr>
                                    <td>No.</td>
                                    <td>Nama Siswa</td>
                                    <td>Nilai</td>
                                    <td>Aksi</td>
                                </tr>
                                <?php 
                                $no = 1;
                                $sql_nilai = mysqli_query($koneksi,"SELECT `nilai`.*, `mapel`.`nama` as nama_mapel, `siswa`.`nama` as nama_siswa, `guru`.`nama` as nama_guru  FROM `nilai` INNER JOIN `mapel` ON `nilai`.`id_mapel` = `mapel`.`id` INNER JOIN `siswa` ON `nilai`.`id_siswa` = `siswa`.id INNER JOIN `guru` ON `nilai`.`id_guru` = `guru`.id");
                                while($data_siswa = mysqli_fetch_array($sql_nilai)){
                                    ?>
                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <td><?php echo $data_siswa['nama_siswa']; ?></td>
                                        <td><?php echo $data_siswa['nilai']; ?></td>
                                        <td><a href="?menu=nilai&hapus&id=<?php echo $data_siswa['id'];?>" onClick="return confirm('Hapus Data Ini???')" class="btn btn-danger">HAPUS</a></td>
                                        <td><a href="?menu=nilai&edit&id=<?php echo $data_siswa['id'];?>" class="btn btn-info">EDIT</a></td>
                                    </tr>
                                    <?php
                                    $no++;
                                    }
                                    ?>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>