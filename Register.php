<?php

    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = htmlentities($_POST['username']);
        $password = htmlentities(password_hash($_POST['password'], PASSWORD_ARGON2I)); 
        echo($password);
        
        $db = 'ProjetEpsi';
        $login="root";
        $mdp="";
        try {
            $linkpdo = new PDO("mysql:host=localhost;dname=$db",$login, $mdp);
        }
        catch (Exception $e) {
            die('Error :' . $e->getMessage());
        }
        $req = $linkpdo->prepare("SELECT * FROM PojetEpsi.users WHERE username LIKE ?");
        $req->execute(array($username)); 
        $res=$req->fetch();
        if($res == false) {
                
                $req2 = $linkpdo->prepare("INSERT INTO ProjetEpsi.users(username, password) VALUES(:username, :password)");
                $req2->execute(array('username' => $username, 'password' => $password));
                
                if ($req2 != FALSE) {
                  print("Registered");
                  // header('location:Index.php'); 
                } else {
                    print("Erreur execute");
                } 
            }
        } else {
            echo "user deja existant";
        }
    
    require_once (__DIR__ . '\include\header.php');

?>
        <div class="connection">
        <h2>Sign In</h2>
        <form action="<?php $_SERVER['PHP_SELF']?>" method='post'>
            <div class="col-auto">
                <label for="username" class="form-label">Identifiant</label>
                <input type='text' required name='username' id="username"><br />
            </div>
            <div class="col-auto">
                <label for="password" class="form-label">Mot de passe</label>
                <input type='password' required name='password' id="password"><br />
            </div>
            <button type="submit" class="btn btn-primary" style="margin-top: 30px;">Valider</button>
        </form>
    </div>

<?php
    require_once (__DIR__ . '\include\footer.php');
?>