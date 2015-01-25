<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 06/01/2015
 * Time: 15:17
 */

namespace QuentinDecobert\PokemonBattle\Model;

/**
 * Class TrainerModel
 * @package QuentinDecobert\PokemonBattle\Model
 *
 * @Entity
 * @Table(name="pokemon")
 */
class PokemonModel implements PokemonInterface
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setHp(100);
    }


    /**
     * @var int
     *
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(name="id", type="integer")
     */
    private $id;





    /**
     * @var int
     *
     * @Column(name="user_id", type="integer")
     */
    private $user_id;


    /**
     * @var string
     *
     * @Column(name="name", type="string", length=20)
     */
    private $name;

    /**
     * @var int
     *
     * @Column(name="hp", type="integer")
     */
    private $hp;

    /**
     * @var int
     *
     * @Column(name="type", type="integer")
     */
    private $type;

    /**
     * @var int
     */
    private $type_atk;

    const TYPE_FIRE = 0;

    const TYPE_WATER = 1;

    const TYPE_PLANT = 2;

    const TYPE_ELECTRIC = 3;

    const TYPE_PSY = 4;

    const TYPE_NORMAL = 5;

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     *
     * @return PokemonModel
     *
     * @throws \Exception
     */
    public function setName($name)
    {
        if(is_string($name))
            $this->name = $name;
        else
            throw new \Exception('name must be string');

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getHP()
    {
        return $this->hp;
    }

    /**
     * {@inheritdoc}
     *
     * @return PokemonModel
     *
     * @throws \Exception
     */
    public function setHp($hp)
    {
        if(is_int($hp) && $hp >= 0)
            $this->hp = $hp;
        else
            throw new \Exception('HP Must be an integer and must be > 0');

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function addHP($hp)
    {
        if(is_int($hp) && $hp > 0)
            $this->hp += $hp;
        else
            throw new \Exception('HP Must be an integer and must be > 0');

        return $this->hp;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function removeHP($hp)
    {
        if(is_int($hp) && $hp >= 0)
          $this->hp = ($this->hp <= $hp) ? 0 : $this->hp - $hp;
        else
            throw new \Exception('HP Must be an integer and must be > 0');

        return $this->hp;
    }

    public function getType()
    {

        return $this->type;

    }

    /**
     * {@inheritdoc}
     *
     * @return PokemonModel
     *
     * @throws \Exception
     */
    public function setType($type)
    {

        if(true === in_array($type, [
                self::TYPE_FIRE,
                self::TYPE_WATER,
                self::TYPE_PLANT,
                self::TYPE_ELECTRIC,
                self::TYPE_PSY,
                self::TYPE_NORMAL
            ]))
                $this->type = $type;
        else
            throw new \Exception('Bad type');

        return $this;
    }

    /**
     * @param int $type
     * @param int $type_atk
     * @return bool
     */
    public function isTypeWeak($type, $type_atk){
        if($type == self::TYPE_FIRE){
            return (self::TYPE_WATER === $type_atk) ? true : false;
        }
        elseif($type === self::TYPE_WATER){
            return (self::TYPE_PLANT === $type_atk) ? true : false;
        }
        elseif($type === self::TYPE_PLANT){
            return (self::TYPE_FIRE === $type_atk) ? true : false;
        }
        else
            return false;

    }

    /**
     * @param int $type
     * @return bool
     */
    public function isTypeStrong($type, $type_atk){
        if($type_atk == self::TYPE_FIRE){
            return (self::TYPE_PLANT === $type) ? true : false;
        }
        elseif($type_atk === self::TYPE_WATER){
            return (self::TYPE_FIRE === $type) ? true : false;
        }
        elseif($type_atk === self::TYPE_PLANT){
            return (self::TYPE_WATER === $type) ? true : false;
        }

        else
            return false;

    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }


    /**
     * @param int $user_id
     *
     * @throws \Exception
     * @return PokemonModel
     */
    public function setUserId($user_id)
    {
        if(is_int($user_id) && $user_id > 0)
            $this->user_id = $user_id;
        else
            throw new \Exception("user id must be an integer and > 0");

        return $this;
    }





}