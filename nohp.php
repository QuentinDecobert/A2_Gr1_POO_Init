<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 17/01/2015
 * Time: 17:56
 */

session_start();

if(empty($_SESSION))
{
    header('location: index.php');
}

echo "You can't attack a pokemon who has 0 hp";
echo "<br><a href='index.php'>Return to index</a> ";