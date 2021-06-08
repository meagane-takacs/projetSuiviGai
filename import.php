<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Suivi GAI</title>
    <link rel="stylesheet" href="suivi_gai_style_lille.css">
</head>

<body>
<?php 

include('fonctions.php');

//Si on a cliquer sur Importer
if (isset($_FILES['file_to_import']))
{   
    //$file_name = $_FILES['file_to_import']['name'];
    $file_tmp =$_FILES['file_to_import']['tmp_name'];

    $lines = file($file_tmp);
    /*for( $i=0; $i<count($lines); $i++)
    {
        $ligne_courante = $lines[$i]; 
        echo $ligne_courante . "<br>" ;
    }*/
    
    
    //echo $file_name ;
    //echo "<br>" ;
    //echo $file_tmp ;

    // TODO :
    // Methode "import_from_file_content" (dans fonctions.php)
    // Param : un tableau de lignes
    // Pour chaque ligne de ce tableau
    // Construit le "insert" qui va bien
    // Execute ce insert pour MAJ la BD - avant toute chose : afficher les requetes SQL sans executer

    import_from_file_content($lines);

    echo "JOBS DONE";
    
    //exit();
}
  
echo "<div class='formulaire_import'>";
echo "<form method = 'POST' action='import.php' enctype='multipart/form-data' >";

echo "<div>";
echo "<input name='file_to_import' type='file' accept='.csv'/>";
echo "</div>";
echo "<input type='submit' value='Importer'></input>";

echo "</form>";


?>
</body>
</html>