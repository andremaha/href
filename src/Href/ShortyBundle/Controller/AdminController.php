<?php

namespace Href\ShortyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class AdminController extends Controller
{
    public function indexAction()
    {
        $lastURLs = $this->getDoctrine()
            ->getRepository('HrefShortyBundle:Url')
            ->getLastTen();

        $lastUsers = $this->getDoctrine()
            ->getRepository('HrefShortyBundle:User')
            ->findAll();

        return $this->render('HrefShortyBundle:Admin:index.html.twig', array(
                'last_urls' => $lastURLs,
                'last_users' => $lastUsers
            ));
    }
}