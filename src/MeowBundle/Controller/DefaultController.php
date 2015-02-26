<?php

namespace MeowBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Template()
     */
    public function indexAction()
    {
        $repoSpoils = $this->container->get('doctrine')->getRepository('MeowBundle:Spoil');
        $spoils = $repoSpoils->findBy(array('isPublished' => true));
        $randSpoil = rand(0, sizeof($spoils) - 1);
        $spoil = $spoils[$randSpoil];

        return array('spoil' => $spoil);
    }

    /**
     * @Route("/all-spoils/")
     * @Template()
     */
    public function listAction()
    {
        $repoSpoils = $this->container->get('doctrine')->getRepository('MeowBundle:Spoil');
        $spoils = $repoSpoils->findBy(array('isPublished' => true));

        return array('spoils' => $spoils);
    }

    /**
     * @Route("/spoil/{slug}")
     * @Template()
     */
    public function articleAction($slug)
    {
        $repoSpoil = $this->container->get('doctrine')->getRepository('MeowBundle:Spoil');
        $spoil = $repoSpoil->findOneBy(array('isPublished' => true, 'slug' => $slug));

        if(!$spoil){
            throw $this->createNotFoundException('La page que vous recherchez n\'existe pas.');
        }

        $repoComment = $this->container->get('doctrine')->getRepository('MeowBundle:Comment');
        $comments = $repoComment->findBy(array('idSpoil' => $spoil));

        return array('spoil' => $spoil, 'comments' => $comments);
    }

    /**
     * @Route("/connexion/")
     * @Template()
     */
    public function connexionAction()
    {
        return array();
    }

    /**
     * @Route("/inscription/")
     * @Template()
     */
    public function inscriptionAction()
    {
        return array();
    }

    /**
     * @Route("/profile/{pseudo}")
     * @Template()
     */
    public function profileAction($pseudo, Request $request)
    {
        $repoUser = $this->container->get('doctrine')->getRepository('MeowBundle:User');
        $user = $repoUser->findOneBy(array('pseudo' => $pseudo));

        if(!$user){
            throw $this->createNotFoundException('La page que vous recherchez n\'existe pas.');
        }

        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT s FROM MeowBundle:Spoil s WHERE s.isPublished = true AND s.author = " . $user->getId();
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->get('page', 1),
            10
        );

        return $this->render('MeowBundle:Default:profile.html.twig', array('user' => $user, 'pagination' => $pagination));
    }

    /**
     * @Route("/moderation/")
     * @Template()
     */
    public function moderationAction(Request $request)
    {
        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT s FROM MeowBundle:Spoil s ORDER BY s.date DESC";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->get('page', 1),
            10
        );

        return $this->render('MeowBundle:Default:moderation.html.twig', array('pagination' => $pagination));
    }
}
