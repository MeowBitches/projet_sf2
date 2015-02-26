<?php

namespace MeowBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Doctrine\ORM\Tools\Pagination\Paginator;

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
    public function profileAction($pseudo)
    {
        $repoUser = $this->container->get('doctrine')->getRepository('MeowBundle:User');
        $user = $repoUser->findOneBy(array('pseudo' => $pseudo));

        if(!$user){
            throw $this->createNotFoundException('La page que vous recherchez n\'existe pas.');
        }

        $repoSpoil = $this->container->get('doctrine')->getRepository('MeowBundle:Spoil');
        $spoils = $repoSpoil->findBy(array('isPublished' => true, 'author' => $user));

        return array('user' => $user, 'spoils' => $spoils);
    }

    /**
     * @Route("/moderation/")
     * @Template()
     */
    public function moderationAction()
    {
        $repoSpoil = $this->container->get('doctrine')->getRepository('MeowBundle:Spoil');
        $spoils = $repoSpoil->findBy(array(), array('isPublished' => 'ASC','date' => 'DESC'));

        return array('spoils' => $spoils);
    }
}
