<?php

namespace Luckyseven\Bundle\LuckysevenTagsBundle\Entity;

use Luckyseven\Bundle\LuckysevenTagsBundle\Repository\EntityTagRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntityTagRepository::class)]
#[ORM\UniqueConstraint(name: "unique_tag_for_reference", columns: ["tag_id", 'reference_id', 'reference_table'], options: [])]
class EntityTag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $referenceTable = null;

    #[ORM\Column(length: 255)]
    private ?string $referenceId = null;

    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    protected ?int $tagId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReferenceTable(): ?string
    {
        return $this->referenceTable;
    }

    public function setReferenceTable(string $referenceTable): self
    {
        $this->referenceTable = $referenceTable;

        return $this;
    }

    public function getReferenceId(): ?string
    {
        return $this->referenceId;
    }

    public function setReferenceId(string $referenceId): self
    {
        $this->referenceId = $referenceId;

        return $this;
    }

    public function setTagId(?int $tagId): self
    {
        $this->tagId = $tagId;

        return $this;
    }

    public function getTagId(): self
    {
        return $this->tagId;
    }
}
