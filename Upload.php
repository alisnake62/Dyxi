<?php
    
    session_start();
    if (!isset($_SESSION['user'])) {
    
        header("Location:Index.php");
        
    }

    include 'vendor/autoload.php';

    require_once (__DIR__ . '\include\functions.php');


    if(!empty($_FILES["fichier"]))
    {
        $pdf_file = $_FILES["fichier"]["name"];
        $html_file = explode('.',$pdf_file)[0] . '.html';
        $extension = pathinfo($pdf_file, PATHINFO_EXTENSION);
        
        if ($extension == 'pdf' && $_FILES['fichier']['error'] == 0){
            $tmp_file = $_FILES['fichier']['tmp_name'];
            $pdf_name = basename($pdf_file);
            $destination = "pdf_file/" . $pdf_name;
            move_uploaded_file($tmp_file, $destination);
        }

        if ($extension != 'pdf'){
             echo 'Mauvaise Extensions !';
        }
        
        $_FILES = null;
        
        //Pdf parsing
        if(true){
            // require to install poppler https://stackoverflow.com/questions/18381713/how-to-install-poppler-on-windows
            //change bin location
            \Gufy\PdfToHtml\Config::set('pdftohtml.bin', 'C:/poppler-0.68.0/bin/pdftohtml.exe');
            \Gufy\PdfToHtml\Config::set('pdfinfo.bin', 'C:/poppler-0.68.0/bin/pdfinfo.exe');

            // initiate pdf object
            $pdf = new Gufy\PdfToHtml\Pdf('pdf_file/' . $pdf_file);

            //creation html string
            $html = html_moulinette_on_parsing($pdf);

            //push string in file
            file_put_contents('html_file/' . $html_file, $html);

            //redirection
            //header("location:PDFModifier.php?pdf_file=$pdf_file&upload=no&ratio_police_size=$ratio_police_size&police=$police");
        }

        header("location:PDFModifier.php?pdf_file=$pdf_file");
    }
    require_once (__DIR__ . '\include\header.php');
?>
        <p>
            <h1>Upload ton PDF</h1>
        </p>

        <form method='POST' enctype="multipart/form-data" action=''>
            <div class="form-group">
                <label for="file"></label>
                <input type="file" class="form-control-file" name="fichier" id="fichier">
                <button type="submit" class="btn btn-success">Valider</button>
            </div>
        </form> 
<?php
    require_once (__DIR__ . '\include\footer.php');
?>