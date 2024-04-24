<?php

namespace App\Repository;

use App\Entity\Detailsinformation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Detailsinformation>
 *
 * @method Detailsinformation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Detailsinformation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Detailsinformation[]    findAll()
 * @method Detailsinformation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailsinformationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Detailsinformation::class);
    }

    //    /**
    //     * @return Detailsinformation[] Returns an array of Detailsinformation objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Detailsinformation
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
