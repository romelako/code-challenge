<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class LoginEvent extends Event
{
    public const NAME = 'login.attempt';

    /** @var string */
    private $username;
    /** @var int */
    private $status;

    /**
     * LoginEvent constructor.
     * @param string $username
     */
    public function __construct($username)
    {
        $this->username = $username;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return $this
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
        return $this;
    }
}