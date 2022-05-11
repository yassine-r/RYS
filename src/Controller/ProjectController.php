<?php

namespace App\Controller;
use App\Entity\Project;
use App\Form\ProjectFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;

class ProjectController extends Controller
{
    private $entityManager;
    private $date;
    private $router;
    public function __construct(
        FormFactoryInterface $formFactory,
        EntityManagerInterface $entityManager,
        RouterInterface $router
    ) {

        $this->entityManager = $entityManager;
        $this->router = $router;
        $this->date = new \DateTime('now');
    }
    /**
     * @Route("/Project", name="Project_home")
     */
    public function index(): Response
    {
        $Projects = $this->getDoctrine()->getRepository(Project::class)->findAll();
        return $this->render('project/home.html.twig', [
            'Projects' => $Projects,
        ]);
    }
    /**
     * @Route("/Project/{id}", name="Project_view")
     */
    public function show($id): Response
    {
        $Project = $this->getDoctrine()->getRepository(Project::class)->find($id);
        $Project_emps = $this->getDoctrine()->getRepository(Project::class)->find($id);
        return $this->render('project/show.html.twig', [
            'Project' => $Project,
            'Project_emps' => $Project_emps,
        ]);
    }

    /**
     * @Route("/Project/{id}/download", name="Project_download")
     */

    public function download($id)
    {
        $Project = $this->getDoctrine()->getRepository(Project::class)->find($id);
        $pdfOptions = new Options();
        $dompdf = new Dompdf($pdfOptions);
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('project/show.html.twig', [
            'Project'=>$Project,
        ]);
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');
        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser (force download)
        $dompdf->stream("Projet.pdf", [
            "Attachment" => true
        ]);
    }
    /**
     * @Route("/Project/{id}/facture", name="Project_facture")
     */
    public function facture($id): Response
    {
        $Project = $this->getDoctrine()->getRepository(Project::class)->find($id);
        return $this->render('project/facture.html.twig', [
            'Project' => $Project,
        ]);
    }
    /**
     * @Route("/Project/{id}/bon", name="Project_bon")
     */
    public function bon($id): Response
    {
        $Project = $this->getDoctrine()->getRepository(Project::class)->find($id);
        return $this->render('project/bon.html.twig', [
            'Project' => $Project,
            'date'=>$this->date,
        ]);
    }
    /**
     * @Route("/Project/{id}/facture/download", name="Project_facture_download")
     */
    public function facturedown($id)
    {
        $Project = $this->getDoctrine()->getRepository(Project::class)->find($id);
        $pdfOptions = new Options();
        $dompdf = new Dompdf($pdfOptions);
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('project/facture.html.twig', [
            'Project'=>$Project,
        ]);
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');
        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser (force download)
        $dompdf->stream("facture.pdf", [
            "Attachment" => true
        ]);
    }
}
