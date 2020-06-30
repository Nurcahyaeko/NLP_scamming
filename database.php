<?php

$conn = mysqli_connect("localhost", "root", "", "nlp_scamming");
$result = mysqli_query($conn, "SELECT * FROM tb_kata");

if( !$result ) {
   echo mysqli_error($conn);
 }

 ?>