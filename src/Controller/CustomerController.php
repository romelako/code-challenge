<?php

namespace App\Controller;

use App\Common\ErrorMessages;
use App\Common\LoginException;
use App\Common\SuccessMessages;
use App\Entity\LoginActivity;
use App\Event\LoginEvent;
use App\Repository\CustomerRepository;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CustomerController extends AbstractController
{
    /**
     * @Route("/login")
     * @param Request $request
     * @param CustomerRepository $customerRepository
     * @param EventDispatcherInterface $eventDispatcher
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(
        Request $request,
        CustomerRepository $customerRepository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $message = "";

        if ($request->getMethod() == 'POST') {
            $event = new LoginEvent($request->get('username'));
            $customer = $customerRepository->findOneByUsername($request->get('username'));

            try {
                if (!$this->isCsrfTokenValid('login', $request->get('token')))
                    throw new LoginException(
                        LoginActivity::STATUS_FAILED_CSRF_TOKEN_INVALID,
                        ErrorMessages::CSRF_TOKEN_INVALID
                    );

                if ($customer == null)
                    throw new LoginException(
                        LoginActivity::STATUS_FAILED_NO_USER,
                        sprintf(ErrorMessages::USER_NOT_FOUND, $request->get('username'))
                    );

                if (!password_verify($request->get('password'), $customer->getPassword()))
                    throw new LoginException(
                        LoginActivity::STATUS_FAILED_INCORRECT_PASSWORD,
                        ErrorMessages::PASSWORDS_DONT_MATCH
                    );

                $message = SuccessMessages::LOGIN_SUCCESS;
                $event->setStatus(LoginActivity::STATUS_SUCCESS);
            } catch (LoginException $e) {
                $event->setStatus($e->getStatusCode());
                $message = $e->getMessage();
            }

            $eventDispatcher->dispatch($event, LoginEvent::NAME);
        }

        return $this->render("customer/login.html.twig", [
            "message" => $message
        ]);
    }
}
