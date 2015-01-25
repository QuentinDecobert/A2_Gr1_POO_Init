<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 05/01/2015
 * Time: 15:25
 */


require __DIR__.'/vendor/autoload.php';

use Cartman\Init\Article;
use Cocur\Slugify\Slugify;

require __DIR__.'/_header.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem([
    __DIR__.'/view',
]);


/** @var $em \Doctrine\ORM\EntityManager */
$em = require __DIR__.'/bootstrap.php';

session_start();


$twig = new Twig_Environment($loader,[
//'cache' => null,
]);


if(isset($_SESSION["username"]))
{
    /** @var  \Doctrine\ORM\EntityRepository */
    $trainerRepository = $em->getRepository('QuentinDecobert\PokemonBattle\Model\TrainerModel');


    /** @var \QuentinDecobert\PokemonBattle\Model\TrainerModel $trainer */
    $trainer = $trainerRepository->find($_SESSION['id']);

    $have_pokemon = $trainer->getHavePokemon();


    echo $twig->render('index.html.twig', [
        "session" => $_SESSION,
        "username" => $_SESSION["username"],
        "have_pokemon" => $have_pokemon
    ]);

} else
{
    echo $twig->render('index.html.twig', [
        "session" => $_SESSION,

    ]);

}