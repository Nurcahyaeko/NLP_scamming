<?php
include "database.php";
$id    = mysqli_real_escape_string($conn,$_GET['id']);
$query = mysqli_query($conn,"DELETE FROM data_file WHERE id='$id' ");
header('location:index.php?pesan=hapus-berhasil');
?>