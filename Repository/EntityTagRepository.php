<?php

namespace Luckyseven\Bundle\LuckysevenTagsBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Luckyseven\Bundle\LuckysevenTagsBundle\Entity\EntityTag;
use Luckyseven\Bundle\LuckysevenTagsBundle\Entity\Tag;
use Luckyseven\Bundle\LuckysevenTagsBundle\Interface\IEntityHasTags;

/**
 * @extends ServiceEntityRepository<Tag>
 *
 * @method EntityTag|null find($id, $lockMode = null, $lockVersion = null)
 * @method EntityTag|null findOneBy(array $criteria, array $orderBy = null)
 * @method EntityTag[]    findAll()
 * @method EntityTag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntityTagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EntityTag::class);
    }

    public function save(EntityTag $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(EntityTag $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function addTag(IEntityHasTags $entity, Tag $tag): void
    {
        $sql = <<<SQL
            INSERT IGNORE INTO {$this->getClassMetadata()->getTableName()}
            (`tag_id`, `reference_id`, `reference_table`)
            VALUES (?, ?, ?) 
        SQL;

        $this->getEntityManager()->getConnection()->executeQuery($sql, [
            $tag->getId(),
            $entity->getId(),
            $entity::class,
        ]);
    }

    public function addTags(IEntityHasTags $entity, array $tags): void
    {
        $values = implode(',', array_map(static fn() => '(?, ?, ?)', $tags));
        $params = [];

        $sql = <<<SQL
            INSERT IGNORE INTO {$this->getClassMetadata()->getTableName()}
            (`tag_id`, `reference_id`, `reference_table`)
            VALUES {$values} 
        SQL;

        foreach($tags as $tag) {
            $params[] = $tag->getId();
            $params[] = $entity->getId();
            $params[] = $entity::class;
        }

        $this->getEntityManager()->getConnection()->executeQuery($sql, $params);
    }

    public function removeTag(IEntityHasTags $entity, Tag $tag): void
    {
        $sql = <<<SQL
            DELETE FROM {$this->getClassMetadata()->getTableName()}
            WHERE `tag_id` = ? AND `reference_id` = ? AND `reference_table` = ? 
        SQL;

        $this->getEntityManager()->getConnection()->executeQuery($sql, [
            $tag->getId(),
            $entity->getId(),
            $entity::class,
        ]);
    }
}
