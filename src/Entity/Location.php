<?php

namespace Entity;

use Doctrine\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Office
 *
 * @ORM\Table(name="locations")
 */
class Location extends Entity
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="lat", type="decimal", precision=6, scale=10)
     */
    protected $lat;

    /**
     * @var string
     *
     * @ORM\Column(name="lon", type="decimal", precision=6, scale=10)
     */
    protected $lon;

    /**
     * @var string
     *
     * @ORM\Column(type="datetime")
     */
    protected $time;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * Set
     *
     * @param
     * @return
     */
    public function setLon($lon)
    {
        $this->lon = $lon;

        return $this;
    }

    /**
     * Get officeNumber
     *
     * @return string
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * Set city
     *
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }
}
