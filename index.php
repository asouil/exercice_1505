<?php
session_start();;
var_dump($_SESSION);
require_once '/vendor/autoload.php';

function sendmail($dest, $suj, $msg){
	require_once 'config.php';
 
  // Définition du serveur et de son utilisateur pour la création de mails
  $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
    ->setUsername('amaella.souil')
    ->setPassword($mdpgmail)
  ;
	// Création du facteur pour le message
	$mailer = new Swift_Mailer($transport);
	// Création du message
	$message = (new Swift_Message($suj))
		->setFrom([$monmail => 'Admin'])
		->setTo([htmlspecialchars($dest) => 'Vous'])
		->setBody(htmlspecialchars($msg))
	;
}

function verifSession($mail){
	if($mail){
		$mail.=' ';
		for($i=0; $i<strlen($mail); $i++){
			if($mail[$i]=='o'){
				if($mail[$i+1]=='k'){
					$destinataire='contact@apprendre.co';
					$sujet="test de ok";
					$message="test effectué avec succès";
					echo $message;
					//sendmail($destinataire, $sujet, $message);
				return 'false';
				}
			}
		}
	echo("rafraîchir pour votre surprise");
	return "isok";
	}			

}

if(empty($_SESSION)){
	$_SESSION['mail']='test';

	//var_dump($_SESSION);
}
if(!empty($_SESSION)){
	$_SESSION['mail'] = verifSession($_SESSION['mail']);
	//var_dump($_SESSION);
}

function token($taille, $chaine='azertyouiopqsdgfhjklm0123456789'){
	$nblettres=strlen($chaine)-1;
	$code=' ';
	for($i=0; $i<$taille; $i++){
		$pos = mt_rand(0, $nblettres);
		$car = $chaine[$pos];
		$code.= $car;
	}
	return $code;
}

?>
