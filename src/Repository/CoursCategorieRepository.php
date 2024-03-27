<?php

namespace App\Repository;

use App\Entity\CoursCategorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CoursCategorie>
 *
 * @method CoursCategorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoursCategorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoursCategorie[]    findAll()
 * @method CoursCategorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoursCategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoursCategorie::class);
    }

//    /**
//     * @return CoursCategorie[] Returns an array of CoursCategorie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CoursCategorie
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
