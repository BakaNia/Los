<?php

namespace App\Repository;

use App\Entity\Contract;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Tests\Common\Annotations\Fixtures\AnnotationWithRequiredAttributesWithoutConstructor;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @method Contract|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contract|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contract[]    findAll()
 * @method Contract[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContractRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contract::class);
    }

     /**
      * @return Contract[] Returns an array of Contract objects
      */

    public function findByExampleField($value)

    {
        $qb=$this->createQueryBuilder('c')
            ->innerJoin(User::class,'u','with','c.User=u.id')
            ->where('u.name like :name')
            ->setParameter('name','%'.$value.'%')
            ->getQuery();

        return $qb->execute();
    }


    /*
    public function findOneBySomeField($value): ?Contract
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
