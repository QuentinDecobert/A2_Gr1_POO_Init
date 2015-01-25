<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 17/01/2015
 * Time: 17:44
 */

session_start();

if(empty($_SESSION))
{
    header('location: index.php');
}

echo "You must wait 6 hours between each of your attack";
echo "<br><a href='index.php'>Return to index</a> ";