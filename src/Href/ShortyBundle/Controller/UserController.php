<?php

namespace Href\ShortyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class UserController extends Controller
{
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        // Store login errors
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render(
            'HrefShortyBundle:User:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error
            )
        );
    }

    public function profileAction()
    {
        $lastURLs = $this->getDoctrine()
            ->getRepository('HrefShortyBundle:Url')
            ->getSortedByDate($this->getUser()->getId());

        return $this->render('HrefShortyBundle:User:index.html.twig', array(
            'last_urls' => $lastURLs
        ));
    }
}