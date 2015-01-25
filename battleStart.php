<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 12/01/2015
 * Time: 19:45
 */

require __DIR__.'/vendor/autoload.php';


use QuentinDecobert\PokemonBattle\Model\TrainerModel;
use QuentinDecobert\PokemonBattle\Model\PokemonModel;
use Cocur\Slugify\Slugify;


require __DIR__.'/_header.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem([
    __DIR__.'/view',
]);

/** @var $em \Doctrine\ORM\EntityManager */
$em = require __DIR__.'/bootstrap.php';

session_start();

$currentDate = strtotime("now");
/** @var  \Doctrine\ORM\EntityRepository */
$timeRepository = $em->getRepository('QuentinDecobert\PokemonBattle\Model\TrainerModel');
$lastDate = $timeRepository->find($_SESSION['id']);

$date = $lastDate->getLastHeal();
echo $currentDate."<br>";
echo $currentDate-$date;
if($currentDate-$date < 3600)
    header("location: index.php");
else {
    $lastDate->setLastHeal($currentDate);
    var_dump($lastDate);
    $em->flush();
}
$twig = new Twig_Environment($loader,[
//'cache' => null,
]);


echo $twig->render('battleStart.html.twig', [

]);