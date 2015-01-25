<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 11/01/2015
 * Time: 20:22
 */

use QuentinDecobert\PokemonBattle\Model\PokemonModel;
use Cocur\Slugify\Slugify;
use QuentinDecobert\PokemonBattle\Model\TrainerModel;



require __DIR__.'/vendor/autoload.php';
require __DIR__.'/_header.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem([
    __DIR__.'/view',
]);
/** @var $em \Doctrine\ORM\EntityManager */
$em = require __DIR__.'/bootstrap.php';
$pokemon = new PokemonModel();
$slugify = new Slugify();
session_start();
/** @var  \Doctrine\ORM\EntityRepository */
$trainerRepository = $em->getRepository('QuentinDecobert\PokemonBattle\Model\TrainerModel');
/** @var \QuentinDecobert\PokemonBattle\Model\TrainerModel $trainer */
$trainer = $trainerRepository->find($_SESSION['id']);
$have_pokemon = $trainer->getHavePokemon();
$poke = new PokemonModel();
$type = $poke->getType(PokemonModel::TYPE_FIRE);
if(empty($_SESSION) || $have_pokemon === 1){
    header("location: index.php");
}
if(isset($_POST['name']) && isset($_POST['type'])) {
    $em = require __DIR__.'/bootstrap.php';
    $pokemon
        ->setName($_POST['name'])
        ->setType($_POST['type'])
        ->setUserId($_SESSION['id'])
    ;
    $em->persist($pokemon);
    $em->flush();
    $id = $pokemon->getId();
    $em = require __DIR__.'/bootstrap.php';
    /** @var  \Doctrine\ORM\EntityRepository */
    $trainerRepository = $em->getRepository('QuentinDecobert\PokemonBattle\Model\TrainerModel');
    /** @var \QuentinDecobert\PokemonBattle\Model\TrainerModel $trainer */
    $trainer = $trainerRepository->find($_SESSION['id']);
    $trainer->setHavePokemon(1);
    $trainer->setPokemonName($_POST['name']);
    $trainer->setPokemonId($id);
    var_dump($trainer);
    $em->flush();
    header("location: index.php");
}
$twig = new Twig_Environment($loader,[
//'cache' => null,
]);
echo $twig->render('new_pokemon.html.twig', [
    "type" => $type,
    "session" => $_SESSION,
]);