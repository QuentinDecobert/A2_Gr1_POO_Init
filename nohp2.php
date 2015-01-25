<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 17/01/2015
 * Time: 17:59
 */

session_start();

if(empty($_SESSION))
{
    header('location: index.php');
}

echo "Your pokemon has no hp. Heal it to attack an other trainer";
echo "<br><a href='index.php'>Return to index</a> ";