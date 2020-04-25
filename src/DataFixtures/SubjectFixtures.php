<?php

namespace App\DataFixtures;

use App\Entity\Subject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SubjectFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $subject1 = new Subject();
        $subject1->setName('Құқық');
        $manager->persist($subject1);

        $manager->flush();
    }
}
