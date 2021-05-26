<?php

namespace App\Repository;

use App\Entity\Grammaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Grammaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Grammaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Grammaire[]    findAll()
 * @method Grammaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GrammaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Grammaire::class);
    }

    // /**
    //  * @return Grammaire[] Returns an array of Grammaire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Grammaire
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}