<?php 
define('BOT_TOKEN', '487644243:AAG0QIpwHTSBM8IFtj2-XFOuEXlu0A_ID-Q');
define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');
	
// read incoming info and grab the chatID
$content = file_get_contents("php://input");
$update = json_decode($content, true);
$chatID = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];
$userId = $update["message"]["from"]["id"];
$image = "mupin.jpg";
		

		

if ($userId == 233490624) {
	$image = "amiga.png";
	$reply = "Ciao Fulvio ";
	// send reply	
	//$sendto =API_URL."sendmessage?chat_id=".$chatID."&text=".$reply;
	//file_get_contents($sendto);
	//$sendto =API_URL."sendmessage?chat_id=".$chatID."&text=".$message;
	//file_get_contents($sendto);
	//$sendto =API_URL."sendmessage?chat_id=".$chatID."&text=".$userId;
	//file_get_contents($sendto);
	// send photo
	//sendPhoto($image,$chatID);

	sayWords($reply);
	sayWords($message);

	$sendto =API_URL."sendmessage?chat_id=".$chatID."&text=".$message;
	file_get_contents($sendto);

}else{
	// compose reply
	//$reply =  sendMessage();
	// send reply
	//$sendto =API_URL."sendmessage?chat_id=".$chatID."&text=".$reply;
	//file_get_contents($sendto);
	// send photo
	//sendPhoto($image,$chatID);
	$sendto =API_URL."sendmessage?chat_id=".$chatID."&text=".$userId;
	file_get_contents($sendto);

	sayWords($message);

	$sendto =API_URL."sendmessage?chat_id=".$chatID."&text=".$message;
	file_get_contents($sendto);
}

	function sayWords($words){
		
	$url = 'http://syncroweb.homepc.it:8080';
	$myvars = 'speech=' . $words ;

	$ch = curl_init( $url );
	curl_setopt( $ch, CURLOPT_POST, 1);	
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt( $ch, CURLOPT_HEADER, 0);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

	$response = curl_exec( $ch );
		
		
	}


	function sendPhoto($image,$chatID){

		$url        = API_URL."sendPhoto?chat_id=" . $chatID ;
		$post_fields = array('chat_id'   => $chat_id,
		    'photo'     => new CURLFile(realpath($image))
		);

		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    "Content-Type:multipart/form-data"
		));
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields); 

		$output = curl_exec($ch);

	}

	function sendMessage(){
		$date = getdate();
		$ore = $date[hours];
		$minuti = $date[minutes];
		if (strlen($minuti)==1) $minuti .= '0'.$date[minutes];
		$message = "Benvenuto al Mupin sono le ".$ore.":".$minuti;
		
		return $message;
	}




