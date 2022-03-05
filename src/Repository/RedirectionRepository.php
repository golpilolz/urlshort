<?php

namespace App\Repository;

use App\Entity\Redirection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Redirection|null find($id, $lockMode = null, $lockVersion = null)
 * @method Redirection|null findOneBy(array $criteria, array $orderBy = null)
 * @method Redirection[]    findAll()
 * @method Redirection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RedirectionRepository extends ServiceEntityRepository {
  public function __construct(ManagerRegistry $registry) {
    parent::__construct($registry, Redirection::class);
  }

  /**
   * @throws ORMException
   * @throws OptimisticLockException
   */
  public function add(Redirection $entity, bool $flush = true): void {
    $this->_em->persist($entity);
    if ($flush) {
      $this->_em->flush();
    }
  }

  /**
   * @throws ORMException
   * @throws OptimisticLockException
   */
  public function remove(Redirection $entity, bool $flush = true): void {
    $this->_em->remove($entity);
    if ($flush) {
      $this->_em->flush();
    }
  }

  // /**
  //  * @return Redirection[] Returns an array of Redirection objects
  //  */
  /*
  public function findByExampleField($value)
  {
      return $this->createQueryBuilder('r')
          ->andWhere('r.exampleField = :val')
          ->setParameter('val', $value)
          ->orderBy('r.id', 'ASC')
          ->setMaxResults(10)
          ->getQuery()
          ->getResult()
      ;
  }
  */

  /*
  public function findOneBySomeField($value): ?Redirection
  {
      return $this->createQueryBuilder('r')
          ->andWhere('r.exampleField = :val')
          ->setParameter('val', $value)
          ->getQuery()
          ->getOneOrNullResult()
      ;
  }
  */
}
