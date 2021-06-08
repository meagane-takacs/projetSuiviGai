<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Suivi GAI</title>
    <link rel="stylesheet" href="suivi_gai_style_lille.css">
</head>

<body>

<?php // fonction filtre //?>
    <SCRIPT language="Javascript">
        function filter(typeFiltre) {
            var inputFilter = document.getElementById("search"+typeFiltre);
            var txtFilter = inputFilter.value.toUpperCase();
            
            var elements = document.getElementsByClassName("class"+typeFiltre);
            //console.log("nb element : "+elements.length);
            for(var i=0; i<elements.length; i++)
            {
                var txtValue = elements[i].textContent ;
                if(txtValue.toUpperCase().indexOf(txtFilter) > -1)
                {
                    console.log("trouvé");
                    elements[i].parentElement.style.display="";
                }
                else
                {
                    elements[i].parentElement.style.display="none";
                }
            }
        }
    </SCRIPT>


 <?php
include("fonctions.php");

$myRegion="Lille";

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

//affichage des titres de colonne et des champs de recherche
$query = "SHOW COLUMNS FROM images";
$resultTitres = mysqli_query($base, $query);
$arrayTitres = [] ;
if (!$resultTitres)
{
     echo 'impossible d exécuter la requete ' .mysqli_error();
     exit;
}
if (mysqli_num_rows($resultTitres) > 0)
{
    // Début du tableau et ligne de titres
    echo "<table class='tableau'><tr id=keys>";
    echo "<td></td>";
    echo "<td></td>";
    while ( $row = mysqli_fetch_assoc($resultTitres) )
    {   
        $field=$row['Field'];
        echo "<td> $field</td>";

        // On met de côté
        array_push($arrayTitres, $field);
    }
    echo "</tr>" ;

    // Ligne de champs de recherche
    echo "<tr id=searchFields>";
    echo "<td></td>";
    echo "<td>Recherche</td>";
    for( $i=0; $i<count($arrayTitres); $i++ )
    {
        $searchFieldID = $arrayTitres[$i];
        echo "<td><input id=search$searchFieldID onkeyup='filter(\"$searchFieldID\")'/></td>";
    }
    echo "</tr>" ;
}



$query = "SELECT * FROM images WHERE Region='$myRegion'";
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
    
    echo "<tr border = '2px' class='Valeurs'>";
    $id = $ligne['id'];
    echo "<td><button><a href='modifier.php?id=$id&region=$myRegion'>Modifier</a></button></td>";
    echo "<td><button class='favorite styled' type='button'><a href='delete.php?id=$id&region=$myRegion'>Supprimer</a></button> </td>";
    for($i=0; $i<count($ligne)/2; $i++)
    {    
        $typeCase = $arrayTitres[$i];
        // Cas particulier du 400kv boolean
        if( strcmp($arrayTitres[$i], "400kv")==0 )
        {
            if( $ligne[$i]  )
                echo "<td class=class$typeCase> VRAI </td>";
            else
            echo "<td class=class$typeCase> FAUX </td>";
        }
        // Tous les autres : on affiche tel que
        else
        {
            echo "<td class=class$typeCase> $ligne[$i] </td>";
        }
    }
    echo "</tr>";
}

echo "<button><a href='create.php?region=$myRegion'>Ajouter une nouvelle image</a></button>";
echo "<button><a href='import.php'>importer</a></button>";
echo "<button><a href='export.php'>exporter</a></button>";
?> 
</body>