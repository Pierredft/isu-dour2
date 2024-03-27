<?php

namespace App\DataFixtures;

use App\Entity\Accueil;
use App\Entity\Contact;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $accueil = new Accueil();
        $manager->persist($accueil);
        $contact = new Contact();
        $manager->persist($contact);
        $directeur = new User();
        $directeur->setEmail('direction@isu-dour.be');
        $directeur->setPassword($this->hasher->hashPassword($directeur, "password"));
        $directeur->setRoles(['ROLE_DIRECTEUR']);
        $manager->persist($directeur);
        $admin = new User();
        $admin->setEmail('admin@isu-dour.be');
        $admin->setPassword($this->hasher->hashPassword($admin, "password"));
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);
        $user = new User();
        $user->setEmail('user@isu-dour.be');
        $user->setPassword($this->hasher->hashPassword($user, "password"));
        $manager->persist($user);
        $manager->flush();
    }
}
