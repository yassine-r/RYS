<?php

namespace App\Controller\Admin;

use App\Entity\Division;
use App\Entity\Employee;
use App\Entity\Job;
use App\Entity\Phase;
use App\Entity\Project;
use App\Entity\Service;
use App\Entity\Tache;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('RYS Administration');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Accueil', 'fas fa-house-user', 'home');
        if ($this->isGranted('ROLE_EMPLOYEE_RH')){
            yield MenuItem::linkToCrud('Employées', 'fas fa-users', Employee::class);
            yield MenuItem::linkToCrud('Divisions', 'fas fa-divide', Division::class);
            yield MenuItem::linkToCrud('Services', 'far fa-address-book', Service::class);
        }
        if ($this->isGranted('ROLE_EMPLOYEE_PM')){
            yield MenuItem::linkToCrud('Projets', 'fas fa-briefcase', Project::class);
            yield MenuItem::linkToCrud('Phases', 'fas fa-indent', Phase::class);
            yield MenuItem::linkToCrud('Taches', 'far fa-calendar-check', Tache::class);
        }

    }
}
