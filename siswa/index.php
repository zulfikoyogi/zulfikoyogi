<?php 
include "../config/koneksi.php";

if(isset($_POST['login'])) {
    @$sql = mysqli_query($koneksi, "SELECT * FROM siswa WHERE username ='$_POST[user]' AND password = '$_POST[pass]'");
    @$cek = mysqli_num_rows($sql);

    if($cek > 0) {
        @session_start();
        $row = mysqli_fetch_array($sql);
        $_SESSION['id_siswa'] = $row['id'];
        $_SESSION['nama'] = $row['nama'];
        echo "<script>alert('Selamat Datang $_POST[user] ... ');document.location.href='home.php?menu=home'</script>";
    } else {
        echo "<script>alert('Username atau Password Anda Salah!!!');document.location.href='index.php'</script>";
    }
}
if(isset($_POST['batal'])) {
    echo "<script>document.location.href='../';</script>";
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Login</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<body>
    <form method="post">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Login Form</h3>
            </div>
            <table class="table">
                <tr>
                    <td>Username</td>
                    <td>:</td>
                    <td><input type="text" name="user" class="form-control"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>:</td>
                    <td><input type="password" name="pass" class="form-control"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <input type="submit" name="login" value="Login" class="btn btn-info btn-sm">
                        <input type="submit" name="batal" value="Batal" class="btn btn-danger btn-sm">
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</form>

</body>
</html>