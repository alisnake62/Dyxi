<?php

if(true){

    $text = "ilusion";
    $file = "audio/" . $text . "_" . $lang . ".mp3";
    $mp3 = file_get_contents(
    'https://translate.google.com/translate_tts?hl=fr$ie=UTF-8&client=gtx&q=' . $text . '&tl=fr');
    file_put_contents($file, $mp3);

}else{
    $file = "toto_fr.mp3";
}

echo($file);
?>

<audio src=<?php echo($file); ?> controls ></audio>