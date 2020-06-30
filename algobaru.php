<?php
require 'database.php';
require 'main.php';

//hasil ditampilkan di file tampilan, belum dibuat

function cekKamus($kata){
	$conn = mysqli_connect("localhost", "root", "", "nlp_scamming");
	$sql = mysqli_query($conn, "SELECT * FROM tb_katadasar WHERE katadasar = '$kata' LIMIT 1");
	$result = mysqli_fetch_array($sql);

	if ($result == null) {
		return false;
	}else{
		return true;
	}
}

function hapus_kata_akhir($kata){
	$kata_baru = $kata;
	if (preg_match_all("/pun|[kl]ah|nya|[km]u|an\z/i", $kata)){
		$kata_dasar = preg_replace("/pun|[kl]ah|nya|[km]u|an\z/i", "", $kata);
		if (cekKamus($kata_dasar)) {
			return $kata_dasar;
		}
	}
	if (preg_match_all("/kan|i|isasi\z/i", $kata)){
		$kata_dasar = preg_replace("/kan|i\z/i", "", $kata);
		if (cekKamus($kata_dasar)) {
			return $kata_dasar;
		}
	}
	return $kata_baru;
}

function cek_kata_belakang($kata){
	if (preg_match_all("/pun|[kl]ah|nya|[km]u|i|an|kan\z/i", $kata)){
		$kata_dasar = preg_replace("/pun|[kl]ah|nya|[km]u|i|an|kan\z/i", "", $kata);
		return $kata_dasar;
	}
}

function hapus_semua_awalan($kata){
	$kata_baru = $kata;

	if (preg_match_all("/^(di|ke|se)/i", $kata)) {
		$kata_dasar = preg_replace("/^(di|ke|se)/i","", $kata);
		if(cekKamus($kata_dasar)){
			return $kata_dasar;
		}
		$cek_kata_belakang = hapus_kata_akhir($kata_dasar);
		if (cekKamus($cek_kata_belakang)) {
			return $cek_kata_belakang;
		}
		if (preg_match_all("/^(diper)/i", $kata)) {
			$kata_dasar2 = preg_replace("/^(diper)/i", "", $kata);
			if (cekKamus($kata_dasar2)) {
				return $kata_dasar2;
			}
			$cekKata = hapus_kata_akhir($kata_dasar2);
			if (cekKamus($kata_dasar2)) {
				return $kata_dasar2;
			}
		}
	}
	return $kata_baru;
}

$kata = convertarray($masukan);

function hasil($kata){
	$kata_baru = $kata;

	if(cekKamus($kata)){
		return $kata;
	}
	$kata = hapus_kata_akhir($kata);
	$kata = hapus_semua_awalan($kata);
	return $kata;
}

$akhir = [];
foreach ($kata as $value) {
	array_push($akhir, hasil($value));
}
var_dump($akhir);

?>
