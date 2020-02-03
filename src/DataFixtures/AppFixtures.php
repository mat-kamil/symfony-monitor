<?php

namespace App\DataFixtures;

use App\Entity\ServerLoad;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0;  $i < 5; $i++) {
            $serverLoad = new ServerLoad();
            $serverLoad->setTimestamp(new \DateTime( "-{$i} minutes"));
            $serverLoad->setConcurrency(rand([0, 500000]));
            $serverLoad->setCpuLoad((float)rand() / (float)getrandmax() * 100);
            $manager->persist($serverLoad);
        }

        $manager->flush();
    }
}
