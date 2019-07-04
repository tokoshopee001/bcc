<?php
###############################################
#$            C0d3d by Amoskun               $#
#$  Recoding Tidak membuatmu menjadi Coder   $#
#$          Copyright 2019 MKATO             $#
###############################################
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'function.php';
echo "       
       ".color('red','.',$mkato_setting['color'])."
     ".color('red',"'':''",$mkato_setting['color'])."
    ___:____     |''\/''|   ".color('greenbg',"MKATO BCC SENDER",$mkato_setting['color'])."
  ,'        `.    \    /    ".color('purple',"Version 1.1",$mkato_setting['color'])."
  |  O        \___/   |     
".color('red',"~^~^~^~^~^~^~^~^~^~^~^~^~",$mkato_setting['color'])."
";
###############################################
#$            C0d3d by Amoskun               $#
#$  Recoding Tidak membuatmu menjadi Coder   $#
#$          Copyright 2019 MKATO             $#
###############################################
$quetionforstartfirst = scrn('Already Create a users ?: ', $mkato_setting['color']);
if ($quetionforstartfirst != 'yes') {
	passthru('php create.php');
	echo "\r\n";echo "\r\n";
	echo "Please Upload the .csv file to your admin and then hit yes\r\n";
}

$list = file_get_contents('list/'.$mkato_list['file']) or die("Mailist not found!");
$list = preg_split('/\n|\r\n?/', $list);
if ($mkato_list['removeduplicate'] == true) {
	$list = array_unique($list);
}
$list = str_replace(" ", '', $list);
$list = preg_grep("/[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/i",
        $list);
$list_total = count($list);
$smtpread = file_get_contents('smtp/'.$mkato_smtp) or die("SMTP File not found!");
$smtpread = preg_split('/\n|\r\n?/', $smtpread);
array_shift($smtpread);
$smtpread=array_values(array_filter($smtpread));

echo "\n".color('redbg','Getting all required information',$mkato_setting['color']);
for ($i=0 ; $i<=4 ; $i++) {
    echo '.';    
    usleep(600000);          
}
echo "\r\n";
###############################################
#$            C0d3d by Amoskun               $#
#$  Recoding Tidak membuatmu menjadi Coder   $#
#$          Copyright 2019 MKATO             $#
###############################################
echo color('yellow','You Have '.$list_total.' List to be sent',$mkato_setting['color'])."\r\n";
echo "\r\n";echo "\r\n";
$quetionforstart = scrn('Continue to send ?: ', $mkato_setting['color']);
if ($quetionforstart != 'yes') {
	exit(color('red','Sender is Stop Working',$mkato_setting['color'])."\r\n");
}
echo "\r\n";echo "\r\n";
$no = 1;
$i=0;
$no_send = 1;
$no_list = 1; 
$email_split = array_chunk($list, $mkato_setting['max']);
foreach ($email_split as $key => $e_list) {
	$takeawaysmtp = $smtpread[$i%count($smtpread)];
	$taleawayinbox = $mkato_inbox[$i%count($mkato_inbox)];
	$takesmtp = explode(',', $takeawaysmtp);
	echo "[".color('yellow','MKATO',$mkato_setting['color'])."] [".$no_send."/".count($email_split)."] ".color('green','Proccess Sending to : ',$mkato_setting['color'])."\r\n";
	foreach ($e_list as $key2 => $added) {
		echo "[".++$key2."] Add ".color('purple',$added,$mkato_setting['color'])."\r\n";
	}
	echo "[".$no_send."/".count($email_split)."] ".color('green','Total of emails to be sent : ',$mkato_setting['color']).color('yellow',count($e_list),$mkato_setting['color'])."\r\n";
	echo "[".$no_send."/".count($email_split)."] ".color('green','Sending with SMTP : '. $takesmtp[2],$mkato_setting['color'])."\r\n";
	$tSend = sendbcc($e_list,$takeawaysmtp,$mkato_setting,$taleawayinbox,$mkato_header);
	if ($tSend['status'] == 'ok') {
		$tStatus = color('greenbg','Success',$mkato_setting['color']);
	}else{
		$tStatus = color('red','Failed! Reason : ',$mkato_setting['color']).$tSend['info'];
	}
	echo "Sending status : ".$tStatus;
	echo "\r\n\n";
	$i++;
	$no_send++;
	sleep($mkato_setting['delay']);
}
###############################################
#$            C0d3d by Amoskun               $#
#$  Recoding Tidak membuatmu menjadi Coder   $#
#$          Copyright 2019 MKATO             $#
###############################################
function sendbcc($mkato_list,$mkato_smtp, $mkato_setting, $mkato_inbox, $mkato_header){
		$mail = new PHPMailer(true);                              
		try {
			$getsmtp = explode(',', $mkato_smtp);
		    $mail->SMTPDebug = 0;                                 
		    $mail->isSMTP();                                      
		    $mail->Host = 'smtp.gmail.com'; 
		    $mail->SMTPAuth = true;                            
		    $mail->Username = $getsmtp[2];             
		    $mail->Password = $getsmtp[3];                        
		    $mail->SMTPSecure = 'tls';                           
		    $mail->Port = 587;
		    $mail->Priority = $mkato_setting['priority'];
		    $mail->Encoding = $mkato_setting['encoding'];
		    $mail->CharSet = $mkato_setting['charset'];
		    $mail->setFrom($getsmtp[2], $mkato_inbox['fname']);
		    if ($mkato_inbox['to'] != NULL) {
		    	$to = explode("|", $mkato_inbox['to']);
		    	foreach ($to as $key => $toto) {
		    		$todo = random($toto);
		    		$mail->addAddress($todo);
		    	}
		    	 
		    }
		                 
		    foreach ($mkato_list as $key) {
		    	$mail->addBCC($key);
		    }
		    if ($mkato_setting['insertemailtest'] == true) {
		    	$gettestlist = explode('|', $mkato_setting['emailtest']);
		    	foreach ($gettestlist as $key2) {
		    	$mail->addBCC($key2);
		    	}
		    }
		    if ($mkato_setting['header'] == true){
                    foreach ($mkato_header as $mheader) {
                        $mkatoheader = explode("|", $mheader);
                        $mkatoheader[0] = random($mkatoheader[0]);
                        $mkatoheader[1] = random($mkatoheader[1]);
                        $mail->addCustomHeader($mkatoheader[0], $mkatoheader[1]);
                    }
            }
		    if ($mkato_inbox['attachfile'] != NULL) {
		    	$mail->addAttachment('attachment/'.$mkato_inbox['attachfile'], random($mkato_inbox['attachname']));
		    }	

		    	##daerah letter
		    	$link = explode('|', $mkato_setting['link']);
		    	$letter = file_get_contents('letter/'.$mkato_inbox['letter']) or die("Letter not found!");
		    	if ($mkato_setting['randomparam'] == true) {
		    		$letter = str_ireplace("##link##", $link[array_rand($link)].'?idtrack='.generatestring('mix', 8, 'normal'), $letter);
		    	}else{
		    		$letter = str_ireplace("##link##", $link[array_rand($link)], $letter);
		    	}
		    	
		    	$letter = str_ireplace("##randua##", getrandom('useragent') , $letter);
                $letter = str_ireplace("##randip##", getrandom('ip') , $letter);
                $letter = str_ireplace("##randcountry##", getrandom('country') , $letter);
                $letter = str_ireplace("##randos##", getrandom('os') , $letter);
                $letter = str_ireplace("##device##", getrandom('device') , $letter);
                $letter = str_ireplace("##date##", date('D, F d, Y  g:i A') , $letter);
                $letter = str_ireplace("##date2##", date('D, F d, Y') , $letter);
                $letter = str_ireplace("##date3##", date('F d, Y  g:i A') , $letter);
                $letter = str_ireplace("##date4##", date('F d, Y') , $letter);
                $letter = random($letter);

                ##daerah subject
                $mkato_inbox['subject'] = str_ireplace("##date##", date('D, F d, Y  g:i A') , $mkato_inbox['subject']);
                $mkato_inbox['subject'] = str_ireplace("##date2##", date('D, F d, Y') , $mkato_inbox['subject']);
                $mkato_inbox['subject'] = str_ireplace("##date3##", date('F d, Y  g:i A') , $mkato_inbox['subject']);
                $mkato_inbox['subject'] = str_ireplace("##date4##", date('F d, Y') , $mkato_inbox['subject']);
                $mkato_inbox['subject'] = random($mkato_inbox['subject']);

		    $mail->isHTML(true);    
		    $mail->AllowEmpty = true;
		    $mail->Subject = $mkato_inbox['subject'];
		    $mail->Body    = $letter;
		    $mail->send();
		    return array('status' => 'ok', 'info' => '');
		} catch (Exception $e) {
			file_put_contents('log/'.date('D F d Y').".txt", implode("\r\n", $mkato_list), FILE_APPEND);
			return array('status' => 'bad', 'info' => $mail->ErrorInfo);
		}
}
?>