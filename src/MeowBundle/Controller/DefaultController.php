<?php

namespace MeowBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use MeowBundle\Form\CommentType;
use MeowBundle\Form\SpoilType;

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

        $repoCategories = $this->container->get('doctrine')->getRepository('MeowBundle:Category');
        $categories = $repoCategories->findAll();

        $repoMangas = $this->container->get('doctrine')->getRepository('MeowBundle:Manga');
        $mangas = $repoMangas->findAll();

        $form3 = $this->createForm(new SpoilType());

        return array('spoil' => $spoil, 'categories' => $categories, 'mangas' => $mangas, 'formSpoil' => $form3->createView());
    }

    /**
     * @Route("/all-spoils/")
     * @Template()
     */
    public function listAction()
    {
        $repoSpoils = $this->container->get('doctrine')->getRepository('MeowBundle:Spoil');
        $spoils = $repoSpoils->findBy(array('isPublished' => true), array('nbComments' => 'DESC'));

        $repoCategories = $this->container->get('doctrine')->getRepository('MeowBundle:Category');
        $categories = $repoCategories->findAll();

        $repoMangas = $this->container->get('doctrine')->getRepository('MeowBundle:Manga');
        $mangas = $repoMangas->findAll();

        $form3 = $this->createForm(new SpoilType());

        return array('spoils' => $spoils, 'categories' => $categories, 'mangas' => $mangas, 'formSpoil' => $form3->createView());
    }

    /**
     * @Route("/spoil/{slug}", name="view_spoil")
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

        $form = $this->createForm(new CommentType());

        $tab = array();
        foreach($comments as $key=>$comment){
            $form2 = $this->createForm(new CommentType($key.'_commentform'));
            $tab[] = $form2->createView();
        }

        $repoCategories = $this->container->get('doctrine')->getRepository('MeowBundle:Category');
        $categories = $repoCategories->findAll();

        $repoMangas = $this->container->get('doctrine')->getRepository('MeowBundle:Manga');
        $mangas = $repoMangas->findAll();

        $form3 = $this->createForm(new SpoilType());

        return array('spoil' => $spoil, 'comments' => $comments, 'form' => $form->createView(), 'forms' => $tab, 'categories' => $categories, 'mangas' => $mangas, 'formSpoil' => $form3->createView());
    }

    /**
     * @Route("/profile/{username}")
     * @Template()
     */
    public function profileAction($username, Request $request)
    {
        $repoUser = $this->container->get('doctrine')->getRepository('MeowBundle:User');
        $user = $repoUser->findOneBy(array('username' => $username));

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
            12
        );

        $repoCategories = $this->container->get('doctrine')->getRepository('MeowBundle:Category');
        $categories = $repoCategories->findAll();

        $repoMangas = $this->container->get('doctrine')->getRepository('MeowBundle:Manga');
        $mangas = $repoMangas->findAll();

        $form3 = $this->createForm(new SpoilType());

        return $this->render('MeowBundle:Default:profile.html.twig', array('user' => $user, 'pagination' => $pagination, 'categories' => $categories, 'mangas' => $mangas, 'formSpoil' => $form3->createView()));
    }

    /**
     * @Route("/admin/moderation/")
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
            5
        );

        $repoCategories = $this->container->get('doctrine')->getRepository('MeowBundle:Category');
        $categories = $repoCategories->findAll();

        $repoMangas = $this->container->get('doctrine')->getRepository('MeowBundle:Manga');
        $mangas = $repoMangas->findAll();

        $form3 = $this->createForm(new SpoilType());

        return $this->render('MeowBundle:Default:moderation.html.twig', array('pagination' => $pagination, 'categories' => $categories, 'mangas' => $mangas, 'formSpoil' => $form3->createView()));
    }
}