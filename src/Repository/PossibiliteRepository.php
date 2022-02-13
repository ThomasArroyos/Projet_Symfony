<?php

namespace App\Repository;

use App\Entity\Possibilite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Possibilite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Possibilite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Possibilite[]    findAll()
 * @method Possibilite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PossibiliteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Possibilite::class);
    }

    // /**
    //  * @return Possibilite[] Returns an array of Possibilite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Possibilite
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
