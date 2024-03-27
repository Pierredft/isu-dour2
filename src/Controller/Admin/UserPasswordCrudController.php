<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Validator\Constraints as Assert;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserPasswordCrudController extends AbstractCrudController
{
    public function __construct(private UserPasswordHasherInterface $hasher, private AdminUrlGenerator $adminUrlGenerator){}

    public function configureActions(Actions $actions): Actions
    {
        return $actions->disable(Action::NEW, Action::DELETE, Action::SAVE_AND_CONTINUE, Action::INDEX);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setPageTitle('edit', 'Modifier le mot de passe');
    }

    public function index(AdminContext $context)
    {
        return $this->redirect($this->adminUrlGenerator->setAction('edit')->setEntityId($this->getUser()->getId()));
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('plainPassword')->setFormType(PasswordType::class)->setFormTypeOption('label', 'Mot de passe actuel'),
            TextField::new('newPassword')
                ->setFormType(RepeatedType::class)
                ->setFormTypeOptions([
                    'type' => PasswordType::class,
                    'invalid_message' => 'Les mots de passe ne correspondent pas.',
                    "first_options" => [
                        "label" => "Nouveau mot de passe",
                        "constraints" => [new Assert\NotBlank(message: "Entrez un nouveau mot de passe.")]
                    ],
                    "second_options" => [
                        "label" => "Confirmation nouveau mot de passe",
                        "constraints" => [new Assert\NotBlank(message: "Confirmez votre nouveau mot de passe.")]
                    ],
                ])
        ];
    }

    public function createEditFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder   = parent::createEditFormBuilder($entityDto, $formOptions, $context);
        $this->addEncodePasswordEventListener($formBuilder);
        return $formBuilder;
    }

    protected function addEncodePasswordEventListener(FormBuilderInterface $formBuilder): void
    {
        $formBuilder->addEventListener(
            FormEvents::SUBMIT,
            function (FormEvent $event)
            {
                $user = $event->getData();
                $plainPassword = $user->getPlainPassword();
                $newPassword = $user->getNewPassword();
                if($plainPassword != null && $this->hasher->isPasswordValid($user, $plainPassword))
                {
                    if ($newPassword != null)
                    {
                        $user->setPassword($this->hasher->hashPassword($user, $newPassword));
                        $this->addFlash('success', 'Le mot de passe a été changé avec succès.');
                    }
                }
                else
                {
                    $this->addFlash('danger', 'Le mot de passe est incorrect.');
                }
                $user->eraseCredentials();
            }
        );
    }
}
