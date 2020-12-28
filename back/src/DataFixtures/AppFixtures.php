<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Location;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $common = new Location();
        $common->setTitle('Parties communes');
        $manager->persist($common);

        $exterieur = new Location();
        $exterieur->setTitle('extérieur');
        $exterieur->setParent($common);
        $manager->persist($exterieur);

        $en3 = [
            'barrière',
            'jardin',
            'parking',
        ];
        foreach ($en3 as $n3) {
            $loc = new Location();
            $loc->setTitle($n3);
            $loc->setParent($exterieur);
            $manager->persist($loc);
        }
        
        $interieur = new Location();
        $interieur->setTitle('intérieur');
        $interieur->setParent($common);
        $manager->persist($interieur);

        $in3 = [
            "cage d'escaliers",
            'caves',
            'chaufferie',
            'conduites techniques',
            'entrée jardin',
            'entrée parking',
            'greniers',
            'local à poubelles',
            'local à velos',
        ];
        foreach ($in3 as $n3) {
            $loc = new Location();
            $loc->setTitle($n3);
            $loc->setParent($interieur);
            $manager->persist($loc);
        }

        $private = new Location();
        $private->setTitle('Parties privées');
        $manager->persist($private);

        $pn2 = [
            'balcon',
            'chauffage',
            'eau chaude',
            'eau froide',
            'autre',
        ];
        foreach ($pn2 as $n2) {
            $loc = new Location();
            $loc->setTitle($n2);
            $loc->setParent($private);
            $manager->persist($loc);
        }

        $manager->flush();
    }
}
