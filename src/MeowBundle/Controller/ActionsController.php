<?php

namespace MeowBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use MeowBundle\Form\CommentType;
use MeowBundle\Entity\Comment;

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

    /**
     * @Route("/like-comment", name="like-comment")
     */
    public function likeAction(Request $request)
    {
        $id = $request->get('id', null);
        $repoComment = $this->container->get('doctrine')->getRepository('MeowBundle:Comment');
        $comment = $repoComment->findOneById($id);

        $nbLike = $comment->getNbLike();
        $comment->setNbLike($nbLike + 1);

        $this->container->get('doctrine.orm.default_entity_manager')->flush();

        return new Response($comment->getNbLike());
    }

    /**
     * @Route("/dislike-comment", name="dislike-comment")
     */
    public function dislikeAction(Request $request)
    {
        $id = $request->get('id', null);
        $repoComment = $this->container->get('doctrine')->getRepository('MeowBundle:Comment');
        $comment = $repoComment->findOneById($id);

        $nbLike = $comment->getNbLike();
        $comment->setNbLike($nbLike - 1);

        $this->container->get('doctrine.orm.default_entity_manager')->flush();

        return new Response($comment->getNbLike());
    }

    /**
     * @Route("/add-comment-lvl1/{id}", name="add-comment-lvl1")
     */
    public function addCommentLvlOneAction(Request $request, $id)
    {
        $repoSpoil = $this->container->get('doctrine')->getRepository('MeowBundle:Spoil');
        $spoil = $repoSpoil->findOneById($id);

        $comment = new Comment();
        $comment->setAuthor($this->getUser());
        $comment->setIdSpoil($spoil);
        $comment->setDate(new \DateTime());
        $comment->setNbLike(0);

        $form = $this->createForm(new CommentType(), $comment);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $comment = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('view_spoil', array('slug' => $spoil->getSlug())));
    }

    /**
     * @Route("/add-comment-lvl2/{id}&{id_parent}", name="add-comment-lvl2")
     */
    public function addCommentLvlTwoAction(Request $request, $id, $id_parent)
    {
        $repoSpoil = $this->container->get('doctrine')->getRepository('MeowBundle:Spoil');
        $spoil = $repoSpoil->findOneById($id);

        $repoComment = $this->container->get('doctrine')->getRepository('MeowBundle:Comment');
        $parent = $repoComment->findOneById($id_parent);

        $comment = new Comment();
        $comment->setAuthor($this->getUser());
        $comment->setIdSpoil($spoil);
        $comment->setParent($parent);
        $comment->setDate(new \DateTime());
        $comment->setNbLike(0);

        $form = $this->createForm(new CommentType(), $comment);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $comment = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('view_spoil', array('slug' => $spoil->getSlug())));
    }
}