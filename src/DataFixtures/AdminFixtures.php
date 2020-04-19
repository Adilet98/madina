<?php

namespace App\DataFixtures;

use App\DBAL\Types\RoleEnumType;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setUsername('admin');
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'qwerty'
        ));
        $admin->setRoles([RoleEnumType::ROLE_ADMIN]);

        $manager->persist($admin);
        $manager->flush();
    }
}
