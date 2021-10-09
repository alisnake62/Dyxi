<?php

    session_start();
    if (!empty($_SESSION['user'])) {
        session_destroy();
    }

    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = htmlentities($_POST['username']);
        $password = htmlentities($_POST['password']); 
        
        $db = 'ProjetEpsi';
        $login="root";
        $mdp="";
        try {
            $linkpdo = new PDO("mysql:host=localhost;dname=$db",$login, $mdp);
        }
        catch (Exception $e) {
            die('Error :' . $e->getMessage());
        }
        $req = $linkpdo->prepare("SELECT * FROM ProjetEpsi.users WHERE username LIKE :username AND password LIKE :password");
        $req->execute(array('username' => $username, 'password' => $password));
        $res=$req->fetch();
        if ($req == true) {
            do {
                if ($res == false) {
                    echo "Identifiant ou mot de passe inconnue";
                    session_destroy();
                } else {
                    $_SESSION['user'] = $username;
                    header('location:Upload.php');
                }
            } while($res=$req->fetch());
        } else {
            echo "Erreur de connexion";
        }
    }

    require_once (__DIR__ . '\include\header.php');
?>

        <div class="connection">
        <h1>Connexion</h1>
        <form action="<?php $_SERVER['PHP_SELF']?>" method='post'>
            <div class="col-auto">
                <label for="username" class="form-label">Identifiant</label>
                <input type='text' required name='username' id="username"><br />
            </div>
            <div class="col-auto">
                <label for="password" class="form-label">Mot de passe</label>
                <input type='password' required name='password' id="password"><br />
            </div>
            <button type="submit" class="btn btn-dark" style="margin-top: 30px;">Connexion</button>


        </form>

        <form action= "Register.php">
        <div>
            <button type="submit" class="btn btn-danger" style="margin-top: 30px;">Sign In</button>
        </div>
</form>
</div>

<?php
    require_once (__DIR__ . '\include\footer.php');
?>