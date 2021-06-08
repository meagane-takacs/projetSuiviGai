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

if (isset($_POST['delete']))
{
    echo "<h1>Zob</h1>";
    deleteImage($_GET['id']);

    $redirectRegion = $_GET['region'] ;
    header("Location: $redirectRegion.php");

    exit;
}

echo "<div>";
echo "<h1>Etes-vous sur ?</h1>";
$idDelete = $_GET['id'];
$region = $_GET['region'];
echo "<form method='post' action =''>";
echo "<input type=submit name='delete' value='Supprimer' formaction='delete.php?id=$idDelete&region=$region'/>";
echo "<a href='Lille.php' target='_blanck'> <input type='button' value='Cancel'> </a>";
echo "</form>";
echo "</div>";