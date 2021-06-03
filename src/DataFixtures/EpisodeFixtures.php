<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Episode;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    const EPISODES = [
        'episode1',
        'episode2',
        'episode3',
        'episode4',
        'episode5',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::EPISODES as $key => $episodes) {
            $episode = new Episode();
            $episode->setTitle($episodes);;
            $episode->setSeason($this->getReference('season_0'));
            $episode->setNumber($key);
            $episode->setSynopsis('Synopsis Des zombies envahissent la terre');
            $manager->persist($episode);
            $this->addReference('episode_' . $key, $episode);
        }  

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          SeasonFixtures::class,
        ];
    }
}
