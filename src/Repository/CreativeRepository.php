<?php

namespace App\Repository;

use App\Entity\Creative;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Creative|null find($id, $lockMode = null, $lockVersion = null)
 * @method Creative|null findOneBy(array $criteria, array $orderBy = null)
 * @method Creative[]    findAll()
 * @method Creative[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreativeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Creative::class);
    }

//    /**
//     * @return Creative[] Returns an array of Creative objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Creative
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
