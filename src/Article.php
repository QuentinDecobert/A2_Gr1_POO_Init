<?php
/**
 * Created by PhpStorm.
 * User: Benjamin-ut
 * Date: 05/01/2015
 * Time: 15:26
 */

namespace Cartman\Init;


/**
 * Class Article
 * @package Cartman\Init
 *
 * @Entity
 * @Table(name="article")
 */
class Article
{
    /**
     * @var int
     *
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(name="id", type="integer")
     */

    private $id;
    /**
     * @var string
     *
     * @Column(name="title", type="string", length=60)
     */

    private $title;

    /**
     * @var string
     *
     * @Column(name="slug", type="string", length=60)
     */
    private $slug;

    /**
     * @var int
     *
     * @Column (name="status", type="smallint")
     */
    private $status;


    const STATUS_PENDING = 0;

    const STATUS_VALIDATED = 2 ;

    const STATUS_REMOVED = 2 ;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @throws \Exception
     * @return Article
     */
    public function setId($id)
    {
        if (is_int($id) && $id > 0)
            $this->id=$id;
        else
            throw new \Exception('Id must be an integer and > 0');

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @throws \Exception
     * @return Article
     */
    public function setTitle($title)
    {
        if (is_string($title))
            $this->title = $title;
        else
            throw new \Exception('Title must be a string');
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     *
     * @throws \Exception
     * @return Article
     */
    public function setSlug($slug)
    {
        if (is_string($slug))
        $this->slug = $slug;
        else
            throw new \Exception('Slg must be a string');
        return $this;
    }

    /**
     * @return int
     */

    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @throws Exception
     *
     * @return Article
     */
    public function setStatus($status)
    {
        $this->status = $status;
        if (true === in_array ($status,[
                self::STATUS_PENDING,
                self::STATUS_VALIDATED,
                self::STATUS_REMOVED,
            ]))
        $this->status = $status;
        else
            throw new \Exception('Status is not valid');
        return $this;
    }

}