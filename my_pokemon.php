<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 11/01/2015
 * Time: 22:25
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

if (empty($_SESSION) ) {
//echo 'Forbidden !';
    header('Location: index.php');
    die;
}

$trainer = new TrainerModel();

/** @var  \Doctrine\ORM\EntityRepository */
$trainRepository = $em->getRepository('QuentinDecobert\PokemonBattle\Model\TrainerModel');

/** @var \QuentinDecobert\PokemonBattle\Model\TrainerModel $trainer */
$trainer = $trainRepository->find($_SESSION["id"]);

$id = $trainer->getPokemonId();

$have_pokemon = $trainer->getHavePokemon();


if($have_pokemon == 0)
{
    header('location: index.php');
}


$poke = new PokemonModel();


/** @var  $pokeRepository */
$pokeRepository = $em->getRepository('QuentinDecobert\PokemonBattle\Model\PokemonModel');

/** @var \QuentinDecobert\PokemonBattle\Model\PokemonModel $poke */
$poke = $pokeRepository->find($id);



$hp = $poke->getHP();
$pokename = $poke->getName();
$type = $poke->getType();



if($type == PokemonModel::TYPE_PLANT)
{
    $types = "Plant";
}
elseif($type == PokemonModel::TYPE_FIRE)
{
    $types = "Fire";
}
elseif($type == PokemonModel::TYPE_WATER)
{
    $types = "Water";
}






$twig = new Twig_Environment($loader,[
//'cache' => null,
]);


echo $twig->render('my_pokemon.html.twig', [
    "hp" => $hp,
    "session" => $_SESSION,
    "pokename" => $pokename,
    "type" => $type,
    "types" => $types,
]);