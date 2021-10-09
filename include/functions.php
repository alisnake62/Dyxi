<?php
    function string_script_gen($ratio_police_size = "", $police = ""){
        return "<script type='application/javascript' ratio_police_size=$ratio_police_size , police=$police src='../assets/js/script.js' defer></script>";
      }
      
      function html_moulinette_on_parsing($pdf, $ratio_police_size = "", $police = "")
      {
        $html = "<html>
        <title>Dyxi</title>
        <link rel='preconnect' href='https://fonts.googleapis.com'>
        <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
        <link href='https://fonts.googleapis.com/css2?family=Andika' rel='stylesheet'>
        ";
        for($i = 1; $i < $pdf->getPages() + 1; $i++){
            $html = $html . $pdf->html($i);
        }
        $script_string = string_script_gen($ratio_police_size, $police);
        $html = $html . $script_string ."</html>";
        return $html;
      }
      
      function argument_maj($html_file, $ratio_police_size = "", $police = ""){
        $html = file_get_contents('html_file/' . $html_file);
        $html = explode('<script',$html)[0];
        $script_string = string_script_gen($ratio_police_size, $police);
        $html = $html . $script_string . "</html>";
        file_put_contents('html_file/' . $html_file, $html);
      }
?>