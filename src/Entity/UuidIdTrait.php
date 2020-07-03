<?php

declare(strict_types=1);

namespace ORMBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

trait UuidIdTrait
{
    /**
     * @var UuidInterface|null
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private ?UuidInterface $id;

    /**
     * @return ?UuidInterface
     */
    public function getId(): ?UuidInterface
    {
        return $this->id;
    }
}
