<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Season;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    const SEASONS = [
        'season1',
        'season2',
        'season3',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::SEASONS as $key => $seasons) {
            $season = new Season();
            $season->setPrograms($this->getReference('program_0'));
            $season->setNumber(1);
            $season->setYear(2000);
            $season->setDescription('Description Des zombies envahissent la terre');
            $manager->persist($season);
            $this->addReference('season_' . $key, $season);
        }  
        
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          ProgramFixtures::class,
        ];
    }

}
