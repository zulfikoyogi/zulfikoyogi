<?php
include '../config/koneksi.php';
@session_start();
if($_SESSION['nama']=='' AND $_SESSION['nama_mapel']=='')
{
    header("location:index.php");
}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Form Guru</title>

	<!-- Bootstrap -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="?menu=home">Home</a></li>
					<li><a href="?menu=nilai">Input Nilai</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li style="padding-top: 15px; padding-bottom: 15px; padding-right: 15px;"><strong><?php echo $_SESSION['nama']?></strong></li>
					<li style="padding-top: 15px; padding-bottom: 15px;"><strong><?php echo $_SESSION['nama_mapel']?></strong></li>
					<li><a href="logout.php" onClick="return confirm ('Anda Yakin Ingin Keluar?')">Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>
</body>
</html>
<div>
	<?php
    	switch ($_GET['menu']){
			case "home";
				echo '<h4 style="text-align: center;">Selamat Datang di Halaman Guru</h4>';
			break;
	
			case "nilai";
			include "nilai.php";
			break;
		}
	?>
</div>