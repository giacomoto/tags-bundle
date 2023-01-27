<?php

namespace Luckyseven\Bundle\LuckysevenTagsBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Luckyseven\Bundle\LuckysevenTagsBundle\Entity\EntityTag;
use Luckyseven\Bundle\LuckysevenTagsBundle\Interface\IEntityHasTags;
use Luckyseven\Bundle\LuckysevenTagsBundle\Interface\ITag;

class LuckysevenTagsService
{
    protected EntityRepository $tagRepository;
    protected EntityRepository $entityTagRepository;

    public function __construct(EntityManagerInterface $entityManager, string $tagEntity)
    {
        $this->tagRepository = $entityManager->getRepository($tagEntity);
        $this->entityTagRepository = $entityManager->getRepository(EntityTag::class);
    }

    public function createTag(ITag $tag, $flush = true): ITag
    {
        $this->tagRepository->save($tag, $flush);
        return $tag;
    }

    public function deleteTag(ITag $tag, $flush = true): ITag
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

    public function addTag(IEntityHasTags $entity, ITag $tag): ITag
    {
        $this->entityTagRepository->addTag($entity, $tag);
        return $tag;
    }


    public function addTags(IEntityHasTags $entity, array $tags): array
    {
        $this->entityTagRepository->addTags($entity, $tags);
        return $tags;
    }

    public function removeTag(IEntityHasTags $entity, ITag $tag): ITag
    {
        $this->entityTagRepository->removeTag($entity, $tag);
        return $tag;
    }
}
