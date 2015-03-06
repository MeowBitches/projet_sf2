<?php

namespace MeowBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ActionsController extends Controller
{
    /**
     * @Route("/add-one-spoiled", name="add-one-spoiled")
     */
    public function addOneSpoiledAction(Request $request)
    {
        $id = $request->get('id', null);
        $repoSpoil = $this->container->get('doctrine')->getRepository('MeowBundle:Spoil');
        $spoil = $repoSpoil->findOneById($id);

        $nbSpoil = $spoil->getNbSpoil();
        $spoil->setNbSpoil($nbSpoil + 1);

        $this->container->get('doctrine.orm.default_entity_manager')->flush();

        return new Response($spoil->getNbSpoil());
    }

    /**
     * @Route("/add-one-fail", name="add-one-fail")
     */
    public function addOneFailAction(Request $request)
    {
        $id = $request->get('id', null);
        $repoSpoil = $this->container->get('doctrine')->getRepository('MeowBundle:Spoil');
        $spoil = $repoSpoil->findOneById($id);

        $nbFail = $spoil->getNbFail();
        $spoil->setNbFail($nbFail + 1);

        $this->container->get('doctrine.orm.default_entity_manager')->flush();

        return new Response($spoil->getNbFail());
    }

    /**
     * @Route("/add-one-fake", name="add-one-fake")
     */
    public function addOneFakeAction(Request $request)
    {
        $id = $request->get('id', null);
        $repoSpoil = $this->container->get('doctrine')->getRepository('MeowBundle:Spoil');
        $spoil = $repoSpoil->findOneById($id);

        $nbFake = $spoil->getNbFake();
        $spoil->setNbFake($nbFake + 1);

        $this->container->get('doctrine.orm.default_entity_manager')->flush();

        return new Response($spoil->getNbFake());
    }
}