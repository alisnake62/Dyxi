
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
       
        if(!empty($_POST['c_name']) && !empty($_POST['c_mail']) && !empty($_POST['c_content'])){
          $c_name= htmlentities($_POST['c_name']);
 
          $c_mail= htmlentities($_POST['c_mail']);
          $c_content= htmlentities($_POST['c_content']);
          $dateCom= date('Y-m-d h:i:s', time());
          $req2 = $linkpdo->prepare("INSERT INTO ProjetEpsi.commentaire(utilisateur, adresse, commentaire, dateCom) VALUES(:utilisateur, :adresse, :commentaire, :dateCom)");
          $req2->execute(array('utilisateur' => $c_name, 'adresse' => $c_mail, 'commentaire' => $c_content, 'dateCom' => $dateCom));  
          if($req2 = false) {
            echo("requete echoue");
          }
        }
        
        $req = $linkpdo->prepare("SELECT * FROM ProjetEpsi.commentaire ORDER BY dateCom DESC");
        $req->execute();
        $res=$req->fetch();

        require_once (__DIR__ . '\include\header.php');

?>

        <div class="displayPub2">
          
          </div>

    <div class="displayPub">
          
          </div>

        <div class="blog">

        <div class="blogT1">
        Qu’est-ce que la dyslexie?
        </div>


<p class="p_blog">
La dyslexie est un trouble d’apprentissage d’origine neurologique. Il s’agit donc d’un problème de fonctionnement dans le cerveau, et non d’un problème d’intelligence ni de stimulation. Le cerveau des personnes présentant une dyslexie a de la difficulté à percevoir et à analyser de façon précise et rapide les sons dans les mots, alors que les autres zones du cerveau fonctionnent normalement. 
</p>

<p class="p_blog">
Un enfant qui souffre de dyslexie a ainsi de la difficulté à reconnaître les mots écrits. En lisant, il oublie parfois des lettres, les inverse ou les remplace par d’autres sans faire exprès, ce qui nuit à la vitesse et à la précision de sa lecture. 
      </p>

<p class="p_blog">
Certains enfants dyslexiques ne font toutefois pas d’erreurs en lisant, mais leur vitesse de lecture est très lente. Dans tous les cas, l’enfant qui souffre de dyslexie peut avoir de la difficulté à comprendre ce qu’il lit, peu importe qu’il lise lentement ou vite, qu’il fasse beaucoup d’erreurs ou non.
      </p>

<p class="p_blog">
Par contre, les enfants qui ont des difficultés en lecture ne présentent pas tous une dyslexie. Certains, par exemple, ont un trouble du langage oral (ex. : trouble développemental du langage autrefois appelé « dysphasie ») qui a des répercussions sur leur apprentissage du langage écrit. Par ailleurs, les enfants présentant une dyslexie n’ont pas nécessairement de difficulté à comprendre et à parler avant 5 ans, mais si c’est le cas, ces troubles sont souvent légers.
      </p>

      <div class="blogT2">
      Les causes de la dyslexie
      </div>

      <p class="p_blog">
      Plusieurs études suggèrent que la dyslexie est héréditaire. La probabilité qu’un enfant soit dyslexique monte d’ailleurs à 50 % si l’un de ses parents l’est ou si quelqu’un de la famille présente un trouble de langage.
La dyslexie est nommée « trouble spécifique d’apprentissage » par les organismes spécialisés et plusieurs professionnels parce qu’elle ne s’explique pas par d’autres problèmes plus larges, comme une déficience intellectuelle ou visuelle.Elle ne s’explique pas non plus par un manque d’effort de l’enfant ou par un manque de stimulation de la part des parents.

      </p>

      <p class="p_blog">
      La dyslexie est nommée « trouble spécifique d’apprentissage » par les organismes spécialisés et plusieurs professionnels parce qu’elle ne s’explique pas par d’autres problèmes plus larges, comme une déficience intellectuelle ou visuelle.Elle ne s’explique pas non plus par un manque d’effort de l’enfant ou par un manque de stimulation de la part des parents.

      </p>
      </div>

      <div class="blog">

                    <table class='table'>
                    <thead>
                         <tr>
                              <th scope="col">Commentaire</th>
                              <th scope="col">Nom</th>
                              <th scope="col">Date</th>
                         </tr>
                    </thead>
                        <?php do {
                         $dateCom = $res['dateCom']; ?>
                         <tbody>
                              <tr>
                                   <td><?php echo $res['commentaire'] ?></td>
                                   <td><?php echo $res['utilisateur'] ?></td>
                                   <td><?php echo $res['dateCom'] ?></td>
                              </tr>
                         </tbody>
                    <?php
                    } while ($res = $req->fetch());
                    ?>
               </table>
                  </div>

</div>

<div class="blog">


<form action="<?php $_SERVER['PHP_SELF']?>" method="post" id="comment-form">
       
      <h3>Add a comment</h3>
      <fieldset>
       
         
        <p class="field"> 
        <input required name="c_name" id="c_name" type="text" size="30" maxlength="255"
        value="" />
      <label for="c_name" class="name">Name or nickname</label>
        </p>
         
        <p class="field"> 
        <input required name="c_mail" id="c_mail" type="text" size="30" maxlength="255"
        value="" />
      <label for="c_mail" class="mail">Email address</label>
        </p>
         
        <p style="display:none"><input name="f_mail" type="text" size="30"
        maxlength="255" value="" /></p>
         
        <p class="field">
        <textarea required name="c_content" id="c_content" cols="35"
        rows="7"></textarea>
        </p>
      
        
      </fieldset>
       
      <fieldset>
        <p class="buttons">
        <tpl:IfCommentPreview><input type="submit" class="btn btn-dark" value="send" /></tpl:IfCommentPreview></p>
      </fieldset>
    </form>

</div>


<?php
    require_once (__DIR__ . '\include\footer.php');
?>