<?php

namespace App\Entity;

use App\Repository\LoginActivityRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

/**
 * @ORM\Entity(repositoryClass=LoginActivityRepository::class)
 */
class LoginActivity
{
    const STATUS_SUCCESS = 1;
    const STATUS_FAILED_NO_USER = 2;
    const STATUS_FAILED_INCORRECT_PASSWORD = 4;
    const STATUS_FAILED_CSRF_TOKEN_INVALID = 8;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $loginDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $username;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLoginDate(): ?\DateTimeInterface
    {
        return $this->loginDate;
    }

    public function setLoginDate(\DateTimeInterface $loginDate): self
    {
        $this->loginDate = $loginDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }
}
