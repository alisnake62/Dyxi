<?php

if (strpos($_SERVER['REQUEST_URI'], "%C2%A0") !== false) {

    $mot = explode("/syn.php?mot=", $_SERVER['REQUEST_URI']);
	$mot = explode("%C2%A0", $mot[1]);
	$mot=$mot[0];


}else{
	$mot = $_GET["mot"];
}






$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://dicolink.p.rapidapi.com/mot/" . $mot . "/synonymes?limite=10",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: dicolink.p.rapidapi.com",
		"x-rapidapi-key: 40f2392fb5msh4136489202c0a38p1c0e82jsn80eb7b12b376"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	$reponse_json = json_decode($response);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Synonyme</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <link rel="stylesheet" href="../../../style.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Andika" rel="stylesheet">

</head>
<body class = 'maPolice' style=>
<div class="synonyme">


<?php
//audio
	try {
		$mot_encode = urlencode($mot);
		$file_mp3 = "audio/" . $mot . ".mp3";
		$mp3 = file_get_contents(
		'https://translate.google.com/translate_tts?hl=fr&sl=fr&tl=fr&ie=UTF-8&client=gtx&q=' . $mot_encode);
    	file_put_contents($file_mp3, $mp3);
	} catch (Exception $e) {
		echo "Synthèse vocale impossible";
		file_put_contents($file_mp3, "KC");
	}
	
?>

<p class="titresyn">Ecoutez le mot <?php echo(ucfirst($mot)); ?> : </p>
<audio src=<?php echo($file_mp3); ?> controls ></audio></br></br>
<p class="titresyn">Synonyme du mot <?php echo(ucfirst($mot)); ?> : </p>

<?php
	
	foreach ($reponse_json as $syn){
		echo(ucfirst($syn->mot));
		echo("<br>");
	}
	
?>

<p></br><a href=https://www.dicolink.com/mots/<?php echo($mot); ?>>Plus d'info sur ce mot</a> </p>
</div>
</body>
</html>
