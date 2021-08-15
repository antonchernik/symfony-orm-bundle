<?php

declare(strict_types=1);

namespace ORMBundle\Tests\Trait;

use Doctrine\ORM\EntityManager;
use Fidry\AliceDataFixtures\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

trait OrmFixtureTrait
{
    protected ?EntityManager $entityManager;

    protected ?LoaderInterface $loader = null;

    public function getEntityManager(): ?EntityManager
    {
        return $this->entityManager;
    }

    public function setEntityManager(?EntityManager $entityManager): void
    {
        $this->entityManager = $entityManager;
    }

    public function getLoader(): ?LoaderInterface
    {
        return $this->loader;
    }

    public function setLoader(?LoaderInterface $loader): void
    {
        $this->loader = $loader;
    }

    public function load(array $fixtures): void
    {
        $path = __DIR__.'/Resources/fixtures/%s';
        $this->loader->load(array_map(function($item) use ($path) { return sprintf($path, $item);}, $fixtures));
    }

    public function setUpORM(ContainerInterface $container): void
    {
        $this->loader = $container->get('fidry_alice_data_fixtures.loader.doctrine');
        $this->entityManager = $container->get('doctrine')->getManager();
    }

    public function tearDownORM(): void
    {
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
