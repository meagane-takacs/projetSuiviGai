<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Suivi GAI</title>
    <link rel="stylesheet" href="suivi_gai_style.css">
</head>

<body>

 <?php
include("fonctions.php");
$base = connectDB();
if (!$base)
{
    $_SESSION['resultat'] = "Erreur de connexion à la base";
    ?>
    <SCRIPT language="Javascript">
        var affich_comment="<?php echo $resultat;?>";
        alert(affich_comment);</SCRIPT>';
    <?php
}

//affichage des titres de colonne
$query = "SHOW COLUMNS FROM images";
$result = mysqli_query($base, $query);
if (!$result)
{
     echo 'impossible d exécuter la requete ' .mysqli_error();
     exit;
}
if (mysqli_num_rows($result) > 0)
{
    ?><table border='2px'><tr class='Titres colonnes'><?php
    while ( $row = mysqli_fetch_assoc($result) )
    {      
            ?>
                <td><?php  echo " ".$row['Field'];?></td>
            
    <?php    
    }
    ?></tr><?php
}



$query = "SELECT * FROM images";
$result = mysqli_query($base, $query);
if(!$result)
{
    echo 'impossible d exécuter la requete ' .mysqli_error();
    exit;
}
/*
?> <tr> <?php
while ($ligne = mysqli_fetch_array($result))
{
    ?>
        <td><?php echo $ligne['id'];?></td>
        <td><?php echo $ligne['Nom_Complet'];?></td>
        
    <?php
}
?> </tr></table>
*/

while ($ligne = mysqli_fetch_array($result))
{
    //echo print_r($ligne, true);
    
    ?> <tr class='Valeurs'> <?php
    for($i=0; $i<count($ligne)/2; $i++)
    {
        ?>
        <td><?php echo $ligne[$i];?></td>
        
    <?php
    }
    ?> </tr> <?php
}



?> 
</body>