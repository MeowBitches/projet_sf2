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
        return array();
    }

    /**
     * @Route("/all-spoils/")
     * @Template()
     */
    public function listAction()
    {
        $repoSpoils = $this->container->get('doctrine')->getRepository('MeowBundle:Spoil');
        $spoils = $repoSpoils->findAll();

        return array('spoils' => $spoils);
    }

    /**
     * @Route("/spoil/{name}")
     * @Template()
     */
    public function articleAction($name)
    {
        return array('name' => $name);
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
