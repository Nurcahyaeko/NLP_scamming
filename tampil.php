
<!DOCTYPE html>


<?php include "algobaru.php"; ?>
<html>
<head>
	<title>Program Stemming</title>	
	<style>     
		#tengah {
			width: 800px;
			margin-left: auto;
			margin-right: auto;
		}
	</style>
	<link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
</head>
<body>
<div id="tengah">
	<h1 align="center">Dokumen Hasil Stemming</h1>	
	<hr>

	<form>
		<table border="1" cellpadding="10" cellspacing="4" align="center" class="table table-striped">

			<tr>
				<th>No.</th>
				<th>Sebelum</th>
				<th>Sesudah</th>

			</tr>	
			<?php foreach ($akhir as $key => $value) : ?>
				<tr>			
					<td><?php echo $key; ?></td>
					<td><?php echo $value['sebelum']; ?></td>
					<td><?php echo $value['sesudah']; ?></td>
				</tr>
			<?php endforeach;  ?>
		</table>
	</form>
	<hr>
	</div>


</body>
</html>
