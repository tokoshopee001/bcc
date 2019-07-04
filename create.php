<?php
/**
 * DO NOT SELL THIS TOOLS -__- 
 * DO NOT CHANGE COPYRIGHT!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 * MKATO - Relay User Generator
 * version 1.0
 * @package default
 * @author Amos Siregar
 * @copyright MKATO
 **/
###############################################
#$            C0d3d by Amoskun               $#
#$  Recoding Tidak membuatmu menjadi Coder   $#
#$          Copyright 2019 MKATO             $#
###############################################
date_default_timezone_set("Asia/Jakarta");
$green = "\033[1;32m";
$gbreen = "\033[42m";
$blue = "\033[1;34m";
$purple = "\033[1;35m";
$cyan = "\033[1;36m";
$red = "\033[1;31m";
$gred = "\033[41m";
$yellow = "\033[1;33m";
$clear = "\033[0m";
$redbr = "\033[101m";

$data = array();
$data[] = scrn('First Name: ');
$data[] = scrn('Second Name: ');
$data[] = scrn('Username: ');
$data[] = scrn('Password: ');
$data[] = scrn('Domain Relay: ');
$random = scrn('Random(y/n) : ');
if ($random == 'y') {
	$legn = scrn('Length : ');
	$type = scrn('Type of random : ');
}
$total = scrn('Total: ');

$filename = $data[4].'.csv';
@unlink(getcwd() . '/smtp/'.$filename);
$no=1;
echo "\n[x] Getting all required information";
for ($i=0 ; $i<=4 ; $i++) {
    echo '.';    
    usleep(800000);          
}
$head = array('First Name [Required]','Last Name [Required]','Email Address [Required]','Password [Required]','Password Hash Function [UPLOAD ONLY]','Org Unit Path [Required]');
$header = create($head, $filename);



echo "\r\n";
	for ($i=0; $i < $total; $i++) { 
		if ($random == 'y') {
			$useremail = $data[2].randstr($legn,$type).'@'.$data[4];
		}else{
			$useremail = $data[2].$no.'@'.$data[4];
		}
	
	$useremail = strtolower($useremail);
	$sdata = array($data[0],$data[1],$useremail,$data[3],'','/');
	create($sdata, $filename);
	echo "\r";
	echo "\033[1D";
    echo $redbr.$useremail.$clear;  
    // usleep(500000);
	// print_r($sdata);
	$no++;
	}
echo "\n\n";
echo "[MKATO] ".$yellow."Generator Job FInished!".$clear."....\r\n";
// if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
// 	system('cls');
// }else{
// 	system('clear');
// }

function scrn($a) {
    echo "[MKATO] ".$a;
    $scr = rtrim(fgets(STDIN));
    return $scr;
}

function create($data, $filename){
	$nohkontol ='';
	// foreach ($data as $kontol) {
	// 	$nohkontol .= $kontol.',';
	// }
	save($data, $filename);
}

function save($data, $name){
	$file = getcwd() . '/smtp/'.$name;
	$fopen = fopen($file, 'a');
	@fputcsv($fopen, $data);
	@fclose($fopen);
}
function randstr($length,$mode) {
	if ($mode == 'number') {
		$characters = '0123456789';
	}else{
		$characters = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	}
    // $characters = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($l = 0;$l < $length;$l++) {
        $randomString.= $characters[rand(0, $charactersLength - 1) ];
    }
    return $randomString;
}
?>