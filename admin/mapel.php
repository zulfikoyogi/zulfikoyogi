<?php
include "../config/koneksi.php";
    
    if (isset($_POST['simpan'])) {
        mysqli_query($koneksi,"INSERT INTO mapel (`id`, `nama`) VALUES ('', '$_POST[nama]');");
        echo "<script>alert('Data Berhasil Disimpan');document.location.href='?menu=mapel'</script>";
    }
    if (isset($_GET['hapus'])) {
        mysqli_query($koneksi,"DELETE FROM mapel where id='$_GET[id]' ");
        echo "<script>alert('Data Berhasil Dihapus');document.location.href='?menu=mapel'</script>";
    }
    if (isset($_GET['edit'])) {
        $sql= mysqli_query($koneksi, "SELECT * FROM mapel where id='$_GET[id]'");
        $edit= mysqli_fetch_array($sql);
    }
    if (isset($_POST['ubah'])) {
        mysqli_query($koneksi, "UPDATE mapel SET nama = '$_POST[nama]' WHERE id = '$_GET[id]'");
        echo "<script>alert('Data Berhasil Dupdate');document.location.href='?menu=mapel'</script>";
    }
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Input Mata Pelajaran</title>

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
                                <h3 class="panel-title">Form Input Mata Pelajaran</h3>
                            </div>
                            <table class="table">
                                <tr>
                                    <td>Nama Mata Pelajaran</td>
                                    <td>:</td>
                                    <td><input type="text" name="nama" class="form-control" required="required" value="<?php echo $edit['nama'] ?>"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <?php if ($_GET['id']=="") { ?>
                                        <input type="submit" name="simpan" class="btn btn-primary" value="Simpan">
                                        <?php }else{ ?>
                                        <input type="submit" name="ubah" class="btn btn-success" value="Ubah">
                                        <?php } ?>
                                    </td>
                                </tr>
                            </table>
                            <table class="table">
                                <tr>
                                    <td>No.</td>
                                    <td>Nama Mata Pelajaran</td>
                                    <td colspan="2">Aksi</td>
                                </tr>
                                <?php 
                                $no = 1;
                                $sql_mapel = mysqli_query($koneksi,"SELECT * FROM mapel");

                                while($d = mysqli_fetch_array($sql_mapel)){
                                    ?>
                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <td><?php echo $d['nama']; ?></td>
                                        <td><a href="?menu=mapel&hapus&id=<?php echo $d['id'];?>" onClick="return confirm('Hapus Data Ini???')" class="btn btn-danger">HAPUS</a></td>
                                        <td><a href="?menu=mapel&edit&id=<?php echo $d['id'];?>" class="btn btn-info">EDIT</a></td>
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