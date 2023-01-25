<?php

namespace Luckyseven\Bundle\LuckysevenTagsBundle\Repository;

use App\Entity\Property;
use Luckyseven\Bundle\LuckysevenTagsBundle\Entity\EntityTag;
use Luckyseven\Bundle\LuckysevenTagsBundle\Entity\Tag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Luckyseven\Bundle\LuckysevenTagsBundle\Interface\IEntityHasTags;

/**
 * @extends ServiceEntityRepository<Tag>
 *
 * @method Tag|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tag|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tag[]    findAll()
 * @method Tag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, string $entityClass)
    {
        parent::__construct($registry, $entityClass);
    }

    public function save(Tag $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Tag $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findForEntity(IEntityHasTags $entity): array
    {
        return $this->createQueryBuilder('t')
            ->select('t')
            ->leftJoin(EntityTag::class, 'et', 'with', 'et.tagId = t.id')
            ->andWhere('et.referenceId  = :referenceId')
            ->andWhere('et.referenceTable = :referenceTable')
            ->setParameters([
                'referenceId' => $entity->getId(),
                'referenceTable' => $entity::class,
            ])
            ->getQuery()
            ->getResult();
    }
}
