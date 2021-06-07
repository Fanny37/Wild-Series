<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Program;
use App\Service\Slugify;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        'Walking Dead',
        'Friends',
        'Desperate Housewives',
        'Dr House',
        'Mr Robot',
    ];

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        
        foreach (self::PROGRAMS as $key => $programs) {
            $program = new Program();
            $program->setTitle($programs);
            $title = $this->slugify->generate($programs);
            $program->setSlug($title);
            $program->setSummary('Des zombies envahissent la terre');
            $program->setCategory($this->getReference('category_4'));
            $program->addActor($this->getReference('actor_0'));
            $program->addActor($this->getReference('actor_1'));
            $program->addActor($this->getReference('actor_2'));
            $program->addActor($this->getReference('actor_3'));
            $manager->persist($program);
            $this->addReference('program_' . $key, $program);
        }  

        $manager->flush();     
    }

    public function getDependencies()
    {
        return [
          ActorFixtures::class,
          CategoryFixtures::class,
        ];
    }
}
