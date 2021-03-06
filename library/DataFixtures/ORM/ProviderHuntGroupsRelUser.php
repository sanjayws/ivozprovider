<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUser;

class ProviderHuntGroupsRelUser extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(HuntGroupsRelUser::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstance(HuntGroupsRelUser::class);
        (function () use ($fixture) {
            $this->setTimeoutTime(1);
            $this->setPriority(1);
            $this->setHuntGroup($fixture->getReference('_reference_ProviderHuntGroup1'));
            $this->setUser($fixture->getReference('_reference_ProviderUser1'));
        })->call($item1);

        $this->addReference('_reference_ProviderHuntGroupsRelUser1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderHuntGroup::class,
            ProviderUser::class
        );
    }
}
