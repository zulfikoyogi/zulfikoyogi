<!doctype html>
<html>
<head>
<meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Login</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    </head>
<body>
	<?php
    	if(isset($_POST['admin'])){
			echo"<script>document.location.href='admin'</script>";
		}
		if(isset($_POST['siswa'])){
			echo"<script>document.location.href='siswa'</script>";
		}
        if(isset($_POST['guru'])){
            echo"<script>document.location.href='guru'</script>";
        }
	?>
    <form method="post">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-4" style="float: none; margin: 0 auto;">
                        <h4 style="text-align: center;">Login Sebagai :</h4>
                    </div>
                    <div class="col-md-4" style="float: none; margin: 0 auto;">
                        <div class="row">
                            <div class="col-md-4"><input type="submit" name="admin" value="Administrator" class="btn btn-default"></div>
                            <div class="col-md-4"><input type="submit" name="siswa" value="Peserta Didik" class="btn btn-default"></div>
                            <div class="col-md-4"><input type="submit" name="guru" value="Guru" class="btn btn-default"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>