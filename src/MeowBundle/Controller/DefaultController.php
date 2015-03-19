<?php

namespace MeowBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use MeowBundle\Form\CommentType;
use MeowBundle\Form\SpoilType;
use MeowBundle\Form\UserType;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

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
        $spoils = $repoSpoils->findBy(array('isPublished' => true), array('nbComments' => 'DESC'));

        $repoCategories = $this->container->get('doctrine')->getRepository('MeowBundle:Category');
        $categories = $repoCategories->findAll();

        $repoMangas = $this->container->get('doctrine')->getRepository('MeowBundle:Manga');
        $mangas = $repoMangas->findAll();

        return array('spoils' => $spoils, 'categories' => $categories, 'mangas' => $mangas);
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

        return array('spoil' => $spoil, 'comments' => $comments, 'form' => $form->createView(), 'forms' => $tab);
    }

    /**
     * @Route("/profile/{username}", name="view_profile")
     * @Template()
     */
    public function profileAction($username, Request $request)
    {
        $repoUser = $this->container->get('doctrine')->getRepository('MeowBundle:User');
        $user = $repoUser->findOneBy(array('username' => $username));

        if ($this->getUser()->getId() == $user->getId()){
            $userPass = $this->getUser();
            if (!is_object($userPass) || !$user instanceof UserInterface) {
                throw new AccessDeniedException('This user does not have access to this section.');
            }

            /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
            $dispatcher = $this->get('event_dispatcher');

            $event = new GetResponseUserEvent($userPass, $request);
            $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_INITIALIZE, $event);

            if (null !== $event->getResponse()) {
                return $event->getResponse();
            }

            /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
            $formFactory = $this->get('fos_user.change_password.form.factory');

            $form = $formFactory->createForm();
            $form->setData($userPass);

            $form->handleRequest($request);

            if ($form->isValid()) {
                /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
                $userManager = $this->get('fos_user.user_manager');

                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_SUCCESS, $event);

                $userManager->updateUser($userPass);

                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('fos_user_profile_show');
                    $response = new RedirectResponse($url);
                }

                $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_COMPLETED, new FilterUserResponseEvent($userPass, $request, $response));

                return $response;
            }
        }

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

        $form4 = $this->createForm(new UserType());

        if ($this->getUser()->getId() == $user->getId()){
            return $this->render('MeowBundle:Default:profile.html.twig', array('user' => $user, 'pagination' => $pagination, 'form' => $form->createView(), 'formCover' => $form4->createView()));
        }else{
            return $this->render('MeowBundle:Default:profile.html.twig', array('user' => $user, 'pagination' => $pagination, 'formCover' => $form4->createView()));
        }
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

        return $this->render('MeowBundle:Default:moderation.html.twig', array('pagination' => $pagination));
    }
}