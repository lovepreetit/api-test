<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Address;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User implements \JsonSerializable
{

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=50)
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(name="age", type="integer", length=11)
     * @var integer
     */
    private $age;

    /**
     * @ORM\Column(name="email", type="string", length=100)
     * @var string
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="\App\Entity\Address", mappedBy="post")
     * @ORM\JoinColumn(name="id", referencedColumnName="user_id")
     */
    protected $addresses;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'age' => $this->age,
            'email' => $this->email,
        ];
    }

    /**
     * @return integer
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param int $age
     */
    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }


    /**
     * @return mixed
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * @param ArrayCollection $addresses
     */
    public function setAddresses(ArrayCollection $addresses): void
    {
        $this->addresses = $addresses;
    }
}
