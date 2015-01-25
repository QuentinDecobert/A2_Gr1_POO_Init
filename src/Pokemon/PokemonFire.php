<?php
/**
 * Created by PhpStorm.
 * User: Benjamin-ut
 * Date: 06/01/2015
 * Time: 15:39
 */

namespace Cartman\Init\Pokemon;


use Cartman\Init\Pokemon\Model\PokemonModel;

class PokemonFire extends PokemonModel
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setType(self::TYPE_FIRE);
    }
    /**
     * @inheritdoc
     */
    public function isTypeWeak($type)
    {
        return (self::TYPE_WATER === $type) ? true : false;
    }

    /**
     * @inheritdoc
     */
    public function isTypeStrong($type)
    {
        return (self::TYPE_PLANT === $type) ? true : false;
    }


} 