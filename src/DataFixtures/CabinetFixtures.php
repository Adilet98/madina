<?php

namespace App\DataFixtures;

use App\Entity\Cabinet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CabinetFixtures extends Fixture
{
    public const CABINET_101 = '101';
    public const CABINET_201 = '201';
    public const CABINET_301 = '301';
    public const CABINET_401 = '401';

    public function load(ObjectManager $manager)
    {
        $cabinet1 = new Cabinet();
        $cabinet1->setName('101');
        $manager->persist($cabinet1);

        $cabinet2 = new Cabinet();
        $cabinet2->setName('201');
        $manager->persist($cabinet2);

        $cabinet3 = new Cabinet();
        $cabinet3->setName('301');
        $manager->persist($cabinet3);

        $cabinet4 = new Cabinet();
        $cabinet4->setName('401');
        $manager->persist($cabinet4);

        $manager->flush();

        $this->addReference(self::CABINET_101, $cabinet1);
        $this->addReference(self::CABINET_201, $cabinet2);
        $this->addReference(self::CABINET_301, $cabinet3);
        $this->addReference(self::CABINET_401, $cabinet4);
    }
}
