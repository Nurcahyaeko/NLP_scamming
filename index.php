<?php
include "database.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Upload PDF untuk Stemming</title>
	<style type="text/css">
		body {
			font-family: verdana;
			font-size: 12px;
		}
		a {
			text-decoration: none;
			color: #3050F3;
		}
		a:hover {
			color: #000F5E;
		} 		
		#tengah {
			width: 800px;
			margin-left: auto;
			margin-right: auto;
			background-color: cyan;
		}			
	</style>
	<!-- bootstrap -->
	<link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
</head>
<body>
	<br><br><br>



	<div id="tengah">
		<div>
			<!--   Big container   -->
			<div class="container">
				<div >
					<h1 align="center">Upload PDF untuk Stemming</h1>
					<hr>
					<form action="upload.php" method="POST" enctype="multipart/form-data">
						<table width="600" border="0">
							<tr>
								<td width="100">Judul File</td>
								<td><input type="text" name="judul" placeholder="Judul" required></td>
							</tr>
							<tr>
								<td width="100">File PDF</td>
								<td><input type="file" name="nama_file" required></td>
							</tr>
							<tr>
								<td width="100"></td>
								<td><input type="submit" value="Upload File"></td>
							</tr>
						</table>
					</form>

					<hr>
					<b>List File</b>


					<form action="view.php" method="GET" >
						<table class="table table-striped">
							<tr align="center">
								<th width="10">No</th>
								<th width="100">Judul</th>
								<th width="100">Nama File</th>
								<th width="100">View</th>
								<th width="100">Hapus</th>
							</tr>
							<?php
							$query = mysqli_query($conn,"SELECT * FROM data_file ORDER BY id DESC");
							$urutan = 1;
							while($data=mysqli_fetch_array($query))
							{
								?>
								<tr align="center">
									<td ><?php echo $urutan;?></td>
									<td ><?php echo $data['judul'];?></td>
									<td><?php echo $data['nama_file'];?></td>
									<th><a href="tampil.php?nama_file=<?php echo $data['nama_file'];?>">Proses</a></th>
									<th><a href="hapus.php?id=<?php echo $data['id'];?>">Hapus File</a></th>
								</tr>
								<?php
								$urutan = $urutan + 1;
							}
							?>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>

</body>
</html>