<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 11/01/2015
 * Time: 18:35
 */


session_start();
if(empty($_SESSION))
    header("location: index.php");
else
{
    session_destroy();
    header("location: index.php");
}