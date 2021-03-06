<?php

namespace Href\ShortyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Href\ShortyBundle\Entity\Stats;
use Href\ShortyBundle\Entity\Tld;
use Href\ShortyBundle\Entity\Domain;
use Href\ShortyBundle\Parsers\UrlParser;
use Symfony\Component\HttpFoundation\Response;
use Href\ShortyBundle\Form\Url\UrlType;
use Symfony\Component\HttpFoundation\Request;
use Href\ShortyBundle\Entity\Url;

class ShortyController extends Controller
{
    public function indexAction(Request $request)
    {

        $url = new Url();

        $form = $this->createForm(new UrlType(), $url);

        if ($request->isMethod('POST')) {

            $form->bind($request);

            if ($form->isValid()) {

                $existingUrl = $this->getDoctrine()
                    ->getRepository('HrefShortyBundle:Url')
                    ->findOneByOriginal($url->getOriginal());


                if ($existingUrl) {
                    return $this->redirect($this->generateUrl('url_success', array('generated' => $existingUrl->getGenerated())));
                }

                $url = $this->processUrl($url);

                return $this->redirect($this->generateUrl('url_success', array('generated' => $url->getGenerated())));
            }

        }

        $topDomains = $this->getDoctrine()
            ->getRepository('HrefShortyBundle:Domain')
            ->getTopTen();

        $topTlds = $this->getDoctrine()
            ->getRepository('HrefShortyBundle:Tld')
            ->getTopTen();

        $topStats = $this->getDoctrine()
            ->getRepository('HrefShortyBundle:Stats')
            ->getTopTen();

        return $this->render('HrefShortyBundle:Shorty:index.html.twig', array(
                'form' => $form->createView(),
                'top_domains' => $topDomains,
                'top_tlds' => $topTlds,
                'top_stats' => $topStats
            ));
    }

    public function successAction($generated)
    {
        return $this->render('HrefShortyBundle:Shorty:success.html.twig', array('url' => $generated));
    }

    public function showAction($generated, $mode)
    {
        if ($mode == 'stats') {
            return $this->forward('HrefShortyBundle:Shorty:stats', array('generated' => $generated));
        }

        $url = $this->getDoctrine()
            ->getRepository('HrefShortyBundle:Url')
            ->findOneByGenerated($generated);

        if (!$url) {
            throw $this->createNotFoundException('No such link');
        }

        $stats = $url->getStats();

        if (!$stats) {
            $stats = new Stats();
            $stats->setUrl($url);
        }

        $stats->setCount($stats->getCount() + 1);
        $stats->setUpdated(new \DateTime());

        $url->setStats($stats);

        $em = $this->getDoctrine()->getManager();
        $em->persist($stats);
        $em->persist($url);
        $em->flush();

        return $this->redirect($url->getOriginal());
    }

    public function statsAction($generated)
    {
        $url = $this->getDoctrine()
            ->getRepository('HrefShortyBundle:Url')
            ->findOneByGenerated($generated);

        return $this->render('HrefShortyBundle:Shorty:stats.html.twig', array(
            'url' => $url
        ));
    }

    public function bookmarkletAction()
    {
        $original = $this->getRequest()->get('url');

        $url = $this->getDoctrine()
            ->getRepository('HrefShortyBundle:Url')
            ->findOneByOriginal($original);

        if ($url) {
            return $this->render('HrefShortyBundle:Shorty:success_stripped.html.twig', array('url' => $url->getGenerated()));
        } else {
            $url = new Url();
            $url->setOriginal($original);
        }

        $url = $this->processUrl($url);

        return $this->render('HrefShortyBundle:Shorty:success_stripped.html.twig', array('url' => $url->getGenerated()));

    }

    public function apiAction()
    {
        $original = $this->getRequest()->get('url');

        $url = $this->getDoctrine()
            ->getRepository('HrefShortyBundle:Url')
            ->findOneByOriginal($original);


        if ($url) {
            return new JsonResponse(array('shortURL' => $this->generateUrl('url_show', array('generated' => $url->getGenerated()), true)));
        } else {
            $url = new Url();
            $url->setOriginal($original);
        }

        $url = $this->processUrl($url);

        return new JsonResponse(array('shortURL' => $this->generateUrl('url_show', array('generated' => $url->getGenerated()), true)));
    }

    public function jsonpAction()
    {

        $original = $this->getRequest()->get('url');
        $callback = $this->getRequest()->get('callback');

        $url = $this->getDoctrine()
            ->getRepository('HrefShortyBundle:Url')
            ->findOneByOriginal($original);


        if ($url) {
            return new Response($callback . "(" . json_encode(array('shortURL' => $this->generateUrl('url_show', array('generated' => $url->getGenerated())))) . ")");
        } else {
            $url = new Url();
            $url->setOriginal($original);
        }

        $url = $this->processUrl($url);

        return new Response($callback . "(" . json_encode(array('shortURL' => $this->generateUrl('url_show', array('generated' => $url->getGenerated())))) . ")");

    }

    public function processUrl($url)
    {

        $em = $this->getDoctrine()->getManager();

        // Gen the pre-generate short URL and use
        $generated = $this->getDoctrine()
            ->getRepository('HrefShortyBundle:Short')
            ->getOneRandom();

        if ($this->getUser()) {
            $url->setUser($this->getUser());
        }

        $url->setGenerated($generated->getShort());
        $url->setCreated(new \DateTime());

        $urlParser = new UrlParser($url->getOriginal());

        $domain = $this->getDoctrine()
            ->getRepository('HrefShortyBundle:Domain')
            ->findOneByName($urlParser->getDomain());

        if (!$domain) {
            $domain = new Domain();
            $domain->setName($urlParser->getDomain());
        }

        $domain->setCount($domain->getCount() + 1);

        $tld = $this->getDoctrine()
            ->getRepository('HrefShortyBundle:Tld')
            ->findOneByName($urlParser->getTld());

        if (!$tld) {
            $tld = new Tld();
            $tld->setName($urlParser->getTld());
        }

        $tld->setCount($tld->getCount() + 1);



        $em->persist($url);
        $em->persist($domain);
        $em->persist($tld);
        $em->remove($generated);
        $em->flush();

        return $url;
    }

    public function tweetbotAction()
    {
        return $this->render('HrefShortyBundle:Shorty:tweetbot.html.twig');
    }

    public function bookmarkletPageAction()
    {
        return $this->render('HrefShortyBundle:Shorty:bookmarklet.html.twig');
    }

}
