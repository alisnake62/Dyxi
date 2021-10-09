
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

     <div class="blog">

        <div class="visuBlog">
        <img src="LOGOdyxi.png" class="Imgarticle">
        <div class="textarticle">
        <h2 class="titreArticle">
        Qu’est-ce que la dyslexie?
    </h2>
    <p>
    La dyslexie est un trouble d’apprentissage d’origine neurologique. Il s’agit donc d’un problème de fonctionnement dans le cerveau, et non d’un problème d’intelligence ni de stimulation. Le cerveau des personnes présentant une dyslexie a de la difficulté à percevoir et à analyser de façon précise et rapide les sons dans les mots, alors que les autres zones... <a href="blog.php">lire la suite</a>
    </p>
    </div>
        </div>

    
        <div class="visuBlog">
        <img src="LOGOdyxi.png" class="Imgarticle"> 
        <h1 class="titreArticle">
    </h1>
    
        </div>

</div>



<?php
    require_once (__DIR__ . '\include\footer.php');
?>