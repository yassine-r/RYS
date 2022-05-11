<?php

namespace App\Controller;

use App\Entity\Employee;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeesController extends AbstractController
{
    /**
     * @Route("/employees", name="employees")
     */

    public function index(): Response
    {
        $employees = $this->getDoctrine()->getRepository(Employee::class)->findAll();
        return $this->render('employees/index.html.twig', [
            'employees' => $employees,
        ]);
    }
    /**
     * @Route("/employees/{id}", name="employee_view")
     */
    public function profil($id): Response
    {
        $employee = $this->getDoctrine()->getRepository(Employee::class)->find($id);
        return $this->render('home/profil/profil.html.twig', [
            'employee' => $employee,
        ]);
    }
    /**
     * @Route("/employees/{id}/bulletin", name="employee_bulletin")
     */
    public function bulletin($id): Response
    {
        $employee = $this->getDoctrine()->getRepository(Employee::class)->find($id);
        return $this->render('employees/bulletin.html.twig', [
            'employee' => $employee,
        ]);
    }
}
