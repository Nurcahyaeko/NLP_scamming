<?php
$input = $_GET['nama_file'];

set_time_limit(300);
error_reporting(0);

require 'class.pdf2text.php';
$pdf2Text = new PDF2Text();
//$pdf2Text->setFilename('sample/word.pdf');
$pdf2Text->setFilename('file/'.$input);
$pdf2Text->decodePDF();

$masukan = ($pdf2Text->output());

function preproses($masukan){
	//menghapus string enter
$lama= "\n";
$baru= "";
$result = str_replace($lama,$baru,$masukan);

//lowercase huru
$result2 = strtolower($result);

//menambahkan spasi sebelum dan sesudah tanda baca
$tandaBacaLama = array('. ', ', ');
$tandaBacaBaru = array(' . ', ' , ');
$text = str_replace($tandaBacaLama, $tandaBacaBaru, $result2);
$tandaBacaLama = array('.', ',');
$tandaBacaBaru = array(' . ', ' , ');
$text = str_replace($tandaBacaLama, $tandaBacaBaru, $result2);
$tandaBacaLama = array(' (', ') ');
$tandaBacaBaru = array(' ( ', ' ) ');
$text = str_replace($tandaBacaLama, $tandaBacaBaru, $result2);
$tandaBacaLama = array(' [', ']');
$tandaBacaBaru = array(' [ ', ' ] ');
$text = str_replace($tandaBacaLama, $tandaBacaBaru, $result2);

//menfilter tipe apa saja yang diperbolehkan
$hapus_simbol = preg_replace("/[^a-zA-Z]/", " ", $text);

return $hapus_simbol;
}

function convertarray($masukan){
//convert ke array
$array_pertama = explode(" " , preproses($masukan));

//penghapusan elemen array kosong
for ($i=0; $i < count($array_pertama); $i++) {
	if ($array_pertama[$i] == ""){
		unset($array_pertama[$i]);
	}
}
//hapus duplikasi kata
$hapus_double = array_unique($array_pertama);

//membenarkan urutan array
$kosong = implode(" ", $hapus_double);
$balik = explode(" " , $kosong);

return $balik;
}

//var_dump(convertarray($masukan));

?>
