<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 15/01/2015
 * Time: 15:05
 */


require __DIR__.'/vendor/autoload.php';


use QuentinDecobert\PokemonBattle\Model\TrainerModel;
use QuentinDecobert\PokemonBattle\Model\PokemonModel;
use Cocur\Slugify\Slugify;




/** @var $em \Doctrine\ORM\EntityManager */
$em = require __DIR__.'/bootstrap.php';

session_start();

if (empty($_SESSION) )
{
//echo 'Forbidden !';
    header('Location: index.php');
    die;
}

$currentDate = strtotime("now");

/** @var  \Doctrine\ORM\EntityRepository */
$trainerRepository = $em->getRepository('QuentinDecobert\PokemonBattle\Model\TrainerModel');

/** @var  \Doctrine\ORM\EntityRepository */
$pokeRepository = $em->getRepository('QuentinDecobert\PokemonBattle\Model\PokemonModel');

/** @var \QuentinDecobert\PokemonBattle\Model\TrainerModel $trainer */
$trainer = $trainerRepository->find($_SESSION['id']);

/** @var \QuentinDecobert\PokemonBattle\Model\TrainerModel $poke_id */
$poke_id = $trainer->getPokemonId();

/** @var \QuentinDecobert\PokemonBattle\Model\PokemonModel $poke */
$poke = $pokeRepository->find($poke_id);

/** @var \QuentinDecobert\PokemonBattle\Model\PokemonModel $currentHp */
$currentHp = $poke->getHp();


    /** @var \QuentinDecobert\PokemonBattle\Model\TrainerModel $date */
    $date = $trainer->getLastHeal();

    if ($currentDate - $date < (3600 * 24))
        header("location: heal-error.php");
    else {
        if($currentHp == 100)
        {
            header("location: my_pokemon.php");
        } else
        {
        $trainer->setLastHeal($currentDate);
        $poke->setHp(100);
        $em->flush();
        header("location: my_pokemon.php");
    }
}