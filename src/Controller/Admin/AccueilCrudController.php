<?php

namespace App\Controller\Admin;

use App\Entity\Accueil;
use App\Form\ActualiteType;
use App\Form\ImageFileType;
use App\Form\VideoFileType;
use App\Repository\AccueilRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AccueilCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Accueil::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setPageTitle('edit', "Modifier la page d'accueil");
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            CollectionField::new('images')
                ->setEntryType(ImageFileType::class),
            TextField::new('video')
                ->setFormType(VideoFileType::class)
                ->setFormTypeOption('allow_delete', true),
            CollectionField::new('actualites')
                ->setEntryType(ActualiteType::class)
                ->setEntryIsComplex(),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->disable(Action::NEW, Action::DELETE, Action::SAVE_AND_CONTINUE, Action::INDEX);
    }

    private function getAccueilUrl(AccueilRepository $accueilRepository, EntityManagerInterface $manager)
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        $accueil = $accueilRepository->findOneBy([]);
        if($accueil === null)
        {
            $accueil = new Accueil();
            $manager->persist($accueil);
            $manager->flush();
        }
        return $adminUrlGenerator
            ->setController(AccueilCrudController::class)
            ->setAction('edit')
            ->setEntityId($accueil->getId())
            ->generateUrl();
    }

    public function index(AdminContext $context, AccueilRepository $accueilRepository = null, EntityManagerInterface $manager = null)
    {
        return $this->redirect($this->getAccueilUrl($accueilRepository, $manager));
    }
}
