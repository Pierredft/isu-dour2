<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Form\PersonnelType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setPageTitle('edit', "Modifier la page de contact");
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextEditorField::new('texte')
                ->setTemplatePath('admin/text_editor.html.twig')
                ->setTrixEditorConfig([
                    'blockAttributes' => [
                        'default' => ['tagName' => 'p'],
                        'heading1' => ['tagName' => 'h2'],
                    ],
                ]),
            CollectionField::new('personnels')
                ->setEntryType(PersonnelType::class),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->disable(Action::NEW, Action::DELETE, Action::SAVE_AND_CONTINUE, Action::INDEX);
    }

    public function index(AdminContext $context, ContactRepository $contactRepository = null, EntityManagerInterface $manager = null)
    {
        return $this->redirect($this->getContactUrl($contactRepository, $manager));
    }

    private function getContactUrl(ContactRepository $contactRepository, EntityManagerInterface $manager)
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        $contact = $contactRepository->findOneBy([]);
        if($contact === null)
        {
            $contact = new Contact();
            $manager->persist($contact);
            $manager->flush();
        }
        return $adminUrlGenerator
            ->setController(ContactCrudController::class)
            ->setAction('edit')
            ->setEntityId($contact->getId())
            ->generateUrl();
    }
}
