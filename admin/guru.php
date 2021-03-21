<?php 
    include '../config/koneksi.php';

    if (isset($_POST['simpan'])) {
        mysqli_query($koneksi, "INSERT INTO `guru` (`id`, `nama`, `id_mapel`, `username`, `password`) VALUES (NULL, '$_POST[nama]', '$_POST[mapel]', '$_POST[username]', '$_POST[password]');");
        echo "<script>alert('Data Berhasil Disimpan');document.location.href='?menu=guru'</script>";
    }
    if (isset($_GET['hapus'])) {
        mysqli_query($koneksi, "DELETE FROM guru WHERE id = $_GET[id]");
        echo "<script>alert('Data Berhasil Dihapus');document.location.href='?menu=guru'</script>";
    }
    if (isset($_GET['edit'])) {
        $sql= mysqli_query($koneksi, "SELECT `guru`.*, `mapel`.`nama` as nama_mapel  FROM `guru` INNER JOIN `mapel` ON `guru`.`id_mapel` = `mapel`.`id` WHERE `guru`.`id`='$_GET[id]'");
        $edit= mysqli_fetch_array($sql);
    }
    if (isset($_POST['ubah'])) {
        mysqli_query($koneksi, "UPDATE `guru` SET `nama` = '$_POST[nama]', `id_mapel` = '$_POST[mapel]', `username` = '$_POST[username]', `password` = '$_POST[password]' WHERE `id` ='$_GET[id]';");
        echo "<script>alert('Data Berhasil Dihapus');document.location.href='?menu=guru'</script>";
    }
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">=
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Input Guru</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    </head>
<body>
    <section>
        <div class="container">
            <div class="row">
                <form method="post">
                    <div class="col-md-7" style="float: none; margin: 0 auto;">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Form Input Guru</h3>
                            </div>
                            <table class="table">
                                <tr>
                                    <td>Nama Guru</td>
                                    <td>:</td>
                                    <td><input type="text" name="nama" class="form-control" required="required" value="<?php echo $edit['nama'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>Mata Pelajaran</td>
                                    <td>:</td>
                                    <td>
                                        <select name="mapel" required="required">
                                            <option value="<?php echo $edit['id_mapel']; ?>"><?php echo $edit['mapel']; ?>Pilih Mata Pelajaran</option>
                                                <?php
                                                    $sql_mapel = mysqli_query($koneksi,"SELECT * FROM mapel");
                                                    while($option = mysqli_fetch_array($sql_mapel)){
                                                    ?>
                                                    <option value="<?php echo $option ['id'] ?>"  <?php if( $edit['id_mapel'] == $option['id']){
                                                        echo "selected";
                                                    } ?>     ><?php echo $option ['nama'] ?></option>
                                                <?php } ?>    
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td>:</td>
                                    <td><input type="text" name="username" class="form-control" required="required" value="<?php echo $edit['username'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td>:</td>
                                    <td><input type="text" name="password" class="form-control" required="required" value="<?php echo $edit['password'] ?>"></td>
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
                                    <td>Nama</td>
                                    <td>Mata Pelajaran</td>
                                    <td>Username</td>
                                    <td>Password</td>
                                    <td colspan="2">Aksi</td>
                                </tr>
                                <?php
                                    $no = 1;
                                    $sql_guru = mysqli_query($koneksi,"SELECT `guru`.*, `mapel`.`nama` as nama_mapel  FROM `guru` INNER JOIN `mapel` ON `guru`.`id_mapel` = `mapel`.`id` ORDER BY nama asc");
                                    while($d = mysqli_fetch_array($sql_guru)){
                                ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $d['nama']; ?></td>
                                    <td><?php echo $d['nama_mapel']; ?></td>
                                    <td><?php echo $d['username']; ?></td>
                                    <td><?php echo $d['password']; ?></td>
                                    <td><a href="?menu=guru&hapus&id=<?php echo $d['id'];?>" onClick="return confirm('Hapus Data Ini???')" class="btn btn-danger">HAPUS</a></td>
                                    <td><a href="?menu=guru&edit&id=<?php echo $d['id'];?>" class="btn btn-info">EDIT</a></td>
                                </tr>
                                <?php $no++; } ?>
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