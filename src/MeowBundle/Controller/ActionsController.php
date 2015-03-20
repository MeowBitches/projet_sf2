<?php

namespace MeowBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use MeowBundle\Form\CommentType;
use MeowBundle\Entity\Comment;
use MeowBundle\Entity\Manga;
use MeowBundle\Form\SpoilType;
use MeowBundle\Entity\Spoil;
use MeowBundle\Form\UserType;
use MeowBundle\Entity\User;

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

        $nbComments = $spoil->getNbComments();
        $spoil->setNbComments($nbComments + 1);

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
        
        $nbComments = $spoil->getNbComments();
        $spoil->setNbComments($nbComments + 1);

        $form = $this->createForm(new CommentType(), $comment);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $comment = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('view_spoil', array('slug' => $spoil->getSlug())));
    }

    /**
     * @Route("/add-manga/", name="add-manga")
     */
    public function addMangaAction(Request $request)
    {
        $id = $request->get('id', null);
        $name = $request->get('name', null);

        $repoCategory = $this->container->get('doctrine')->getRepository('MeowBundle:Category');
        $category = $repoCategory->findOneById($id);

        $manga = new Manga();
        $manga->setName($name);
        $manga->setCategory($category);

        $this->container->get('doctrine.orm.default_entity_manager')->persist($manga);
        $this->container->get('doctrine.orm.default_entity_manager')->flush();

        $repoManga = $this->container->get('doctrine')->getRepository('MeowBundle:Manga');
        $mangas = $repoManga->findAll();
        $mangasResult = array();
    
        foreach ($mangas as $manga) {
            $mangasResult[] = array(
                'id' => $manga->getId(),
                'name' => $manga->getName()
            );
        }

        return new JsonResponse(array('mangas' => $mangasResult));
    }

    /**
     * @Route("/add-spoil/", name="add-spoil")
     */
    public function addSpoilAction(Request $request)
    {
        $spoil = new Spoil();
        $spoil->setAuthor($this->getUser());
        $spoil->setDate(new \DateTime());
        $spoil->setNbComments(0);
        $spoil->setNbSpoil(0);
        $spoil->setNbFail(0);
        $spoil->setNbFake(0);
        $spoil->setIsPublished(0);

        $form = $this->createForm(new SpoilType(), $spoil);

        if($this->getRequest()->isMethod('POST')){
            $repoManga = $this->container->get('doctrine')->getRepository('MeowBundle:Manga');
            $formVars = $request->get($form->getName());
            $formVars['manga'] = $repoManga->findOneBy(array('name' => $formVars['manga']));
            $request->request->set($form->getName(), $formVars);
            
            $form->handleRequest($request);

            if($form->isValid())
            {
                $spoil = $form->getData();
                $spoil->upload();

                $em = $this->getDoctrine()->getManager();
                $em->persist($spoil);
                $em->flush();
            }
        }

        return $this->redirect($this->generateUrl('home'));
    }

    /**
     * @Route("/create-spoil/", name="create-spoil")
     * @Template("MeowBundle:Includes:create_spoil.html.twig")
     */
    public function createSpoilAction(Request $request)
    {
        $repoCategories = $this->container->get('doctrine')->getRepository('MeowBundle:Category');
        $categories = $repoCategories->findAll();

        $repoMangas = $this->container->get('doctrine')->getRepository('MeowBundle:Manga');
        $mangas = $repoMangas->findAll();

        $form3 = $this->createForm(new SpoilType());

        return array('categories' => $categories, 'mangas' => $mangas, 'formSpoil' => $form3->createView());
    }

    /**
     * @Route("/activate-spoil", name="activate-spoil")
     */
    public function activateSpoilAction(Request $request)
    {
        $id = $request->get('id', null);
        $repoSpoil = $this->container->get('doctrine')->getRepository('MeowBundle:Spoil');
        $spoil = $repoSpoil->findOneById($id);

        $spoil->setIsPublished(1);

        $this->container->get('doctrine.orm.default_entity_manager')->flush();

        return new Response(null);
    }

    /**
     * @Route("/inactivate-spoil", name="inactivate-spoil")
     */
    public function inactivateSpoilAction(Request $request)
    {
        $id = $request->get('id', null);
        $repoSpoil = $this->container->get('doctrine')->getRepository('MeowBundle:Spoil');
        $spoil = $repoSpoil->findOneById($id);

        $spoil->setIsPublished(0);

        $this->container->get('doctrine.orm.default_entity_manager')->flush();

        return new Response(null);
    }

    /**
     * @Route("/change-cover-user)", name="change-cover-user")
     */
    public function changeCoverUserAction(Request $request)
    {
        $id = $this->getUser()->getId();

        $repoUser = $this->container->get('doctrine')->getRepository('MeowBundle:User');
        $user = $repoUser->findOneById($id);

        $form = $this->createForm(new UserType(), $user);

        if($this->getRequest()->isMethod('POST')){
            $form->handleRequest($request);

            if($form->isValid())
            {
                $cover = $form->getData();
                $cover->upload();

                $em = $this->getDoctrine()->getManager();
                $em->persist($cover);
                $em->flush();
            }
        }

        return $this->redirect($this->generateUrl('home'));
    }
}