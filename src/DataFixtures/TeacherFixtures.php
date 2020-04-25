<?php

namespace App\DataFixtures;

use App\DBAL\Types\RoleEnumType;
use App\Entity\Teacher;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Role\Role;

class TeacherFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('teacher');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'qwerty'
        ));
        $user->setRoles([RoleEnumType::ROLE_TEACHER]);
        $manager->persist($user);

        $teacher = new Teacher();
        $teacher->setSurname('Абдигаликова');
        $teacher->setFirstname('Маржан');
        $teacher->setLastname('Шолпановна');
        $teacher->setCategory('Categorya');
        $teacher->setPosition('Poziciya');
        $teacher->setUser($user);
        $manager->persist($teacher);

        $manager->flush();
    }
}
