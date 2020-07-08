<?php
require 'database.php';
require 'main.php';


//$kata = "sifati";

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

//hapus kata akhiran
function hapus_kata_akhir($kata){
	$kata_baru = $kata;
	//hapus -pun -kah -lah -annya -ku -mu -i -kan
	if (preg_match_all('/(pun|kah|lah|annya|[km]u|i|kan|kannya)\z/i', $kata)){
		$_kata = preg_replace('/(pun|kah|lah|annya|[km]u|i|kan|kannya)\z/i', "", $kata);
		if (cekKamus($_kata)) {
			return $_kata;
		}
	}
	//hapus -an -isasi -nya
	if (preg_match_all("/(an|isasi|nya)\z/i", $kata)){
		$_kata = preg_replace("/(an|isasi|nya)\z/i", "", $kata);
		if (cekKamus($_kata)) {
			return $_kata;
		}
	}
	return $kata_baru;
}

//cek kata akhiran
function cek_kata_belakang($kata){
	if (preg_match_all("/(pun|[kl]ah|kannya|[km]u|kan|isasi)\z/i", $kata)){
		$_kata = preg_replace("/(pun|[kl]ah|kannya|[km]u|kan|isasi)\z/i", "", $kata);
		if (cekKamus($_kata)) {
			return $_kata;
		}
	}
	if (preg_match_all("/(an|i|nya|annya|inya)\z/i", $kata)){
		$_kata = preg_replace("/(an|i|nya|annya|inya)\z/i", "", $kata);
		if (cekKamus($_kata)) {
			return $_kata;
		}
	}
}

function hapus_semua_awalan($kata){
	$kata_baru = $kata;

	//hapus di- ke- se-
	if (preg_match_all("/^(di|[ksb]e|meng|mem)/i", $kata)) {
		$_kata = preg_replace("/^(di|[ksb]e|meng|mem)/i","", $kata);
		if(cekKamus($_kata)){
			return $_kata;
		}
		$_kata_ = cek_kata_belakang($_kata);
		if (cekKamus($_kata_)) {
			return $_kata_;
		}		
	}

	//hapus diper-
	if (preg_match_all("/^(diper|dike|me|memper|meng)/i", $kata)) {
		$_kata = preg_replace("/^(diper|dike|me|memper|meng)/i", "", $kata);
		if (cekKamus($_kata)) {
			return $_kata;				
		}
		$_kata_ = cek_kata_belakang($_kata);
		if (cekKamus($_kata_)) {
			return $_kata_;
		}
	}
	//ganti meng jadi k, contoh mengombinasi => kombinasi
	if (preg_match_all("/^(meng)/i", $kata)){			
		$_kata = preg_replace("/^(meng)/i","k", $kata);
		if(cekKamus($_kata)){
			return $_kata;
		}
		$_kata_ = cek_kata_belakang($_kata);
		if (cekKamus($_kata_)) {
			return $_kata_;
		}
	}

	//ganti pen jadi t, contoh penurunan => turunan
	if (preg_match_all("/^(pen)/i", $kata)){			
		$_kata = preg_replace("/^(pen)/i","t", $kata);
		if(cekKamus($_kata)){
			return $_kata;
		}
		$_kata_ = cek_kata_belakang($_kata);
		if (cekKamus($_kata_)) {
			return $_kata_;
		}
	}

	//hapus meng- mem- ber- men- peng- me- per-
	if (preg_match_all("/^(mem|ber|men|peng|me|per|ter|pen|pem)/i", $kata)){			
		$_kata = preg_replace("/^(mem|ber|men|peng|me|per|ter|pen|pem)/i","", $kata);
		if(cekKamus($_kata)){
			return $_kata;
		}
		$_kata_ = cek_kata_belakang($_kata);
		if (cekKamus($_kata_)) {
			return $_kata_;
		}
	}

	//ganti peng jadi k, contoh pengumpul => kumpul
	if (preg_match_all("/^(peng)/i", $kata)){			
		$_kata = preg_replace("/^(peng)/i","k", $kata);
		if(cekKamus($_kata)){
			return $_kata;
		}
		$_kata_ = cek_kata_belakang($_kata);
		if (cekKamus($_kata_)) {
			return $_kata_;
		}
	}


	//hapus menge
	if (preg_match_all("/^(menge)/i", $kata)){			
		$_kata = preg_replace("/^(menge)/i","", $kata);
		if(cekKamus($_kata)){
			return $_kata;
		}
		$_kata_ = cek_kata_belakang($_kata);
		if (cekKamus($_kata_)) {
			return $_kata_;
		}
	}


	//ganti kata men jadi t contoh "menampilkan" => tampil
	if (preg_match_all("/^(men)/i", $kata)){
		$_kata = preg_replace("/^(men)/i","t", $kata);
		if(cekKamus($_kata)){
			return $_kata;
		}
		$_kata_ = cek_kata_belakang($_kata);
		if (cekKamus($_kata_)) {
			return $_kata_;
		}
	}


	//ganti kata pen jadi "t", contoh penerjemah => terjemah
	if (preg_match_all("/^(pen)/i", $kata)){
		$_kata = preg_replace("/^(pen)/i","t", $kata);
		if(cekKamus($_kata)){
			return $_kata;
		}
		$_kata_ = cek_kata_belakang($_kata);
		if (cekKamus($_kata_)) {
			return $_kata_;
		}
	}

	//ganti kata pem jadi "p", contoh pemrograman => program
	if (preg_match_all("/^(pem)/i", $kata)){
		$_kata = preg_replace("/^(pem)/i","p", $kata);
		if(cekKamus($_kata)){
			return $_kata;
		}
		$_kata_ = cek_kata_belakang($_kata);
		if (cekKamus($_kata_)) {
			return $_kata_;
		}
	}

	//ganti kata peny jadi "s", contoh penyimpan => simpan
	if (preg_match_all("/^(peny)/i", $kata)){
		$_kata = preg_replace("/^(peny)/i","s", $kata);
		if(cekKamus($_kata)){
			return $_kata;
		}
		$_kata_ = cek_kata_belakang($_kata);
		if (cekKamus($_kata_)) {
			return $_kata_;
		}
	}
	//ganti kata meny jadi "s", contoh menyelesai => selesai
	if (preg_match_all("/^(meny)/i", $kata)){
		$_kata = preg_replace("/^(meny)/i","s", $kata);
		if(cekKamus($_kata)){
			return $_kata;
		}
		$_kata_ = cek_kata_belakang($_kata);
		if (cekKamus($_kata_)) {
			return $_kata_;
		}
	}

	//ganti kata mem jadi "p", contoh memeriksa => periksa
	if (preg_match_all("/^(mem)/i", $kata)){
		$_kata = preg_replace("/^(mem)/i","p", $kata);
		if(cekKamus($_kata)){
			return $_kata;
		}
		$_kata_ = cek_kata_belakang($_kata);
		if (cekKamus($_kata_)) {
			return $_kata_;
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
if ($value != "") {
	array_push($akhir, array('sebelum' => $value, 'sesudah' =>hasil($value)));
}
	
}



//var_dump($akhir);

?>
