<?php

namespace Luckyseven\Bundle\LuckysevenTagsBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Luckyseven\Bundle\LuckysevenTagsBundle\Entity\EntityTag;
use Luckyseven\Bundle\LuckysevenTagsBundle\Entity\Tag;
use Luckyseven\Bundle\LuckysevenTagsBundle\Interface\IEntityHasTags;

class LuckysevenTagsService
{
    protected EntityRepository $tagRepository;
    protected EntityRepository $entityTagRepository;

    public function __construct(EntityManagerInterface $entityManager, string $tagEntity)
    {
        $this->tagRepository = $entityManager->getRepository($tagEntity);
        $this->entityTagRepository = $entityManager->getRepository(EntityTag::class);
    }

    public function createTag(Tag $tag, $flush = true): Tag
    {
        $this->tagRepository->save($tag, $flush);
        return $tag;
    }

    public function deleteTag(Tag $tag, $flush = true): Tag
    {
        $this->tagRepository->remove($tag, $flush);
        return $tag;
    }

    public function getTags(?IEntityHasTags $entity = null): array
    {
        return $entity
            ? $this->tagRepository->findForEntity($entity)
            : $this->tagRepository->findAll();
    }

    public function addTag(IEntityHasTags $entity, Tag $tag): Tag
    {
        $this->entityTagRepository->addTag($entity, $tag);
        return $tag;
    }


    public function addTags(IEntityHasTags $entity, array $tags): array
    {
        $this->entityTagRepository->addTags($entity, $tags);
        return $tags;
    }

    public function removeTag(IEntityHasTags $entity, Tag $tag): Tag
    {
        $this->entityTagRepository->removeTag($entity, $tag);
        return $tag;
    }
}
