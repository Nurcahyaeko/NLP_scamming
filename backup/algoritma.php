<?php 

require 'database.php';

$kata = "dipermudahkan";

echo ("kata asli : "). $kata;
echo ("<br>Hasil : ");

function cekKamus($kata){
	$conn = mysqli_connect("localhost", "root", "", "nlp_scamming");
	$sql = mysqli_query($conn, "SELECT * FROM tb_kata WHERE kata_dasar = '$kata' LIMIT 1");
	$result = mysqli_fetch_array($sql);
	
	if ($result == null) {
		//return "null";
		return false;
	}else{
		// return "ada";		
		return true;		
	}
}
// echo cekKamus($kata);

function hapus_kata_akhir($kata){
	$kata_baru = $kata;
	if (preg_match_all("/pun|[kl]ah|nya|[km]u\z/i", $kata)){
		$kata_dasar = preg_replace("/pun|[kl]ah|nya|[km]u\z/i", "", $kata);

		return $kata_dasar;
	}
	return $kata_baru;
}

//echo hapus_kata_akhir($kata);

//kata yang diperbolehkan 
function hapus_depan_belakang($kata){
	if (preg_match_all("/^(be)([a-z0-9])+(i)\z/i", $kata)) {
		//return "true";
		return true;
	}
	if (preg_match_all("/^(se)([a-z0-9])+(i|kan)\z/i", $kata)) {
		// return "true";
		return true;
	}
return false;
}

//echo hapus_depan_belakang($kata);

/////hapus akhiran "i", "an"
function hapus_kata_akhiran($kata){
	$kata_baru = $kata;
	if (preg_match_all("/(i|an)\z/i", $kata)) {
		$cekKata = preg_replace("/(i|an)\z/i", "", $kata);
		if (cekKamus($cekKata)) {
			return $cekKata;
		}

	}
	return $kata_baru;
}
//echo hapus_kata_akhiran($kata);

function hapus_semua_awalan($kata){
	$kata_baru = $kata;

	//tentukan tipe awalan
	if (preg_match_all("/^(di|ke|se)/i", $kata)) {
		$cekKata = preg_replace("/^(di|ke|se)/i","", $kata);
		if(cekKamus($cekKata)){
			return $cekKata;
		}
		$cekKata2 = hapus_kata_akhiran($cekKata);
		if (cekKamus($cekKata2)) {
				return $cekKata2;
		}
		
		// diper-------
		if (preg_match_all("/^(diper)/i", $kata)) {
			$cekKata = preg_replace("/^diper/i", "", $kata);
			if (cekKamus($cekKata)) {
				return $cekKata;
			}
			//...
		}
		// ....end diper

	}

	// if(preg_match_all("/^([tmbp]e)/i",$kata)) {//Jika awalannya adalah “te-”, “me-”, “be-”, atau “pe-”
	// 	//.....
	// }

	// if (preg_match_all("/^(di|[kstbmp]e)/i", $kata)) == false {
	// 	return $kata_baru;
	// }
	return $kata_baru;
}

//echo hapus_semua_awalan($kata);

function Hasil($kata){
	$kata_baru = $kata;

	if(cekKamus($kata)){
		return $kata;
	}

	$kata = hapus_kata_akhir($kata);

	$kata = hapus_kata_akhiran($kata);

	$kata = hapus_semua_awalan($kata);

	return $kata;
}

echo Hasil($kata);

?>