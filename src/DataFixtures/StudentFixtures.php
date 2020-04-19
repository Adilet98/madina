<?php

namespace App\DataFixtures;

use App\DBAL\Types\RoleEnumType;
use App\Entity\Student;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class StudentFixtures extends Fixture implements DependentFixtureInterface
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $studentUser = new User();
        $studentUser->setUsername('arina_beisova');
        $studentUser->setRoles([RoleEnumType::ROLE_STUDENT]);
        $studentUser->setPassword($this->passwordEncoder->encodePassword(
            $studentUser,
            '123qwe'
        ));

        $manager->persist($studentUser);

        $student = new Student();
        $student->setUser($studentUser);
        $student->setSurname('Беисова');
        $student->setFirstname('Арина');
        $student->setLastname('Толегеновна');
        $student->setGroupName($this->getReference(ClassGroupFixtures::A_GROUP));
        $student->setShift('1 смена');
        $student->setBirth(new \DateTime('29.07.2004'));
        $student->setAddress('19 мкр. 75');

        $manager->persist($student);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ClassGroupFixtures::class
        ];
    }
}
