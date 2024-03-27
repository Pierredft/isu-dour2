<?php

namespace App\Controller\Admin;

use App\Entity\Acces;
use App\Entity\Accueil;
use App\Entity\Calendrier;
use App\Entity\Contact;
use App\Entity\Enseignement;
use App\Entity\Formation;
use App\Entity\Inscription;
use App\Entity\Lien;
use App\Entity\Niveau;
use App\Entity\Projet;
use App\Entity\Reglement;
use App\Entity\User;
use App\Entity\Visite;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(AccesCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Isu-Dour');
    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToRoute('Retour vers le site', 'fa fa-home', 'home.index');
        yield MenuItem::linkToCrud('Accès', 'fas fa-list', Acces::class);
        yield MenuItem::linkToCrud('Accueil', 'fas fa-list', Accueil::class);
        yield MenuItem::linkToCrud('Calendriers', 'fas fa-list', Calendrier::class);
        yield MenuItem::linkToCrud('Contacts', 'fas fa-list', Contact::class);
        yield MenuItem::linkToCrud('Enseignements', 'fas fa-list', Enseignement::class);
        yield MenuItem::linkToCrud('Formations', 'fas fa-list', Formation::class);
        yield MenuItem::linkToCrud('Inscriptions', 'fas fa-list', Inscription::class);
        yield MenuItem::linkToCrud('Liens utiles', 'fas fa-list', Lien::class);
        yield MenuItem::linkToCrud('Niveaux', 'fas fa-list', Niveau::class);
        yield MenuItem::linkToCrud('Notre école en image', 'fas fa-list', Visite::class);
        yield MenuItem::linkToCrud('Projets', 'fas fa-list', Projet::class);
        yield MenuItem::linkToCrud('Reglements', 'fas fa-list', Reglement::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-list', User::class)->setPermission('ROLE_DIRECTEUR')->setController(UserCrudController::class);
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
        ->addMenuItems([
            MenuItem::linkToCrud('Modifier le mot de passe', 'fas fa-list', User::class)->setEntityId($user->getId())->setAction('edit')
        ]);
    }
}
