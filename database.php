<?php

$conn = mysqli_connect("localhost", "root", "", "nlp_stemming");
$result = mysqli_query($conn, "SELECT * FROM tb_katadasar");

if( !$result ) {
   echo mysqli_error($conn);
 }

 ?>