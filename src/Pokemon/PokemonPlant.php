<?php

namespace Cartman\Init\Pokemon;

use Cartman\Init\Pokemon\Model\PokemonModel;

class PokemonPlant extends PokemonModel
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setType(self::TYPE_PLANT);
    }

    /**
     * @inheritdoc
     */
    public function isTypeWeak($type)
    {
        return (self::TYPE_FIRE === $type) ? true : false;
    }

    /**
     * @inheritdoc
     */
    public function isTypeStrong($type)
    {
        return (self::TYPE_WATER === $type) ? true : false;
    }
}