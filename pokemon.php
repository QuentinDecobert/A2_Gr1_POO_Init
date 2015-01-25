<?php
require __DIR__.'/vendor/autoload.php';
use Cartman\Init\Pokemon\Model\PokemonModel;
use Cartman\Init\Pokemon\PokemonFire;
use Cartman\Init\Pokemon\PokemonWater;
use Cartman\Init\Pokemon\PokemonPlant;
$pokemonFire = new PokemonFire();
$pokemonFire
    ->setName('Salamèche')
    ->setHP(100)
;
$pokemonWater = new PokemonWater();
$pokemonWater
    ->setName('Carapuce')
    ->setHP(100)
;
$pokemonPlant = new PokemonPlant();
$pokemonPlant
    ->setName('Bulbizarre')
    ->setHP(100)
;
$pokemons = [$pokemonWater, $pokemonFire, $pokemonPlant];
shuffle($pokemons);
/** @var PokemonModel $striker */
$striker    = array_pop($pokemons);
/** @var PokemonModel $goal */
$goal       = array_pop($pokemons);
/**
 * Parameters
 */
$roundNumber = 1;
$matchOver   = false;
echo '<h1>'.$striker->getName().' VS '.$goal->getName().'</h1>';
/**
 * Logic
 */
while (false === $matchOver) {
    echo '<h2>Round n°'.$roundNumber.'</h2>';
    $attackNumber = mt_rand(1, 3);
    for ($i = 0; $i < $attackNumber; $i++) {
        $attackValue = mt_rand(5, 20);
        if ($striker->isTypeWeak($goal->getType()))
            $attackValue = ceil($attackValue / 2);
        if ($striker->isTypeStrong($goal->getType()))
            $attackValue = ceil($attackValue * 2);
        $goal->removeHP((int)$attackValue);
        echo '<h3>'.$striker->getName().' attacks '.$goal->getName().'. Attack n°'.($i+1).' on '.$attackNumber.' '.$attackValue.' HP removed. '.$goal->getName().' have '.$goal->getHP().'HP left</h3>';
        if (0 === $goal->getHP()) {
            $matchOver = true;
            break;
        }
    }
    if (false === $matchOver)
        list($striker, $goal) = [$goal, $striker];
    $roundNumber++;
}
echo '<h1>'.$striker->getName().' win!</h1>';
echo '<h4>'.$striker->getHP().'HP left.</h4>';