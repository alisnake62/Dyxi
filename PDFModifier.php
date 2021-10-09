
<?php

require_once (__DIR__ . '\include\functions.php');

    //Get moulinette
    $ratio_police_size = '1';
    $police = 'Andika';
    if ($_GET){
      $pdf_file = $_GET['pdf_file'];
      if(!empty($_GET['ratio_police_size'])){
          $ratio_police_size = $_GET['ratio_police_size'];
      }
      if(!empty($_GET['police'])){
          $police = $_GET['police'];
      }
    }else{
      $pdf_file = 'Test_PDF.pdf';
    }
    $pdf_name = explode('.',$pdf_file)[0]; //retirer extension du fichier
    $html_file = $pdf_name . '.html';



  //arguments maj in html file
    argument_maj($html_file, $ratio_police_size, $police);

?>



<html>
<title>Dyxi</title>
<head>


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <link rel="stylesheet" href="style.css" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Andika" rel="stylesheet">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id = "maPolice">
  <a class="navbar-brand" href="home.php">Dyxi</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="Upload.php">Upload<span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Articles.php">Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Apropos.php">A propos</a>
      </li>

      <li class="nav-item" id="log">
        <a class="nav-link" href="Index.php">Log in/Log out</a>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Modifications
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <form method='get' enctype="multipart/form-data" action=''>
            <input id="pdf_file" name="pdf_file" type="hidden" value=<?php echo($pdf_file); ?>>
            <div class="form-check" id="interrupteurs">

            <div class="input-group mb-3">
              <label class="input-group-text" for="inputGroupSelect01">Espacement X</label>
              <select class="form-select" name="espacement" id="inputGroupSelect01">
                <option selected>1</option>
                <option value="1.5">1.5</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
            </div>

            <div class="input-group mb-3">
              <label class="input-group-text" for="inputGroupSelect01">Taille X</label>
              <select class="form-select" name="ratio_police_size" id="inputGroupSelect01">
                <option selected hidden><?php echo($ratio_police_size); ?></option>
                <option value="1">1</option>
                <option value="1.5">1.5</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
            </div>

            <div class="radioButton">
              <input class="form-check-input" name="chariot" type="checkbox" id="flexSwitchCheckDefault">
              <label class="form-check-label" for="flexSwitchCheckDefault">Retour chariot </label>
            </div>

            <select class="form-select" aria-label="Default select example" name="police" id="selecteur">
              <option selected hidden><?php echo($police); ?></option>  
              <option value="Andika">Andika</option>
              <option value="Times New Roman">Times New Roman</option>
              <option value="Helvetica">Helvetica</option>
              <option value="Arial">Arial</option>
              <option value="Impact">Impact</option>
            </select>
            <button type="submit" class="btn btn-danger" style="margin-top: 30px;">Appliquer</button>
          </form>

          </ul>
        </li>
    </ul>
  </div>
</nav>


</head>
    <body class='maPolice'>
    
    
    <div class="row">
        <div class="column1">
        <iframe src=<?php echo('pdf_file/' . $pdf_file);?> width="100%" height="100%" ></iframe>
        </div>
        <div class="column2">
            <iframe src=<?php echo('html_file/' . $html_file);?> name=frame_html id=frame_html width="100%" height="100%" ></iframe>
        </div>
    </div>
           
           
</div>

<?php
    require_once (__DIR__ . '\include\footer.php');
?>