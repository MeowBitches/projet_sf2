<?php

namespace MeowBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
        return array('slug' => $slug);
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
    public function profileAction($pseudo)
    {
        return array('pseudo' => $pseudo);
    }

    /**
     * @Route("/new/")
     * @Template()
     */
    public function newArticleAction()
    {
        return array();
    }
}
