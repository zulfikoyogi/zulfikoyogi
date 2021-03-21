<?php
include '../config/koneksi.php';
@session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Nilai Siswa</title>

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
                                <h3 class="panel-title">Form Nilai Siswa</h3>
                            </div>
                            <table class="table">
                                <tr>
                                    <td>No.</td>
                                    <td>Nama Siswa</td>
                                    <td>Nama Guru</td>
                                    <td>Mata Pelajaran</td>
                                    <td>Nilai</td>
                                </tr>
                                <?php 
                                $no = 1;
                                $sql_nilai = mysqli_query($koneksi,"SELECT `nilai`.*, `mapel`.`nama` as nama_mapel, `siswa`.`nama` as nama_siswa, `guru`.`nama` as nama_guru  FROM `nilai` INNER JOIN `mapel` ON `nilai`.`id_mapel` = `mapel`.`id` INNER JOIN `siswa` ON `nilai`.`id_siswa` = `siswa`.id INNER JOIN `guru` ON `nilai`.`id_guru` = `guru`.id WHERE nilai.id_siswa = $_SESSION[id_siswa]" );
                                while($data_siswa = mysqli_fetch_array($sql_nilai)){
                                    ?>
                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <td><?php echo $data_siswa['nama_siswa']; ?></td>
                                        <td><?php echo $data_siswa['nama_guru']; ?></td>
                                        <td><?php echo $data_siswa['nama_mapel']; ?></td>
                                        <td><?php echo $data_siswa['nilai']; ?></td>
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