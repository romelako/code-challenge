<?php

namespace App\EventListener;

use App\Entity\LoginActivity;
use App\Event\LoginEvent;
use App\Repository\LoginActivityRepository;

class LoginListener
{
    /** @var LoginActivityRepository */
    private $loginActivityRepository;

    /**
     * ExceptionListener constructor.
     * @param LoginActivityRepository $loginActivityRepository
     */
    public function __construct(LoginActivityRepository $loginActivityRepository)
    {
        $this->loginActivityRepository = $loginActivityRepository;
    }

    public function onLoginAttempt(LoginEvent $event)
    {
        $activity = new LoginActivity();
        $activity->setLoginDate(new \DateTime())
            ->setUsername($event->getUsername())
            ->setStatus($event->getStatus());

        $this->loginActivityRepository->save($activity);
    }
}