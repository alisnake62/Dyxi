
<?php

        $db = 'ProjetEpsi';
        $login="root";
        $mdp="";
        try {
            $linkpdo = new PDO("mysql:host=localhost;dname=$db",$login, $mdp);
        }
        catch (Exception $e) {
            die('Error :' . $e->getMessage());
        }
        require_once (__DIR__ . '\include\header.php');
?>

<img src="LOGOdyxi.png" class="logo">

<h1 class="homelogo">
    DYXI
    </h1>

<?php
    require_once (__DIR__ . '\include\footer.php');
?>