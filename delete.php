<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 14/01/2015
 * Time: 23:28
 */

session_start();

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



if($have_pokemon = 0)
{
    header('location: index.php');
}

$em = require __DIR__.'/bootstrap.php';
$poke = new PokemonModel();

/** @var  \Doctrine\ORM\EntityRepository */
$pokeRepository = $em->getRepository('QuentinDecobert\PokemonBattle\Model\PokemonModel');

/** @var \QuentinDecobert\PokemonBattle\Model\PokemonModel $poke */
$poke = $pokeRepository->find($id);

if (null !== $poke)
    $em->remove($poke);

else
    echo "nothing";

$em->flush();


$trainer = new TrainerModel();
$trainRepository = $em->getRepository('QuentinDecobert\PokemonBattle\Model\TrainerModel');
$trainer = $trainRepository->find($_SESSION["id"]);



$trainer
    ->setPokemonId(0)
    ->setHavePokemon(0)
    ->setPokemonName("")
    ;


$em->flush();

header("location: index.php");


