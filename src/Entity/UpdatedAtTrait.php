<?php

declare(strict_types=1);

namespace ORMBundle\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

trait UpdatedAtTrait
{
    /**
     * @var DateTimeInterface
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private DateTimeInterface $updatedAt;

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTimeInterface $updatedAt
     * @return \App\Entity\UpdatedAtTrait
     */
    public function setUpdatedAt(DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @ORM\PreUpdate()
     */
    public function refreshUpdatedAt(): void
    {
        $this->updatedAt = new \DateTime();
    }
}
