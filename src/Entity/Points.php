<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

class Points
{
    /**
     * @ORM\Column(type="string", length=50)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $phone;

    /**
     * @ORM\Column(type="bigint", length=7)
     */
    private $int;

    
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    public function getInt()
    {
        return $this->int;
    }

    public function setInt($int): void
    {
        $this->int = $int;
    }
}