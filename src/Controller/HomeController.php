<?php

namespace App\Controller;
use App\Entity\Employee;
use App\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
class HomeController extends AbstractController
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
       $this->security = $security;
    }
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/profil", name="profil")
     */
    public function profil()
    {
        $user1 = $this->security->getUser();
        // $user=$this->getDoctrine()->getRepository(Employee::class)->findBy($user1->Username);
        $Projects = $this->getDoctrine()->getRepository(Project::class)->findAll();
        return $this->render('home/profil/profil.html.twig',['employee' =>$user1,'projects'=>$Projects]);
    }
    /**
     * @Route("/profil/edit/{id}", name="edit")
     */
    public function edit(Employee $employee,Request $request): Response
    {
        $form = $this->formFactory->create(ArticleType::class, $employee);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
            return new RedirectResponse(
                $this->router->generate('profil')
            );
        }
        return $this->render('home/profil/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
