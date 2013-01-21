<?php

namespace Href\ShortyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class UserController extends Controller
{

    public function profileAction()
    {
        $lastURLs = $this->getDoctrine()
            ->getRepository('HrefShortyBundle:Url')
            ->getSortedByDate($this->getUser()->getId());

        return $this->render('HrefShortyBundle:User:index.html.twig', array(
            'last_urls' => $lastURLs,
            'colors'    => array(
                '#0DA068', '#194E9C', '#ED9C13', '#ED5713', '#057249', '#5F91DC', '#F88E5D'
            )
        ));
    }
}