<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\DepartementEnt;

class DepartementEntFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $noms = ["Direction", "RH", "Développement", "Communication"];
        $mails = ["dir@exemple.fr", "RH@exemple.fr", "dev@exemple.fr", "com@exemple.fr"];

        for($i=0 ; $i<sizeof($noms) ; $i++){
          $dep = new DepartementEnt();
          $dep -> setNom($noms[$i])
               -> setMail($mails[$i]);

          $manager->persist($dep);
        }

        $manager->flush();
    }
}
