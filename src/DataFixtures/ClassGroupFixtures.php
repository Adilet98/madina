<?php

namespace App\DataFixtures;

use App\Entity\ClassGroup;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ClassGroupFixtures extends Fixture
{
    public const A_GROUP = 'a-group';

    public function load(ObjectManager $manager)
    {
        $groupA = new ClassGroup();
        $groupA->setName('10 А');
        $manager->persist($groupA);

        $groupB = new ClassGroup();
        $groupB->setName('10 Б');
        $manager->persist($groupB);

        $groupC = new ClassGroup();
        $groupC->setName('10 В');
        $manager->persist($groupC);

        $manager->flush();

        $this->addReference(self::A_GROUP, $groupA);
    }
}
