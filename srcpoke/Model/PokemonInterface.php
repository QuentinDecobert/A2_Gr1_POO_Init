<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 06/01/2015
 * Time: 15:09
 */

namespace QuentinDecobert\PokemonBattle\Model;


interface PokemonInterface
{
    /**
     * @return string
     */
    public function getName();


    /**
     * @param string $name
     * @return PokemonInterface
     */
    public function setName($name);

    /**
     * @return int
     */
    public function getHP();

    /**
     * @param int $hp
     * @return PokemonInterface
     */
    public function setHP($hp);

    /**
     * @param int $hp
     * @return int
     */
    public function addHP($hp);

    /**
     * @param int $hp
     * @return int
     */
    public function removeHP($hp);


    /**
     * @return PokemonInterface
     */
    public function getType();

    /**
     * @param int $type
     * @return PokemonInterface
     */
    public function setType($type);

}