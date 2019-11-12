<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="addresses")
 */
class Address implements \JsonSerializable
{

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var integer
     */
    private $id;

    /**
     * Many Address will have one User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="addresses")
     */
    protected $user;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $user_id;

    /**
     * @ORM\Column(name="city", type="string", length=100)
     * @var string
     */
    private $city;

    /**
     * @ORM\Column(name="state", type="string", length=100)
     * @var string
     */
    private $state;

    /**
     * @ORM\Column(name="pin", type="string", length=10)
     * @var string
     */
    private $pin;


    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'city' => $this->city,
            'state' => $this->state,
            'pin' => $this->pin,
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }


    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getPin(): string
    {
        return $this->pin;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @param string $pin
     */
    public function setPin(string $pin): void
    {
        $this->pin = $pin;
    }

    /**
     * @param string $state
     */
    public function setState(string $state): void
    {
        $this->state = $state;
    }

}


