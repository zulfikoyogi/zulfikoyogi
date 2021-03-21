<?php
session_start();
session_destroy();
echo "<script>alert('Anda Berhasil Keluar');document.location.href='../'</script>";
?>