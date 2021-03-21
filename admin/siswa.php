<?php
include '../config/koneksi.php';

    if (isset($_POST['simpan'])) {
        mysqli_query($koneksi, "INSERT INTO siswa (`id`, `nama`, `jk`, `tgl_lahir`, `username`, `password`) VALUES ('', '$_POST[nama]','$_POST[jk]', '$_POST[tgl_lahir]','$_POST[username]','$_POST[password]');");
        echo "<script>alert('Data Berhasil Disimpan');document.location.href='?menu=siswa'</script>";
    }
    if (isset($_GET['hapus'])) {
        mysqli_query($koneksi, "DELETE FROM siswa WHERE id='$_GET[id]'");
        echo "<script>alert('Data Berhasil Dihapus');document.location.href='?menu=siswa'</script>";
    }
    if (isset($_GET['edit'])) {
        $sql= mysqli_query($koneksi, "SELECT * FROM siswa where id='$_GET[id]'");
        $edit= mysqli_fetch_array($sql);

    }
    if (isset($_POST['ubah'])) {
        mysqli_query($koneksi, "UPDATE siswa SET nama = '$_POST[nama]', jk = '$_POST[jk]', tgl_lahir = '$_POST[tgl_lahir]', username = '$_POST[username]', password = '$_POST[password]' WHERE id = '$_GET[id]'");
        echo "<script>alert('Data Berhasil Dupdate');document.location.href='?menu=siswa'</script>";
    }
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Input Data Siswa</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    </head>
<body>
    <section>
        <div class="container">
            <div class="row">
                <form method="post">
                    <div class="col-md-8" style="float: none; margin: 0 auto;">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Form Input Data Siswa</h3>
                            </div>
                            <table class="table">
                                <tr>
                                    <td>Nama Siswa</td>
                                    <td>:</td>
                                    <td><input type="text" name="nama" class="form-control" value="<?php echo $edit['nama'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>:</td>
                                    <td>
                                        <select name="jk">
                                            <option><?php echo $edit['jk'];?></option>
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td>:</td>
                                    <td><input type="date" name="tgl_lahir" value="<?php echo $edit['tgl_lahir']?>"></td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td>:</td>
                                    <td><input type="text" name="username" class="form-control" value="<?php echo $edit['username'] ?>"></td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td>:</td>
                                    <td><input type="text" name="password" class="form-control" value="<?php echo $edit['password'] ?>"></td>
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
                                    <td>Jenis Kelamin</td>
                                    <td>Username</td>
                                    <td>Password</td>
                                    <td colspan="2">Aksi</td>
                                </tr>
                                <?php 
                                $no = 1;
                                $sql_siswa = mysqli_query($koneksi,"SELECT * FROM siswa ORDER BY nama asc");

                                while($d = mysqli_fetch_array($sql_siswa)){
                                    ?>
                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <td><?php echo $d['nama']; ?></td>
                                        <td><?php echo $d['jk']; ?></td>
                                        <td><?php echo $d['tgl_lahir']; ?></td>
                                        <td><?php echo $d['username']; ?></td>
                                        <td><?php echo $d['password']; ?></td>
                                        <td><a href="?menu=siswa&hapus&id=<?php echo $d['id'];?>" onClick="return confirm('Hapus Data Ini???')" class="btn btn-danger">HAPUS</a></td>
                                        <td><a href="?menu=siswa&edit&id=<?php echo $d['id'];?>" class="btn btn-info">EDIT</a></td>
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