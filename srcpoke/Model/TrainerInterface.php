<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 11/01/2015
 * Time: 15:17
 */

namespace QuentinDecobert\PokemonBattle\Model;


interface TrainerInterface {

    /**
     * @return string
     */
    public function getUsername();

    /**
     * @param string $user_name
     * @return TrainerInterface
     */
    public function setUsername($user_name);


    /**
     * @return string
     */
    public function getPassword();

    /**
     * @param string $password
     * @return TrainerInterface
     */
    public function setPassword($password);

    /**
     * @return int
     */
    public function getHavePokemon();

    /**
     * @param integer $have_pokemon
     * @return TrainerInterface
     */
    public function setHavePokemon($have_pokemon);

    /**
     * @return string
     */
    public function getPokemonName();

    /**
     * @param string $pokemon_name
     * @return TrainerInterface
     */
    public function setPokemonName($pokemon_name);

    /**
     * @param int $lastBattle
     *
     * @return TrainerInterface
     * @throws \Exception
     */
    public function setLastBattle($lastBattle);

    /**
     * @return int
     */
    public function getLastBattle();

    /**
     * @param int $lastHeal
     *
     * @return TrainerInterface
     * @throws \Exception
     */
    public function setLastHeal($lastHeal);

    /**
     * @return int
     */
    public function getLastheal();

}

